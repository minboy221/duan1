<?php
// controllers/AdminHomeController.php
require_once './models/StatsModel.php';

class AdminHomeController
{
    public function index()
    {
        $statsModel = new StatsModel();

        // Lấy dữ liệu (đảm bảo luôn có giá trị mặc định)
        $totalStaff    = $statsModel->getTotalStaff();
        $totalBookings = $statsModel->getTotalBookings();
        $totalRevenue  = $statsModel->getTotalRevenue();
        $dailyRevenue  = $statsModel->getDailyRevenue();
        $latestBookings = $statsModel->getLatestBookings(3);

        // Include view (đường dẫn theo project của bạn)
        require_once './views/admin/HomeAdmin.php';
    }
}
