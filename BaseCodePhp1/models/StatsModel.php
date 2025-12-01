<?php
require_once './commons/function.php';

class StatsModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // 1) Tổng nhân viên
    public function getTotalStaff(): int
    {
        return (int)$this->conn->query("SELECT COUNT(*) FROM nhanvien")->fetchColumn();
    }

    // 2) Tổng đơn đặt
    public function getTotalBookings(): int
    {
        return (int)$this->conn->query("SELECT COUNT(DISTINCT ma_lich) FROM lichdat")->fetchColumn();
    }

    // 3) Tổng doanh thu (sum all done)
    public function getTotalRevenue(): float
    {
        $sql = "
            SELECT SUM(dv.price) 
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            WHERE ld.status = 'done'
        ";
        return (float)($this->conn->query($sql)->fetchColumn() ?? 0);
    }

    // 4) Doanh thu trong ngày (multi service)
    public function getDailyRevenue()
{
    $sql = "SELECT SUM(dv.price) 
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            WHERE ld.status = 'done'
            AND DATE(ld.created_at) = CURDATE()";

    return (float) ($this->conn->query($sql)->fetchColumn() ?? 0);
}

    // 5) Lịch đặt mới nhất (gộp theo ma_lich)
  public function getLatestBookings($limit = 3)
{
    $sql = "
        SELECT 
            ld.ma_lich,
            kh.name AS ten_khach,
            SUM(dv.price) AS total_price,
            MIN(ld.created_at) AS created_at,

            -- LẤY TRẠNG THÁI ƯU TIÊN CAO NHẤT TRONG ĐƠN
            (
                SELECT status 
                FROM lichdat 
                WHERE ma_lich = ld.ma_lich
                ORDER BY FIELD(status, 'done','confirmed','pending','cancelled')
                LIMIT 1
            ) AS status

        FROM lichdat ld
        JOIN khachhang kh ON ld.khachhang_id = kh.id
        JOIN dichvu dv ON ld.dichvu_id = dv.id
        GROUP BY ld.ma_lich, kh.name
        ORDER BY created_at DESC
        LIMIT :limit
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
