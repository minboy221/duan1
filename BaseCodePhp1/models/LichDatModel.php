<?php
class LichDatModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Phần admin lấy danh sách lịch đặt (có phân trang)
    public function getAllLichDatPaginate($limit = 10, $offset = 0)
    {
        $sql = "SELECT 
                    ld.*, 
                    kh.name as ten_khach, 
                    kh.phone as sdt_khach,
                    dv.name as ten_dichvu, dv.price,
                    kg.time as gio_lam,
                    n.date as ngay_lam,
                    t.name as ten_tho,
                    ld.cancel_reason
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
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllLichDat()
    {
        $sql = "SELECT COUNT(*) as total FROM lichdat";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    }

    // Phần admin lấy danh sách toàn bộ (không phân trang)
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

    // Phần cập nhật trạng thái (admin/nhân viên)
    public function updateStatus($id, $status, $reason = null)
    {
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

    // PHẦN hiển thị CLIENT tạo lịch đặt mới (trả về mã lịch)
    public function insertBooking($khachhang_id, $dichvu_id, $khunggio_id, $note)
    {
        try {
            $ma_lich = "ML-" . strtoupper(substr(uniqid(), -6));
            $sql = "INSERT INTO lichdat (ma_lich, khachhang_id, dichvu_id, khunggio_id, note, status, created_at) 
                    VALUES (?, ?, ?, ?, ?, 'pending', NOW())";
            $stmt = $this->conn->prepare($sql);

            // 3. Truyền biến $ma_lich vào execute
            $stmt->execute([$ma_lich, $khachhang_id, $dichvu_id, $khunggio_id, $note]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // get by code (chi tiết khi client được chuyển sang cam on)
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
                WHERE ld.ma_lich = ?
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_lich]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // xem lịch sử đặt của client (có phân trang)
  public function getHistoryByCustomerPaginate($khachhang_id, $limit = 5, $offset = 0)
    {
        $sql = "SELECT 
                    ld.id, ld.ma_lich, ld.status, ld.created_at, ld.cancel_reason,
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
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countHistoryByCustomer($khachhang_id)
    {
        $sql = "SELECT COUNT(*) as total FROM lichdat WHERE khachhang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$khachhang_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['total'];
    }

    // hủy lịch đặt client
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

    public function getByNhanVien($nhanvien_id)
    {
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRatingAndReview($ma_lich, $rating, $comment)
    {
        $sql = "UPDATE lichdat SET rating = ?, review = ? WHERE ma_lich = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$rating, $comment, $ma_lich]);
    }
}
?>
