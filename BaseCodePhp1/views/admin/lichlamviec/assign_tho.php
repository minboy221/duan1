<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Phân Công Thợ | 31Shine</title>
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
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
            <li class="active"><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
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

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form method="GET" action="">
                <div class="form-input">
                    <input type="hidden" name="act" value="qlydanhmuc">
                    <input type="text" name="keyword" placeholder="Tìm danh mục..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>

        <main>
            <div class="header">
                <h1>Phân Công Thợ</h1>
                <a href="?act=qlylichlamviec" class="btnthem btn-back" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <?php
                // --- GIỮ NGUYÊN LOGIC XỬ LÝ NGÀY ---
                $ngayInfo = (new LichLamViecModel())->find($ngay_id);
                if ($ngayInfo) {
                    $timestamp = strtotime($ngayInfo['date']);
                    $thuTiengViet = [
                        1 => 'Thứ Hai', 2 => 'Thứ Ba', 3 => 'Thứ Tư',
                        4 => 'Thứ Năm', 5 => 'Thứ Sáu', 6 => 'Thứ Bảy', 7 => 'Chủ Nhật'
                    ];
                    $thu = $thuTiengViet[date('N', $timestamp)] ?? '';
                    $ngayThang = date('d/m/Y', $timestamp);
                    $hienThi = "{$thu}, {$ngayThang}";
                } else {
                    $hienThi = "Không tìm thấy ngày";
                }
                ?>

                <form action="index.php?act=store_assign" method="POST" class="form-add">
                    <input type="hidden" name="ngay_lv_id" value="<?= $ngay_id ?>">

                    <div class="form-group">
                        <label>Ngày phân công</label>
                        <input type="text" value="<?= $hienThi ?>" disabled 
                               style="background-color: #e9ecef; color: #495057; font-weight: bold; cursor: not-allowed;">
                    </div>

                    <div class="form-group">
                        <label>Chọn nhân viên làm việc</label>
                        <div class="staff-list-container" style="margin-top: 10px; max-height: 400px; overflow-y: auto; padding-right: 5px;">
                            <div class="row">
                                <?php if (!empty($allTho)): ?>
                                    <?php foreach ($allTho as $tho): ?>
                                        <?php
                                        $checked = in_array($tho['id'], $assignedIds) ? 'checked' : '';
                                        ?>
                                        <div class="col-md-6 mb-3">
                                            <label class="staff-checkbox-item">
                                                <input type="checkbox" name="tho_ids[]" value="<?= $tho['id'] ?>" <?= $checked ?>>
                                                <span class="staff-info">
                                                    <i class='bx bx-user'></i> <?= htmlspecialchars($tho['name']) ?>
                                                </span>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <p style="color:red; font-style:italic;">Chưa có nhân viên nào trong hệ thống.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnthem" style="padding: 12px 30px; width: 100%; margin-top: 20px;">
                        <i class='bx bx-save'></i> Lưu Phân Công
                    </button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>

</body>

</html>