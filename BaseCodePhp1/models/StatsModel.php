<?php
require_once './commons/function.php';

class StatsModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // phần thống kê
    public function getTotalStaff(): int
    {
        return (int)$this->conn->query("SELECT COUNT(*) FROM nhanvien")->fetchColumn();
    }

    public function getTotalBookings(): int
    {
        return (int)$this->conn->query("SELECT COUNT(DISTINCT ma_lich) FROM lichdat")->fetchColumn();
    }

    public function getDailyRevenue(): float
    {
        $sql = "SELECT SUM(price) FROM lichdat WHERE status='done' AND DATE(created_at)=CURDATE()";
        return (float)($this->conn->query($sql)->fetchColumn() ?? 0);
    }

    //thống kê hàng tháng
    // tháng và năm phải là số nguyên
    public function updateMonthlyStats(int $month, int $year)
    {
        $sql = "
            INSERT INTO thongke_tho_monthly (tho_id, `year`, `month`, total_bookings, total_revenue)
            SELECT 
                pc.tho_id,
                YEAR(ld.created_at) AS y,
                MONTH(ld.created_at) AS m,
                COUNT(*) AS total_bookings,
                SUM(ld.price) AS total_revenue
            FROM lichdat ld
            JOIN khunggio kg ON kg.id = ld.khunggio_id
            JOIN phan_cong pc ON pc.id = kg.phan_cong_id
            WHERE ld.status = 'done'
              AND MONTH(ld.created_at) = :m
              AND YEAR(ld.created_at) = :y
            GROUP BY pc.tho_id, YEAR(ld.created_at), MONTH(ld.created_at)
            ON DUPLICATE KEY UPDATE
                total_bookings = VALUES(total_bookings),
                total_revenue  = VALUES(total_revenue),
                updated_at     = NOW()
        ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':m' => $month, ':y' => $year]);
    }

    // thống kê hành tuần
    public function updateWeeklyStats(int $year)
    {
        $sql = "
            INSERT INTO thongke_tho_weekly (tho_id, `year`, `week`, total_bookings, total_revenue)
            SELECT
                pc.tho_id,
                YEAR(ld.created_at) AS y,
                WEEK(ld.created_at, 1) AS w,
                COUNT(*) AS total_bookings,
                SUM(ld.price) AS total_revenue
            FROM lichdat ld
            JOIN khunggio kg ON kg.id = ld.khunggio_id
            JOIN phan_cong pc ON pc.id = kg.phan_cong_id
            WHERE ld.status = 'done'
              AND YEAR(ld.created_at) = :y
            GROUP BY pc.tho_id, YEAR(ld.created_at), WEEK(ld.created_at, 1)
            ON DUPLICATE KEY UPDATE
                total_bookings = VALUES(total_bookings),
                total_revenue  = VALUES(total_revenue),
                updated_at     = NOW()
        ";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':y' => $year]);
    }

    // đọc doanh thu từ bảng hàng tháng (cho một tháng/năm cụ thể)
    public function getRevenueFromTKTable(int $year = null, int $month = null): float
    {
        $sql = "SELECT SUM(total_revenue) FROM thongke_tho_monthly WHERE 1=1";
        $params = [];
        if ($year !== null) {
            $sql .= " AND `year` = :y";
            $params[':y'] = $year;
        }
        if ($month !== null) {
            $sql .= " AND `month` = :m";
            $params[':m'] = $month;
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return (float)($stmt->fetchColumn() ?? 0);
    }

    // top thợ của tháng ở trong bảng
    public function getTopThoByMonth(int $year, int $month, string $search = "", int $limit = 10)
    {
        $sql = "
            SELECT s.tho_id, t.name AS ten_tho, t.image AS anh, s.total_bookings, s.total_revenue
            FROM thongke_tho_monthly s
            JOIN tho t ON t.id = s.tho_id
            WHERE s.year = :y AND s.month = :m
              AND (t.name LIKE :s)
            ORDER BY s.total_bookings DESC
            LIMIT :lim
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':y', $year, PDO::PARAM_INT);
        $stmt->bindValue(':m', $month, PDO::PARAM_INT);
        $stmt->bindValue(':s', "%{$search}%", PDO::PARAM_STR);
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // top thợ của tuần ở trong bảng
    public function getTopThoByWeek(int $year, int $week, string $search = "", int $limit = 10)
    {
        $sql = "
            SELECT w.tho_id, t.name AS ten_tho, t.image AS anh, w.total_bookings, w.total_revenue
            FROM thongke_tho_weekly w
            JOIN tho t ON t.id = w.tho_id
            WHERE w.year = :y AND w.week = :w
              AND (t.name LIKE :s)
            ORDER BY w.total_bookings DESC
            LIMIT :lim
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':y', $year, PDO::PARAM_INT);
        $stmt->bindValue(':w', $week, PDO::PARAM_INT);
        $stmt->bindValue(':s', "%{$search}%", PDO::PARAM_STR);
        $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //phần biểu đồ dữ liệu về thợ có đơn đặt
    public function getChartDataTopTho(int $year, int $month, int $limit = 10)
    {
        $rows = $this->getTopThoByMonth($year, $month, "", $limit);
        $labels = []; $values = [];
        foreach ($rows as $r) {
            $labels[] = $r['ten_tho'];
            $values[] = (int)$r['total_bookings'];
        }
        return ['labels' => $labels, 'values' => $values, 'rows' => $rows];
    }

    //biểu đồ doanh thu theo năm
    public function getRevenueChartByYear(int $year)
    {
        $sql = "
            SELECT month AS thang, SUM(total_revenue) AS revenue
            FROM thongke_tho_monthly
            WHERE year = :y
            GROUP BY month
            ORDER BY month ASC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':y' => $year]);
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // tạo 12 tháng
        $labels = []; $values = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $i;
            $values[$i] = 0.0;
        }
        foreach ($raw as $r) {
            $m = (int)$r['thang'];
            $values[$m] = (float)$r['revenue'];
        }
        $vals = [];
        for ($i = 1; $i <= 12; $i++) $vals[] = $values[$i];

        return ['labels' => $labels, 'values' => $vals];
    }

    //Biểu đồ doanh thu theo tuần trong năm
    public function getRevenueChartByYearWeekly(int $year)
    {
        $sql = "
            SELECT week AS w, SUM(total_revenue) AS revenue
            FROM thongke_tho_weekly
            WHERE year = :y
            GROUP BY week
            ORDER BY week ASC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':y' => $year]);
        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $labels = []; $values = [];
        foreach ($raw as $r) {
            $labels[] = 'W' . $r['w'];
            $values[] = (float)$r['revenue'];
        }
        return ['labels' => $labels, 'values' => $values];
    }
}
