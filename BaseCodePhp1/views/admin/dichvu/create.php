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
                <h1>Thêm Dịch Vụ</h1>
                <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">


                <form action="?act=store_dichvu" method="POST" enctype="multipart/form-data" class="form-add">
                    <div class="form-group">
                        <label>Tên dịch vụ</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Giá</label>
                        <input type="number" name="price" min="0" required>
                    </div>

                    <div class="form-group">
                        <label>Thời gian (phút)</label>
                        <input type="number" name="time" min="0">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="danhmuc_id" required>
                            <option value="">--Chọn danh mục--</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="file" name="image" accept="image/*">
                    </div>

                    <button class="btnthem" style="padding:10px 25px;">Thêm Dịch Vụ</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ----------------------------------------------------
            // LOGIC HIỂN THỊ THÔNG BÁO SWEETALERT2 (SAU KHI REDIRECT)
            // ----------------------------------------------------

            <?php
            $error_message = $_SESSION['error_sa'] ?? '';
            unset($_SESSION['error_sa']);

            if (!empty($error_message)):
                ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Thêm Dịch Vụ!',
                    html: '<?= htmlspecialchars($error_message) ?>', // Dùng html để hỗ trợ <br>
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#DB504A'
                });
            <?php endif; ?>
        });
    </script>
</body>

</html>