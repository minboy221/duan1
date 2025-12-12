<?php
require_once './models/StatsModel.php';

class AdminHomeController
{
    public function index()
    {
        $stats = new StatsModel();

        //phần bộ lọc doanh thu
        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
        $year  = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
        $chartMode = $_GET['chartMode'] ?? 'month'; // 'month' or 'week'
        $search = $_GET['search'] ?? '';
        $week = isset($_GET['week']) ? (int)$_GET['week'] : null; //phần chọn số tuần

        $stats->updateMonthlyStats($month, $year);

        $stats->updateWeeklyStats($year);

        // phần thống kê
        $totalStaff    = $stats->getTotalStaff();
        $totalBookings = $stats->getTotalBookings();
        $dailyRevenue  = $stats->getDailyRevenue();

        // phần tổng doanh thu của tháng đã chọn
        $totalRevenue = $stats->getRevenueFromTKTable($year, $month);

        // Phần hiển thị thợ cắt nhiều nhất xem theo tháng
        $topTho = $stats->getTopThoByMonth($year, $month, $search, 20);

        // phần bảng xếp hạng thợ được đặt nhiều
        $chartTopTho = $stats->getChartDataTopTho($year, $month, 20);

        //phần biểu đồ doanh thu: nếu chartMode == 'month' thì hiển thị 12 tháng; nếu là 'week' thì hiển thị các tuần trong năm đã chọn.
        if ($chartMode === 'week') {
            $revChart = $stats->getRevenueChartByYearWeekly($year);
        } else {
            $revChart = $stats->getRevenueChartByYear($year);
        }

        // chuẩn bị các mảng để truyền vào view
        $revenueLabels = $revChart['labels'] ?? [];
        $revenueValues = $revChart['values'] ?? [];
        $chartMode = $chartMode; // pass through

        // Pass everything to view
        require_once './views/admin/HomeAdmin.php';
    }
}
