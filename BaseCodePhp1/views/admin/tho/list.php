<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Thợ | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
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

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Quản Lý Thợ</h1>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Thợ</h3>

                        <div class="btn">
                            <a href="?act=qlytho_create" class="btnthem">+ Thêm Thợ</a>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Ảnh Thợ</th>
                                <th>Tên Thợ</th>
                                <th>Ngày Tạo</th>
                                <th>Lý lịch / Kinh nghiệm</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($thoList)): ?>
                                <?php foreach ($thoList as $tho): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($tho['image'])): ?>
                                                <img src="./anhtho/<?= $tho['image'] ?>" alt="Ảnh thợ" width="80" height="80"
                                                    style="object-fit: cover; border-radius: 50%; border: 1px solid #ccc;">
                                            <?php else: ?>
                                                <span class="badge badge-secondary">Chưa có ảnh</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <Strong><?= htmlspecialchars($tho['name']) ?></Strong>
                                        </td>

                                        <td>
                                            <p><?= $tho['created_at'] ?></p>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($tho['lylich']) ?>
                                        </td>
                                        <td>
                                            <a class="btnsua" href="?act=qlytho_edit&id=<?= $tho['id'] ?>">Sửa</a>

                                            <a class="btnxoa" onclick="return confirm('Bạn chắc chắn muốn xoá thợ này?')"
                                                href="?act=qlytho_delete&id=<?= $tho['id'] ?>">
                                                Xoá
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align:center; padding:20px;">
                                        Chưa có thợ nào.
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