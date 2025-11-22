<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Xếp Giờ Cho Thợ | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li class="active"><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i> Đăng Xuất
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

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <main>
            <div class="header">
                <h1>Xếp Giờ Làm Việc</h1>
                <a href="index.php?act=detail_ngay&id=<?= $info['ngay_lv_id'] ?? '' ?>" class="btnthem btn-back"
                    style="background:#ccc;color:#000">
                    ← Quay lại
                </a>
            </div>

            <div class="form-wrapper">
                <form action="index.php?act=update_times" method="POST" class="form-add">
                    <input type="hidden" name="phan_cong_id" value="<?= $info['id'] ?>">

                    <div class="form-group">
                        <label>Thông tin phân công</label>
                        <?php
                        $ngayHienThi = date('d/m/Y', strtotime($info['date']));
                        $valHienThi = $info['name'] . " - Ngày " . $ngayHienThi;
                        ?>
                        <input type="text" value="<?= htmlspecialchars($valHienThi) ?>" disabled
                            style="background-color: #e9ecef; color: #333; font-weight: bold; cursor: not-allowed;">
                    </div>

                    <div class="form-group">
                        <label>Tích chọn các khung giờ làm việc</label>

                        <div class="time-list-container" style="margin-top: 10px;">
                            <div class="row" style="margin-top:2px">
                                <?php
                                // Tạo vòng lặp giờ từ 08:00 đến 21:00
                                for ($i = 8; $i <= 21; $i++):

                                    // --- [MỚI] Tạo mảng các phút muốn hiển thị (Ví dụ: 00 và 30) ---
                                    $minutes = ['00', '30'];

                                    // Chạy vòng lặp qua các phút
                                    foreach ($minutes as $min):
                                        // Ghép giờ và phút: Ví dụ 08:00, 08:30
                                        $timeStr = str_pad($i, 2, "0", STR_PAD_LEFT) . ":" . $min;

                                        // (Tùy chọn) Nếu muốn dừng ở đúng 21:00 mà không hiện 21:30 thì thêm dòng này:
                                        if ($i == 21 && $min == '30')
                                            continue;

                                        // Kiểm tra giờ đã chọn (Logic cũ của bạn)
                                        $isChecked = in_array($timeStr, $currentTimes) ? 'checked' : '';
                                        ?>
                                        <div class="col-xl-3 col-md-4 col-6 mb-3">
                                            <label class="staff-checkbox-item">
                                                <input type="checkbox" name="times[]" value="<?= $timeStr ?>" <?= $isChecked ?>>
                                                <span class="staff-info">
                                                    <i class='bx bx-time-five'></i> <?= $timeStr ?>
                                                </span>
                                            </label>
                                        </div>

                                    <?php
                                    endforeach; // Kết thúc vòng lặp phút
                                endfor; // Kết thúc vòng lặp giờ 
                                ?>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btnthem" style="padding: 12px 30px; width: 100%; margin-top: 20px;">
                        <i class='bx bx-save'></i> Lưu Thay Đổi
                    </button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>