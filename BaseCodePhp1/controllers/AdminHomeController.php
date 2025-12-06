<?php
require_once './models/StatsModel.php';

class AdminHomeController
{
    public function index()
    {
        $stats = new StatsModel();

        // get filters (month/year/chartMode/week if provided)
        $month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
        $year  = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');
        $chartMode = $_GET['chartMode'] ?? 'month'; // 'month' or 'week'
        $search = $_GET['search'] ?? '';
        $week = isset($_GET['week']) ? (int)$_GET['week'] : null; // optional week number

        // ensure monthly stats exist for selected month
        $stats->updateMonthlyStats($month, $year);

        // ensure weekly stats exist for selected year
        $stats->updateWeeklyStats($year);

        // Basic stats
        $totalStaff    = $stats->getTotalStaff();
        $totalBookings = $stats->getTotalBookings();
        $dailyRevenue  = $stats->getDailyRevenue();

        // total revenue for selected month
        $totalRevenue = $stats->getRevenueFromTKTable($year, $month);

        // Top stylists (for the selected mode: month view uses monthly table)
        $topTho = $stats->getTopThoByMonth($year, $month, $search, 20);

        // Chart for top stylists (month)
        $chartTopTho = $stats->getChartDataTopTho($year, $month, 20);

        // Revenue chart: if chartMode == 'month' show 12 months; if 'week' show weeks for selected year
        if ($chartMode === 'week') {
            $revChart = $stats->getRevenueChartByYearWeekly($year);
        } else {
            $revChart = $stats->getRevenueChartByYear($year);
        }

        // Prepare arrays to pass to view
        $revenueLabels = $revChart['labels'] ?? [];
        $revenueValues = $revChart['values'] ?? [];
        $chartMode = $chartMode; // pass through

        // Pass everything to view
        require_once './views/admin/HomeAdmin.php';
    }
}
