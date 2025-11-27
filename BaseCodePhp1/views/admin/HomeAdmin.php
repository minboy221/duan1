<?php
// Các biến từ AdminHomeController:
// $totalStaff, $totalBookings, $dailyRevenue, $totalRevenue, $latestBookings

$totalStaff = (int) ($totalStaff ?? 0);
$totalBookings = (int) ($totalBookings ?? 0);
$dailyRevenue = (float) ($dailyRevenue ?? 0);
$totalRevenue = (float) ($totalRevenue ?? 0);
$latestBookings = $latestBookings ?? [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">

    <title>Trang Quản Trị | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>
<style>
    .status.cancelled {
        background-color: #ff0000;
        color: #fff;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 600;

    }
</style>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="<?= BASE_URL ?>?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>?act=home" class="logout">
                    <i class='bx bx-log-out-circle'></i>Xem Website
                </a>
            </li>
        </ul>
    </div>
    <!-- End Sidebar -->

    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>

            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->

        <main>
            <ul class="insights">

                <li>
                    <i class='bx bx-group'></i>
                    <span class="info">
                        <h3><?= number_format($totalStaff) ?></h3>
                        <p>Nhân Viên</p>
                    </span>
                </li>

                <li>
                    <i class='bx bx-receipt'></i>
                    <span class="info">
                        <h3><?= number_format($totalBookings) ?></h3>
                        <p>Tổng Đơn Đặt</p>
                    </span>
                </li>

                <li>
                    <i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3><?= number_format($dailyRevenue) ?> VNĐ</h3>
                        <p>Doanh Thu Trong Ngày</p>
                    </span>
                </li>

                <li>
                    <i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3><?= number_format($totalRevenue) ?> VNĐ</h3>
                        <p>Tổng Doanh Thu</p>
                    </span>
                </li>

            </ul>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Lịch Đặt Mới Nhất</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Khách Hàng</th>
                                <th>Ngày Đặt</th>
                                <th>Dịch Vụ (Giá)</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($latestBookings)): ?>
                                <?php foreach ($latestBookings as $booking): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($booking['ten_khach'] ?? '') ?></td>

                                        <td>
                                            <?= isset($booking['created_at'])
                                                ? date('d-m-Y', strtotime($booking['created_at']))
                                                : '' ?>
                                        </td>

                                        <td><?= number_format((float) ($booking['price'] ?? 0)) ?> VNĐ</td>

                                        <td>
                                            <?php
                                            $statusMap = [
                                                'pending' => ['Chờ duyệt', 'status pending'],
                                                'confirmed' => ['Đã duyệt', 'status process'],
                                                'done' => ['Hoàn thành', 'status completed'],
                                                'cancelled' => ['Đã hủy', 'status cancelled danger'] // thêm màu đỏ
                                            ];

                                            $status = $booking['status'] ?? 'pending';
                                            $statusLabel = $statusMap[$status][0] ?? $status;
                                            $statusClass = $statusMap[$status][1] ?? 'status';
                                            ?>
                                            <span class="<?= $statusClass ?>"><?= $statusLabel ?></span>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;">Chưa có đơn đặt nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </main>

    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>