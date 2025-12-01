<?php
require_once './models/StatsModel.php';

class AdminHomeController
{
    public function index()
    {
        $stats = new StatsModel();

        $totalStaff     = $stats->getTotalStaff();
        $totalBookings  = $stats->getTotalBookings();
        $totalRevenue   = $stats->getTotalRevenue();
        $dailyRevenue   = $stats->getDailyRevenue();
        $latestBookings = $stats->getLatestBookings(3);

        require_once './views/admin/HomeAdmin.php';
    }
}
