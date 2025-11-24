<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <title>Bình luận người dùng | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <ul class="side-menu">
                <li><a href="?act=homeadmin">Thống Kê</a></li>
                <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
                <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
                <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
                <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
                <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
                <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
                <li class="active"><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
            </ul>

            <ul class="side-menu">
                <li>
                    <a href="<?= BASE_URL ?>?act=logout" class="logout">
                        <i class='bx bx-log-out-circle'></i> Đăng Xuất
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>?act=home" class="logout">
                        <i class='bx bx-log-out-circle'></i>Xem Website
                    </a>
                </li>
            </ul>
    </div>

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

        <!-- Main -->
        <main>
            <div class="bottom-data">
                <div class="header">
                    <h1>Đánh giá dịch vụ của: <?= htmlspecialchars($user['name']) ?></h1>
                    <p>Email: <?= htmlspecialchars($user['email']) ?></p>
                    <p>SĐT: <?= htmlspecialchars($user['phone']) ?></p>
                </div>
                <div class="orders">

                    <div class="header">
                        <i class='bx bx-chat'></i>
                        <h3>Danh sách đánh giá</h3>
                    </div>

                    <?php if (empty($comments)): ?>
                        <p style="padding: 10px;">Người dùng này chưa đánh giá dịch vụ nào.</p>
                    <?php else: ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Dịch Vụ</th>
                                    <th>Nội dung</th>
                                    <th>Số sao</th>
                                    <th>Ngày đánh giá</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($comments as $c): ?>
                                    <tr>
                                        <td><?= $c['id'] ?></td>
                                        <td><?= htmlspecialchars($c['ten_dichvu']) ?></td>
                                        <td><?= htmlspecialchars($c['comment']) ?></td>
                                        <td><?= str_repeat('⭐', (int)$c['rating']) ?></td>
                                        <td><?= $c['created_at'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                    <br>
                    <a href="index.php?act=qlytaikhoan" class="btnsua">← Quay lại danh sách tài khoản</a>

                </div>
            </div>

        </main>
    </div>

    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>