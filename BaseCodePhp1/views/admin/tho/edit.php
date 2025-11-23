<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Sửa Thông Tin Thợ | 31Shine</title>
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
            <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li class="active"><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
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

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <main>
            <div class="header">
                <h1>Sửa Thông Tin Thợ</h1>
                <a href="?act=qlytho" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>
            <div class="form-wrapper">
                <form action="index.php?act=updatetho" method="POST" enctype="multipart/form-data" class="form-add">

                    <input type="hidden" name="id" value="<?= isset($tho['id']) ? $tho['id'] : '' ?>">

                    <div class="form-group">
                        <label>Tên thợ</label>
                        <input type="text" name="name"
                            value="<?= isset($tho['name']) ? htmlspecialchars($tho['name']) : '' ?>" required
                            class="form-control">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input type="file" name="image" class="form-control" style="padding: 5px;">

                        <?php if (!empty($tho['image'])): ?>
                            <div style="margin-top: 10px;">
                                <img src="./anhtho/<?= $tho['image'] ?>" width="100"
                                    style="border-radius: 5px; border: 1px solid #ddd;">
                                <br>
                                <small style="color: #666;">Ảnh hiện tại</small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label>Lý lịch / Kinh nghiệm</label>
                        <textarea name="lylich"
                            rows="4"><?= isset($tho['lylich']) ? htmlspecialchars($tho['lylich']) : '' ?></textarea>
                        <span class="error-msg"></span>
                    </div>

                    <button class="btnthem btn-submit" type="submit">Cập nhật</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>