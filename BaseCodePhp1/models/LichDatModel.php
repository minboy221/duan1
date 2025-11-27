<?php
class LichDatModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // --- 1. DÀNH CHO ADMIN: LẤY DANH SÁCH (CÓ PHÂN TRANG) ---
    public function getAllLichDatPaginate($limit = 10, $offset = 0)
    {
        $sql = "SELECT 
                    ld.*, 
                    kh.name as ten_khach, 
                    kh.phone as sdt_khach,
                    dv.name as ten_dichvu, dv.price,
                    kg.time as gio_lam,
                    n.date as ngay_lam,
                    t.name as ten_tho
                FROM lichdat ld
                JOIN khachhang kh ON ld.khachhang_id = kh.id
                JOIN dichvu dv ON ld.dichvu_id = dv.id
                JOIN khunggio kg ON ld.khunggio_id = kg.id
                JOIN phan_cong pc ON kg.phan_cong_id = pc.id
                JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                JOIN tho t ON pc.tho_id = t.id
                ORDER BY ld.created_at DESC
                LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đếm tổng số bản ghi (cho phân trang)
    public function countAllLichDat()
    {
        $sql = "SELECT COUNT(*) as total FROM lichdat";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }

    // --- 2. DÀNH CHO ADMIN: LẤY TOÀN BỘ (KHÔNG PHÂN TRANG) ---
    public function getAllLichDat()
    {
        $sql = "SELECT 
                    ld.*, 
                    kh.name as ten_khach, 
                    kh.phone as sdt_khach,
                    dv.name as ten_dichvu, dv.price,
                    kg.time as gio_lam,
                    n.date as ngay_lam,
                    t.name as ten_tho
                FROM lichdat ld
                JOIN khachhang kh ON ld.khachhang_id = kh.id
                JOIN dichvu dv ON ld.dichvu_id = dv.id
                JOIN khunggio kg ON ld.khunggio_id = kg.id
                JOIN phan_cong pc ON kg.phan_cong_id = pc.id
                JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                JOIN tho t ON pc.tho_id = t.id
                ORDER BY ld.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- 3. CẬP NHẬT TRẠNG THÁI (ADMIN/NHÂN VIÊN) ---
    public function updateStatus($id, $status, $reason = null)
    {
        // Ưu tiên dùng ID để update cho chính xác
        if ($reason !== null && trim($reason) !== '') {
            $sql = "UPDATE lichdat SET status = :status, cancel_reason = :reason WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':status' => $status, ':reason' => $reason, ':id' => $id]);
        } else {
            $sql = "UPDATE lichdat SET status = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':status' => $status, ':id' => $id]);
        }
    }

    // --- 4. DÀNH CHO CLIENT: TẠO LỊCH MỚI ---
    public function insertBooking($khachhang_id, $dichvu_id, $khunggio_id, $note, $ma_lich_chung = null)
    {
        try {
            // Nếu có mã chung thì dùng, không thì tạo mới
            if ($ma_lich_chung == null) {
                $ma_lich = "ML-" . strtoupper(substr(uniqid(), -6));
            } else {
                $ma_lich = $ma_lich_chung;
            }

            $sql = "INSERT INTO lichdat (ma_lich, khachhang_id, dichvu_id, khunggio_id, note, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, 'pending', NOW())";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$ma_lich, $khachhang_id, $dichvu_id, $khunggio_id, $note]);

            return $ma_lich;
        } catch (Exception $e) {
            return false;
        }
    }

    // get by code (chi tiết khi client được chuyển sang cam on)
    // Trong LichDatModel.php

    // Sửa hàm getBookingByCode: dùng cho cam_on
    public function getBookingByCode($ma_lich)
    {
        $sql = "SELECT 
                 ld.*, 
                 dv.name as ten_dichvu, dv.price,
                 kh.name as ten_khach, kh.phone,
                 kg.time as gio_lam,
                 n.date as ngay_lam,
                 t.name as ten_tho, t.image as anh_tho,
                 ld.cancel_reason
             FROM lichdat ld
             JOIN dichvu dv ON ld.dichvu_id = dv.id
             JOIN khachhang kh ON ld.khachhang_id = kh.id
             JOIN khunggio kg ON ld.khunggio_id = kg.id
             JOIN phan_cong pc ON kg.phan_cong_id = pc.id
             JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
             JOIN tho t ON pc.tho_id = t.id
             WHERE ld.ma_lich = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_lich]);
        // 💡 SỬA: Dùng fetch() thay vì fetchAll()
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm getById (dùng cho form đánh giá) cũng cần sửa tương tự để đảm bảo trả về 1 bản ghi
    public function getById($ma_lich)
    {
        $sql = "SELECT 
                 ld.*, 
                 dv.name AS ten_dichvu, dv.price,
                 kh.name AS ten_khach, kh.phone,
                 kg.time AS gio_lam,
                 nl.date AS ngay_lam,
                 t.name AS ten_tho, t.image AS anh_tho
             FROM lichdat ld
             JOIN dichvu dv ON ld.dichvu_id = dv.id
             JOIN khachhang kh ON ld.khachhang_id = kh.id
             JOIN khunggio kg ON ld.khunggio_id = kg.id
             JOIN phan_cong pc ON pc.id = kg.phan_cong_id
             JOIN ngay_lam_viec nl ON nl.id = pc.ngay_lv_id
             JOIN tho t ON pc.tho_id = t.id
             WHERE ld.ma_lich = ?
             LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_lich]);
        // 💡 SỬA: Dùng fetch() thay vì fetchAll()
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // xem lịch sử đặt của client (có phân trang)
    public function getHistoryByCustomerPaginate($khachhang_id, $limit = 5, $offset = 0)
    {
        $sql = "SELECT 
                ld.id, ld.ma_lich, ld.status, ld.created_at, ld.cancel_reason,
                ld.rating, /* 💡 CỘT RATING ĐÃ ĐƯỢC THÊM */
                dv.name AS ten_dichvu, dv.price,
                kg.time AS gio_lam,
                n.date AS ngay_lam,
                t.name AS ten_tho
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            JOIN khunggio kg ON ld.khunggio_id = kg.id
            JOIN phan_cong pc ON kg.phan_cong_id = pc.id
            JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
            JOIN tho t ON pc.tho_id = t.id
            WHERE ld.khachhang_id = :khachhang_id
            ORDER BY n.date DESC, kg.time DESC
            LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':khachhang_id', $khachhang_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countHistoryByCustomer($khachhang_id)
    {
        $sql = "SELECT COUNT(*) as total FROM lichdat WHERE khachhang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$khachhang_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) $row['total'];
    }

    // --- 7. LẤY LỊCH SỬ THEO KHÁCH HÀNG
    public function getHistoryByCustomer($khachhang_id)
    {
        // Gọi lại hàm phân trang nhưng limit lớn để lấy hết
        return $this->getHistoryByCustomerPaginate($khachhang_id, 100, 0);
    }

    // --- 8. HỦY LỊCH ---
    public function cancelBooking($id, $khachhang_id, $reason = '')
    {
        try {
            $sql = "UPDATE lichdat 
                    SET status = 'cancelled', cancel_reason = ?
                    WHERE id = ? 
                    AND khachhang_id = ? 
                    AND status IN ('pending', 'confirmed')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$reason, $id, $khachhang_id]);
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            return false;
        }
    }

    // --- 9. LẤY THEO NHÂN VIÊN ---
    public function getByNhanVien($nhanvien_id)
    {
        // (Giữ nguyên code của bạn)
        $sql = "SELECT ld.*, 
                dv.name AS ten_dichvu, dv.price,
                kh.name AS ten_khach, kh.phone AS sdt_khach,
                kg.time AS gio_lam,
                nl.date AS ngay_lam,
                t.name AS ten_tho
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            JOIN khachhang kh ON ld.khachhang_id = kh.id
            JOIN khunggio kg ON ld.khunggio_id = kg.id
            JOIN phan_cong pc ON pc.id = kg.phan_cong_id
            JOIN ngay_lam_viec nl ON nl.id = pc.ngay_lv_id
            JOIN tho t ON pc.tho_id = t.id
            WHERE t.id = ? 
            ORDER BY ld.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nhanvien_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // --- 10. LƯU ĐÁNH GIÁ ---
    public function updateRatingAndReview($ma_lich, $rating, $comment)
    {
        // Cập nhật cột rating và review (comment)
        $sql = "UPDATE lichdat SET rating = ?, review = ? WHERE ma_lich = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rating, $comment, $ma_lich]);
    }
    // Trong LichDatModel.php

    /**
     * Kiểm tra xem khách hàng đã có lịch đặt nào cho ngày đó chưa.
     * @param int $khachhang_id ID của khách hàng
     * @param int $khunggio_id ID khung giờ (để xác định ngày)
     * @return bool True nếu đã có lịch đặt, False nếu chưa.
     */
    public function hasBookingOnSameDay($khachhang_id, $khunggio_id)
    {
        // 1. Tìm ngày làm việc (date) dựa trên khunggio_id
        $sql_get_date = "SELECT n.date
                     FROM khunggio kg
                     JOIN phan_cong pc ON kg.phan_cong_id = pc.id
                     JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                     WHERE kg.id = ? LIMIT 1";

        $stmt_date = $this->conn->prepare($sql_get_date);
        $stmt_date->execute([$khunggio_id]);
        $result = $stmt_date->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            // Không tìm thấy ngày, coi như lỗi và cho phép đặt (hoặc bạn có thể chọn fail)
            return false;
        }

        $booking_date = $result['date'];

        // 2. Kiểm tra xem khách hàng đã có lịch đặt cho ngày đó chưa (trạng thái khác 'cancelled')
        $sql_check = "SELECT COUNT(ld.id) 
                  FROM lichdat ld
                  JOIN khunggio kg_check ON ld.khunggio_id = kg_check.id
                  JOIN phan_cong pc_check ON kg_check.phan_cong_id = pc_check.id
                  JOIN ngay_lam_viec n_check ON pc_check.ngay_lv_id = n_check.id
                  WHERE ld.khachhang_id = ? 
                  AND n_check.date = ? 
                  AND ld.status != 'cancelled'
                  LIMIT 1";

        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([$khachhang_id, $booking_date]);

        return $stmt_check->fetchColumn() > 0;
    }
    //phần hiển thị lịch hẹn ở clien
    public function getUpcomingBooking($khachhang_id)
    {
        //lấy đơn khi có trạng thái đã xác nhận
        $sql = "SELECT 
                    ld.id, ld.ma_lich, ld.status,
                    kg.time as gio_lam,
                    n.date as ngay_lam,
                    t.name as ten_tho,
                    kh.phone
                FROM lichdat ld
                JOIN khunggio kg ON ld.khunggio_id = kg.id
                JOIN phan_cong pc ON kg.phan_cong_id = pc.id
                JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                JOIN tho t ON pc.tho_id = t.id
                JOIN khachhang kh ON ld.khachhang_id = kh.id
                WHERE ld.khachhang_id = ? 
                AND ld.status IN ('pending', 'confirmed')
                AND CONCAT(n.date, ' ', kg.time) > NOW() 
                ORDER BY n.date ASC, kg.time ASC
                LIMIT 1"; // Chỉ lấy 1 đơn gần nhất
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$khachhang_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>