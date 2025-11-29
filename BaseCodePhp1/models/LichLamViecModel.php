<?php
class LichLamViecModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    //tạo ngày tự động
    public function taoNgayTuDong()
    {
        try {
            $count = 0;
            //tạo 7 ngày
            for ($i = 0; $i < 7; $i++) {
                $date = date('Y-m-d', strtotime("+$i day"));
                //phần kiểm tra ngày
                $check = $this->conn->prepare("SELECT id FROM ngay_lam_viec WHERE date = ?");
                $check->execute([$date]);
                //nếu không có thì thêm mới
                if ($check->rowCount() == 0) {
                    $stmt = $this->conn->prepare("INSERT INTO ngay_lam_viec(date) VALUES(?)");
                    $stmt->execute([$date]);
                    $count++;
                }
            }
            return $count;
        } catch (Exception $e) {
            return false;
        }
    }
    // lấy thông tin ngày cụ thể
    public function find($id)
    {
        $sql = "SELECT * FROM ngay_lam_viec WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    //PHẦN XEM CHI TIẾT NGÀY ĐÃ TẠO VÀ GẮN THỢ
    public function getNgayById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM ngay_lam_viec WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //lấy danh sách ngày để hiển thị
    public function getAllNgay()
    {
        //lấy những ngày từ hôm nay trở đi
        $sql = "SELECT * FROM ngay_lam_viec WHERE date >= CURDATE() ORDER BY date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //PHẦN LẤY DANH SÁCH THỢ
    public function getThoInNgay($ngay_lv_id)
    {
        $sql = "SELECT pc.id as phan_cong_id, t.id as tho_id,t.name,t.image
        FROM phan_cong pc
        JOIN tho t ON pc.tho_id = t.id
        WHERE pc.ngay_lv_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ngay_lv_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //lất tất cả thợ trong db để chọn
    public function getAllThoSystem()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tho");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //phần lưu phân công thợ cho các ngày
    public function savePhanCong($ngay_lv_id, $tho_ids)
    {
        try {
            //xoá phân công cũ của ngày này
            $this->conn->beginTransaction();
            $del = $this->conn->prepare("DELETE FROM phan_cong WHERE ngay_lv_id = ?");
            $del->execute([$ngay_lv_id]);
            //thêm phân công mới
            if (!empty($tho_ids)) {
                $ins = $this->conn->prepare("INSERT INTO phan_cong(ngay_lv_id,tho_id) VALUES (?,?)");
                foreach ($tho_ids as $tho_id) {
                    $ins->execute([$ngay_lv_id, $tho_id]);
                }
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    //PHẦN QUẢN LÝ KHUNG GIỜ
    //lấy các giờ đã chọn của thợ trong 1 ngày
    public function getKhungGio($phan_cong_id)
    {
        $stmt = $this->conn->prepare("SELECT time FROM khunggio WHERE phan_cong_id = ? ORDER BY time ASC");
        $stmt->execute([$phan_cong_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    //Phần lưu khung giờ
    public function saveKhungGio($phan_cong_id, $times)
    {
        try {
            $this->conn->beginTransaction();
            //xoá giờ cũ
            $del = $this->conn->prepare("DELETE FROM khunggio WHERE phan_cong_id=?");
            $del->execute([$phan_cong_id]);

            //thêm giờ mới
            if (!empty($times)) {
                $ins = $this->conn->prepare("INSERT INTO khunggio (phan_cong_id,time) VALUES (?,?)");
                foreach ($times as $time) {
                    $ins->execute([$phan_cong_id, $time]);
                }
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    //Phần lấy thông tin chi tiết của thợ
    public function getDetailPhanCong($id)
    {
        $sql = "SELECT pc.id, pc.ngay_lv_id, t.name, n.date 
                FROM phan_cong pc
                JOIN tho t ON pc.tho_id = t.id
                JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                WHERE pc.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //PHẦN HIÊN THỊ CHO CLIEN
    public function getFutureDays()
    {
        $sql = "SELECT * FROM ngay_lam_viec
        WHERE date >= CURDATE()
        ORDER BY date ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lấy danh sách thợ làm việc
    public function getThoByDayId($ngay_id)
    {
        $sql = "SELECT pc.id as phan_cong_id,t.id as tho_id,t.name,t.image,t.lylich
                FROM phan_cong pc
                JOIN tho t ON pc.tho_id = t.id
                WHERE pc.ngay_lv_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ngay_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //lấy khung giờ của thợ và kiểm tra
    // --- CẬP NHẬT HÀM NÀY TRONG MODEL ---
    public function getAvailableTime($phan_cong_id)
    {
        // Cài đặt múi giờ Việt Nam
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $currentDate = date('Y-m-d'); // Ngày hôm nay
        $currentTime = date('H:i');   // Giờ hiện tại (VD: 14:30)

        //Lấy Ngày làm việc của phân công này (để so sánh)
        $sqlDate = "SELECT n.date 
                    FROM phan_cong pc 
                    JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id 
                    WHERE pc.id = ?";
        $stmtDate = $this->conn->prepare($sqlDate);
        $stmtDate->execute([$phan_cong_id]);
        $dateRow = $stmtDate->fetch(PDO::FETCH_ASSOC);
        $workDate = $dateRow['date']; // Ngày làm việc (VD: 2025-11-23)

        // Lấy tất cả khung giờ
        $sqlKG = "SELECT id, time FROM khunggio WHERE phan_cong_id = ? ORDER BY time ASC";
        $stmtKG = $this->conn->prepare($sqlKG);
        $stmtKG->execute([$phan_cong_id]);
        $allSlots = $stmtKG->fetchAll(PDO::FETCH_ASSOC);

        //Lấy các giờ ĐÃ BỊ ĐẶT
        $sqlBooked = "SELECT khunggio_id, status, cancel_reason 
                      FROM lichdat 
                      WHERE status IN ('pending', 'confirmed', 'done', 'cancelled')";
        $stmtBooked = $this->conn->prepare($sqlBooked);
        $stmtBooked->execute();
        $bookedRows = $stmtBooked->fetchAll(PDO::FETCH_ASSOC);

        $bookedMap = [];
        foreach ($bookedRows as $row) {
            $bookedMap[$row['khunggio_id']] = [
                'status' => ['status'],
                'reason' => ['cancel_reason']
            ];
        }
        //XỬ LÝ LOGIC: Đã đặt OR Đã qua giờ
        foreach ($allSlots as &$slot) {
            // Mặc định là chưa bị đặt
            $slot['is_booked'] = false;
            $slot['status_text'] = ''; // Thêm text để giải thích (nếu cần)

            // kiểm tra trong danh sách đã đặt
            if (isset($bookedMap[$slot['id']])) {
                $bookingInfor = $bookedMap[$slot['id']];
                //đánh dấu là bận
                $slot['is_booked'] = true;
                //xử lý thông báo hiển thị
                if ($bookingInfor['status'] === 'cancelled') {
                    //nếu bị huỷ -> sẽ hiện lý do
                    $slot['status_text'] = 'Tạm Ngưng:' . ($bookingInfor['reason'] ?? 'Bảo trì');
                } else {
                    $slot['status_text'] = 'Đã có khách';
                }
            }
            if (!$slot['is_booked']) {
                if ($workDate < $currentDate) {
                    $slot['is_booked'] = true;
                    $slot['status_text'] = 'Đã qua';
                } elseif ($workDate == $currentDate && $slot['time'] < $currentTime) {
                    $slot['is_booked'] = true;
                    $slot['status_text'] = 'Đã qua';
                }
            }
        }
        return $allSlots;
    }
}
?>