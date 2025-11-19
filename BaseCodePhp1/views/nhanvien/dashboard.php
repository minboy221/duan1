<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <style>
        .btn.disabled, .btn.disabled:hover {
            pointer-events: none;
            opacity: 0.6;
        }
        table th, table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="?act=nv_home" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="index.php?act=nv-dashboard">Quản Lý Lịch Đặt</a></li>
            <li>
                <a href="?act=dangxuat" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">4</span>
            </a>
            <a href="#" class="profile">
                <img src="./anh/logochinh.424Z.png" alt="profile">
            </a>
        </nav>

        <!-- Main -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Lịch Đặt</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Nhân Viên</a></li> /
                        <li><a href="#" class="active">Lịch Đặt</a></li>
                    </ul>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Tất Cả Lịch Đặt</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Khách Hàng</th>
                                <th>Dịch Vụ</th>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lich as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['ten_khach']) ?></td>
                                <td><?= htmlspecialchars($item['ten_dichvu']) ?></td>
                                <td><?= htmlspecialchars($item['ngay_id']) ?></td>
                                <td><?= htmlspecialchars($item['time']) ?></td>
                                <td>
                                    <?php
                                        if ($item['status'] == 0) echo '<span class="status pending">Chờ Xác Nhận</span>';
                                        elseif ($item['status'] == 1) echo '<span class="status completed">Đã Xác Nhận</span>';
                                        elseif ($item['status'] == 2) echo '<span class="status cancelled">Đã Hủy</span>';
                                    ?>
                                </td>
                                <td>
                                    <!-- Nút Xác Nhận -->
                                    <?php if($item['status'] != 1): ?>
                                        <a class="btn btn-success" href="index.php?act=nv-xacnhan&id=<?= $item['id'] ?>">Xác Nhận</a>
                                    <?php else: ?>
                                        <span class="btn btn-success disabled">Xác Nhận</span>
                                    <?php endif; ?>

                                    <!-- Nút Hủy -->
                                    <?php if($item['status'] != 1): ?>
                                        <a class="btn btn-danger" href="index.php?act=nv-huy&id=<?= $item['id'] ?>">Hủy</a>
                                    <?php else: ?>
                                        <span class="btn btn-secondary disabled">Hủy</span>
                                    <?php endif; ?>

                                    <a class="btn btn-primary" href="index.php?act=nv-chitiet&id=<?= $item['id'] ?>">Xem</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </main>
    </div>
</body>
</html>
