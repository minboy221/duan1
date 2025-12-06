<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/showdichvu.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Thêm Danh Mục</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-cut'></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li><a href="?act=homeadmin"><i class='bx bxs-dashboard'></i>Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc"><i class='bx bx-store-alt'></i>Quản Lý Danh Mục</a></li>
            <li class="active"><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
            <li><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho"><i class='bx bx-cut'></i>Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan"><i class='bx bx-group'></i>Quản Lý Người Dùng</a></li>
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
                    <i class='bx bx-home-alt-2'></i>Xem Website
                </a>
            </li>
        </ul>
    </div>
    <!-- End Sidebar -->
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

            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->
        <main>
            <div class="header">
                <h1>Chi Tiết Dịch Vụ</h1>
                <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>
            <?php if (!empty($service)): ?>
                <div class="service-detail">
                    <h2><?= htmlspecialchars($service['name'] ?? '') ?></h2>
                    <p><strong>Danh mục:</strong> <?= htmlspecialchars($service['category_name'] ?? '') ?></p>
                    <p><strong>Giá:</strong>
                        <?= !empty($service['price']) ? number_format($service['price']) . ' đ' : '' ?></p>
                    <p><strong>Thời gian:</strong> <?= htmlspecialchars($service['time'] ?? '') ?> phút</p>
                    <p><strong>Mô tả:</strong> <?= htmlspecialchars($service['description'] ?? '') ?></p>
                    <?php if (!empty($service['image'])): ?>
                        <p><img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($service['image']) ?>" width="200"
                                style="border-radius:8px;"></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p style="color:red;">Dịch vụ không tồn tại.</p>
            <?php endif; ?>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>