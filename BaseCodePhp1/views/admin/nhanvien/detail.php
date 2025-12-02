<?php
// $nv = thông tin nhân viên được Controller truyền sang
// $nv chứa: id, name, email, phone, gioitinh, role_name
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Nhân Viên | 31Shine</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
</head>

<style>
    .detail-container {
        background: var(--light);
        padding: 30px;
        border-radius: 16px;
        box-shadow: var(--box-shadow);
        margin-top: 20px;
        animation: fadeIn 0.3s ease;
    }

    .detail-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--dark);
    }

    .detail-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #ececec;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        width: 180px;
        font-weight: 600;
        color: #444;
    }

    .detail-value {
        flex: 1;
        color: #222;
        font-weight: 500;
    }

    .role-badge {
        padding: 6px 12px;
        background: #e9f0ff;
        color: #0d6efd;
        font-weight: 600;
        border-radius: 8px;
    }

    .btn-back {
        display: inline-block;
        margin-top: 25px;
        padding: 10px 18px;
        background: #0d6efd;
        color: #fff;
        border-radius: 10px;
        text-decoration: none;
        transition: 0.2s;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #0b5ed7;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bx bx-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li class="active"><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot">Quản Lý AI</a></li>
            <li><a href="?act=qlychat">Quản Lý Chat</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="<?= BASE_URL ?>?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i>Đăng Xuất
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>?act=home" class="logout">
                    <i class='bx bx-log-out-circle'></i>Xem Website
                </a>
            </li>
        </ul>
    </div>

    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Tìm kiếm...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="profile">
                <img src="<?= BASE_URL ?>anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->

        <main>
            <div class="detail-container">

                <h2 class="detail-title">Chi Tiết Nhân Viên</h2>

                <div class="detail-row">
                    <div class="detail-label">Họ Tên:</div>
                    <div class="detail-value"><?= htmlspecialchars($nv['name']) ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Email:</div>
                    <div class="detail-value"><?= htmlspecialchars($nv['email']) ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Số Điện Thoại:</div>
                    <div class="detail-value"><?= htmlspecialchars($nv['phone']) ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Giới Tính:</div>
                    <div class="detail-value"><?= htmlspecialchars($nv['gioitinh']) ?></div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Phân Quyền:</div>
                    <div class="detail-value">
                        <span class="role-badge">
                            <?= htmlspecialchars($nv['role_name'] ?? "Chưa phân quyền") ?>
                        </span>
                    </div>
                </div>

                <a class="btn-back" href="?act=admin-nhanvien">← Quay lại danh sách</a>
            </div>
        </main>
    </div>

    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>
</html>
