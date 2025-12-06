<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Thêm Dịch Vụ | 31Shine</title>
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
            <li><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
            <li class="active"><a href="?act=qlytho"><i class='bx bx-cut'></i>Quản Lý Thợ</a></li>
            <li>><a href="?act=qlytaikhoan"><i class='bx bx-group'></i>Quản Lý Người Dùng</a></li>
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

            <form action="" method="GET">
                <input type="hidden" name="act" value="search_tho">

                <div class="form-input">
                    <input type="search" name="keyword" placeholder="Tìm thợ theo tên..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                    <button class="search-btn" type="submit">
                        <i class='bx bx-search'></i>
                    </button>
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
                <h1>Thêm Thợ</h1>
                <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <form id="formTho" action="index.php?act=storetho" method="POST" enctype="multipart/form-data"
                    class="form-add">

                    <div class="form-group">
                        <label for="name">Tên thợ</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tên thợ..." required>
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="image">Ảnh đại diện</label>
                        <input type="file" name="image" id="image" class="form-control" style="padding: 5px;">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="lylich">Lý lịch / Kinh nghiệm</label>
                        <textarea name="lylich" id="lylich" rows="4"
                            placeholder="Nhập lý lịch, kinh nghiệm..."></textarea>
                        <span class="error-msg"></span>
                    </div>

                    <button class="btnthem btn-submit" type="submit">Thêm Mới</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>