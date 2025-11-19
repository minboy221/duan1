<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Lịch Đặt | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <style>
        .btn.disabled, .btn.disabled:hover {
            pointer-events: none;
            opacity: 0.6;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row span.label {
            font-weight: bold;
            width: 120px;
        }
        .info-actions {
            margin-top: 20px;
        }
        .info-actions .btn {
            margin-right: 10px;
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
            <li><a href="index.php?act=nv-dashboard">Quản Lý Lịch Đặt</a></li>
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
                    <h1>Chi Tiết Lịch Đặt</h1>
                    <ul class="breadcrumb">
                        <li><a href="index.php?act=nv-dashboard">Nhân Viên</a></li> /
                        <li><a href="#" class="active">Chi Tiết Lịch Đặt</a></li>
                    </ul>
                </div>
            </div>

            <div class="bottom-data" style="padding:20px;">
                <div class="orders">
                    <h3>Thông Tin Lịch Đặt</h3>

                    <div class="info-row">
                        <span class="label">Khách:</span>
                        <span><?= htmlspecialchars($lich['ten_khach']) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Dịch vụ:</span>
                        <span><?= htmlspecialchars($lich['ten_dichvu']) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Giờ:</span>
                        <span><?= htmlspecialchars($lich['time']) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Ngày:</span>
                        <span><?= htmlspecialchars($lich['ngay_id']) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="label">Trạng thái:</span>
                        <span>
                            <?php
                                if ($lich['status'] == 0) echo '<span class="status pending">Chờ Xác Nhận</span>';
                                elseif ($lich['status'] == 1) echo '<span class="status completed">Đã Xác Nhận</span>';
                                elseif ($lich['status'] == 2) echo '<span class="status cancelled">Đã Hủy</span>';
                            ?>
                        </span>
                    </div>

                    <div class="info-actions">
                        <!-- Nút Xác Nhận -->
                        <?php if($lich['status'] != 1): ?>
                            <a class="btn btn-success" href="index.php?act=nv-xacnhan&id=<?= $lich['id'] ?>">Xác nhận</a>
                        <?php else: ?>
                            <span class="btn btn-success disabled">Xác nhận</span>
                        <?php endif; ?>

                        <!-- Nút Hủy -->
                        <?php if($lich['status'] != 1): ?>
                            <a class="btn btn-danger" href="index.php?act=nv-huy&id=<?= $lich['id'] ?>">Hủy</a>
                        <?php else: ?>
                            <span class="btn btn-secondary disabled">Hủy</span>
                        <?php endif; ?>

                        <a class="btn btn-primary" href="index.php?act=nv-dashboard">Quay lại</a>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
</html>
