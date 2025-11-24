<?php
// models/StatsModel.php
require_once './commons/function.php';

class StatsModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // 1. Tổng số Nhân viên (int)
    public function getTotalStaff(): int
    {
        $sql = "SELECT COUNT(id) AS total_staff FROM nhanvien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $val = $stmt->fetchColumn();
        return (int) ($val ?? 0);
    }

    // 2. Tổng số đơn đặt (Total Bookings) (int)
    public function getTotalBookings(): int
    {
        $sql = "SELECT COUNT(id) AS total_bookings FROM lichdat";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $val = $stmt->fetchColumn();
        return (int) ($val ?? 0);
    }

    // 3. Tổng Doanh Thu (float)
    public function getTotalRevenue(): float
    {
        $sql = "SELECT SUM(dv.price) AS total_revenue
                FROM lichdat ld
                JOIN dichvu dv ON ld.dichvu_id = dv.id
                WHERE ld.status = 'done'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $val = $stmt->fetchColumn();
        return (float) ($val ?? 0);
    }

    // 4. Doanh Thu Trong Ngày (float)
   public function getDailyRevenue()
{
    $sql = "SELECT SUM(dv.price) AS daily_revenue
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            JOIN khunggio kg ON ld.khunggio_id = kg.id
            JOIN phan_cong pc ON kg.phan_cong_id = pc.id
            JOIN ngay_lam_viec nl ON pc.ngay_lv_id = nl.id
            WHERE ld.status = 'done'
            AND nl.date = CURDATE()";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn() ?? 0;
}


    // 5. Latest bookings (array)
    public function getLatestBookings($limit = 3)
{
    $sql = "SELECT 
                ld.ma_lich, ld.status, ld.created_at,
                kh.name AS ten_khach,
                dv.price,
                nl.date AS ngay_lam
            FROM lichdat ld
            JOIN khachhang kh ON ld.khachhang_id = kh.id
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            JOIN khunggio kg ON ld.khunggio_id = kg.id
            JOIN phan_cong pc ON kg.phan_cong_id = pc.id
            JOIN ngay_lam_viec nl ON pc.ngay_lv_id = nl.id
            ORDER BY nl.date DESC, kg.time DESC
            LIMIT ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(1, $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
