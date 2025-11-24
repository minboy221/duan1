<?php
class LichDatModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    //Phần admin lấy danh sách lịch đăt
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
    //Phần cho Admin cập nhật trạng thái
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE lichdat SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }
    //PHẦN hiển thị CLIEN tạo lịch đặt mới (mã lịch đặt bất kỳ)
    public function insertBooking($khachhang_id, $dichvu_id, $khunggio_id, $note)
    {
        try {
            //tạo mã lịch ngẫu nhiên
            $ma_lich = "ML-" . strtoupper(substr(uniqid(), -6));
            $sql = "INSERT INTO lichdat (ma_lich,khachhang_id,dichvu_id,khunggio_id,note,status) VALUES (?,?,?,?,?,'pending')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$ma_lich, $khachhang_id, $dichvu_id, $khunggio_id, $note]);
            return $ma_lich;
        } catch (Exception $e) {
            return false;
        }
    }
    //phầm lấy thông tin chi tiết để hiện thị ra clien đặt lịch thành công
    public function getBookingByCode($ma_lich)
    {
        $sql = "SELECT 
                    ld.*, 
                    dv.name as ten_dichvu, dv.price,
                    kh.name as ten_khach, kh.phone,
                    kg.time as gio_lam,
                    n.date as ngay_lam,
                    t.name as ten_tho, t.image as anh_tho
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //phần xem lịch sử đặt của clien
    public function getHistoryByCustomer($khachhang_id)
    {
        $sql = "SELECT 
                    ld.id, ld.ma_lich, ld.status, ld.created_at,
                    dv.name as ten_dichvu, dv.price,
                    kg.time as gio_hen,
                    n.date as ngay_hen,
                    t.name as ten_tho
                FROM lichdat ld
                JOIN dichvu dv ON ld.dichvu_id = dv.id
                JOIN khunggio kg ON ld.khunggio_id = kg.id
                JOIN phan_cong pc ON kg.phan_cong_id = pc.id
                JOIN ngay_lam_viec n ON pc.ngay_lv_id = n.id
                JOIN tho t ON pc.tho_id = t.id
                WHERE ld.khachhang_id = ?
                ORDER BY n.date DESC, kg.time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$khachhang_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //phần huỷ lịch đặt cho clien
    public function cancelBooking($id, $khachhang_id)
    {
        try {
            // Chỉ hủy được những đơn đang 'pending' (chờ) hoặc 'confirmed' (đã duyệt)
            // Không thể hủy đơn 'done' (đã xong) hoặc đã hủy rồi
            $sql = "UPDATE lichdat 
                    SET status = 'cancelled' 
                    WHERE id = ? 
                    AND khachhang_id = ? 
                    AND status IN ('pending', 'confirmed')";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id, $khachhang_id]);

            // rowCount() trả về số dòng bị ảnh hưởng. 
            // Nếu > 0 nghĩa là hủy thành công. Nếu = 0 nghĩa là không tìm thấy hoặc không đủ điều kiện.
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
    // Cập nhật cột rating và review (comment) trong bảng lichdat
    $sql = "UPDATE lichdat SET rating = ?, review = ? WHERE ma_lich = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([$rating, $comment, $ma_lich]);
}

}
?>