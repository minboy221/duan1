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
        $sql = "SELECT pc.id,t.name,n.date
        FROM phan_cong pc
        JOIN tho t ON pc.tho_id = t.id
        JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
        WHERE pc.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>