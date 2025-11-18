<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Danh Mục | 31Shine</title>
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
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li class="active"><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li><a href="#">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Khung Giờ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Tài Khoản Khách Hàng</a></li>
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

            <a href="#" class="profile">
                <img src="./anh/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Quản Lý Danh Mục</h1>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Danh Mục</h3>

                        <div class="btn">
                            <a href="?act=create_danhmuc" class="btnthem">+ Thêm Danh Mục</a>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Tên Danh Mục</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($categories as $cat): ?>
                                <tr>
                                    <td>
                                        <p><?= htmlspecialchars($cat['name']) ?></p>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(mb_substr($cat['description'], 0, 60)) ?>...
                                    </td>

                                    <td>
                                        <a class="btnxem" href="?act=show_danhmuc&id=<?= $cat['id'] ?>">Xem chi tiết</a>

                                        <a class="btnsua" href="?act=edit_danhmuc&id=<?= $cat['id'] ?>">Sửa</a>

                                        <a class="btnxoa" onclick="return confirm('Bạn chắc chắn muốn xoá danh mục này?')"
                                            href="?act=delete_danhmuc&id=<?= $cat['id'] ?>">
                                            Xoá
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="3" style="text-align:center; padding:20px;">
                                        Chưa có danh mục nào.
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