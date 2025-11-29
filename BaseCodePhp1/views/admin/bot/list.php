<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Chat | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li class="active"><a href="?act=qlybot">Quản Lý AI</a></li>
            <li><a href="?act=qlychat">Quản Lý Chat</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
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
                    <h1>Quản Lý Chat / Dữ Liệu Trí Tuệ Của Bot</h1>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Cấu Hình Chatbot Tự Động</h3>
                        <div class="btn">
                            <a href="?act=createbot" class="btnthem">+ Thêm Cấu Hình</a>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Từ khóa (Khách hỏi)</th>
                                            <th>Bot trả lời</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($listBot)): ?>
                                            <?php foreach ($listBot as $item): ?>
                                                <tr>
                                                    <td><?= $item['id'] ?></td>
                                                    <td>
                                                        <?php
                                                        // Tách từ khóa ra để hiển thị đẹp hơn
                                                        $keys = explode(',', $item['keywords']);
                                                        foreach ($keys as $k) {
                                                            echo '<span class="badge badge-secondary mr-1">' . trim($k) . '</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?= htmlspecialchars(mb_strimwidth($item['answer'], 0, 60, "...")) ?>
                                                    </td>
                                                    <td>
                                                        <a href="index.php?act=editbot&id=<?= $item['id'] ?>" class="btnsua">Sửa
                                                        </a>
                                                        <a href="index.php?act=deletebot&id=<?= $item['id'] ?>" class="btnxoa"
                                                            onclick="return confirm('Xóa câu này?')">Xóa
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Bot chưa được dạy gì cả.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>

</body>

</html>