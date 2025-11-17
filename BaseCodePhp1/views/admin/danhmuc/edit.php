<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Sửa Danh Mục</title>
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
            <li class="active"><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li><a href="#">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Khung Giờ</a></li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i> Đăng Xuất
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
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
                <img src="./anh/logochinh.424Z.png">
            </a>
        </nav>

        <main>
            <div class="header">
                <h1>Sửa Danh Mục</h1>
                <a href="?act=qlydanhmuc" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <div class="orders" style="padding:20px;">

                    <?php if (!empty($category)): ?>
                        <form action="?act=update_danhmuc" method="POST" class="form-add">

                            <!-- hidden input để gửi id -->
                            <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">

                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="name" value="<?= htmlspecialchars($category['name'] ?? '') ?>"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea name="description"
                                    rows="4"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
                            </div>

                            <button class="btnthem" style="padding:10px 25px;">Lưu thay đổi</button>
                        </form>
                    <?php else: ?>
                        <p style="color:red;">Danh mục không tồn tại hoặc ID không hợp lệ.</p>
                    <?php endif; ?>

                </div>
            </div>

        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>

</body>

</html>