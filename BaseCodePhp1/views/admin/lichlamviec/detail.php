<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Chi Tiết Việc Làm | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <div class="left">
                    <h1>Chi Tiết Làm Việc</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Quản lý lịch</a></li>
                        /
                        <li><a href="#" class="active">Chi tiết ngày</a></li>
                    </ul>
                </div>
                <a href="index.php?act=qlylichlamviec" class="btnthem" style="background:#ccc; color:#000;">
                    <i class='bx bx-arrow-back'></i> Quay lại
                </a>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <i class='bx bx-calendar-check'></i>
                            <h3>
                                Lịch ngày:
                                <span style="color: #3C91E6;">
                                    <?= date('d/m/Y', strtotime($dayInfo['date'])) ?>
                                </span>
                            </h3>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Thợ / Stylist</th>
                                <th>Khung Giờ Đăng Ký</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listTho)): ?>
                                <?php foreach ($listTho as $index => $tho): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>

                                        <td>
                                            <div class="user-info">
                                                <?php $img = !empty($tho['image']) ? './anhtho/' . $tho['image'] : './anhmau/default-avatar.png'; ?>

                                                <img src="<?= $img ?>" class="staff-avatar" alt="Avatar"
                                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%;">

                                                <p style="font-weight: 600; margin:0; margin-left: 8px;">
                                                    <?= htmlspecialchars($tho['name']) ?>
                                                </p>
                                            </div>
                                        </td>

                                        <td>
                                            <?php if (!empty($tho['slots'])): ?>
                                                <?php foreach ($tho['slots'] as $time): ?>
                                                    <span class="time-badge">
                                                        <i class='bx bx-time-five'></i> <?= $time ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <span style="color: #999; font-style: italic; font-size: 13px;">
                                                    Chưa xếp giờ làm
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="index.php?act=edit_times&id=<?= $tho['phan_cong_id'] ?>" class="btnsua">
                                                <i class='bx bx-edit-alt'></i> Sửa Giờ
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 30px; color: #888;">
                                        <i class='bx bx-user-x'
                                            style="font-size: 40px; display: block; margin-bottom: 10px;"></i>
                                        Chưa có nhân sự nào được phân công cho ngày này.
                                    </td>
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