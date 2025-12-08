<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <title>Quản Lý Dịch Vụ | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <style>
        .pagination button {
            margin: 3px;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            cursor: pointer;
            transition: 0.2s;
        }

        .pagination button:hover {
            background: #e0e0e0;
        }

        .pagination .active {
            background: #0d6efd !important;
            /* màu xanh nổi bật */
            color: white !important;
            border-color: #0a58ca !important;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li><a href="?act=qlytho"><i class='bx bx-cut'></i>Quản Lý Thợ</a></li>
            <li class="active"><a href="?act=qlytaikhoan"><i class='bx bx-group'></i>Quản Lý Người Dùng</a></li>
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

    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="" method="GET">
                <input type="hidden" name="act" value="search_user">

                <div class="form-input">
                    <input type="text" name="keyword" placeholder="Tìm email hoặc số điện thoại..."
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
        <!-- Main -->
        <main>
            <?php if (isset($_SESSION['success'])): ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: '<?= $_SESSION['success'] ?>',
                        confirmButtonText: 'OK'
                    });
                </script>
                <?php unset($_SESSION['success']);
            endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: '<?= $_SESSION['error'] ?>',
                        confirmButtonText: 'OK'
                    });
                </script>
                <?php unset($_SESSION['error']);
            endif; ?>

            <div class="header">
                <div class="left">
                    <h1>Quản Lý Người Dùng</h1>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <i class="bx bx-group"></i>
                        <h3>Người Dùng</h3>
                    </div>
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Thời Gian Tạo Tài Khoản</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($taikhoan) && is_array($taikhoan)): ?>
                                <?php foreach ($taikhoan as $p): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($p['name']) ?></td>
                                        <td><?= htmlspecialchars($p['email']) ?></td>
                                        <td><?= htmlspecialchars($p['phone']) ?></td>
                                        <td><?= htmlspecialchars($p['created_at']) ?></td>
                                        <td>
                                            <a class="btnxem" href="?act=admin-user-comment&id=<?= $p['id'] ?>"
                                                class="btn btn-info">Xem đánh giá</a>

                                            <?php if ($p['status'] == 1): ?>
                                                <a class="btnxoa" href="?act=lock_user&id=<?= $p['id'] ?>">Khóa</a>
                                            <?php else: ?>
                                                <a class="btnsua" href="?act=unlock_user&id=<?= $p['id'] ?>">Mở khóa</a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                </tbody>
                            <?php endforeach; ?>
                        </table>
                    <?php else: ?>
                        <p>Chưa có tài khoản nào trong hệ thống.</p>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>

    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        // Số user mỗi trang
        const usersPerPage = 5;

        // Lấy bảng
        const table = document.getElementById("userTable");
        const rows = table.querySelectorAll("tbody tr");
        const totalRows = rows.length;

        // Tính số trang
        const totalPages = Math.ceil(totalRows / usersPerPage);

        // Tạo thanh phân trang
        const pagination = document.createElement("div");
        pagination.classList.add("pagination");
        pagination.style.margin = "20px";
        pagination.style.textAlign = "center";
        document.querySelector(".orders").appendChild(pagination);

        function showPage(page) {
            // Ẩn toàn bộ
            rows.forEach(r => r.style.display = "none");

            // Vị trí bắt đầu – kết thúc
            const start = (page - 1) * usersPerPage;
            const end = start + usersPerPage;

            // Hiển thị đúng 5 user
            for (let i = start; i < end && i < totalRows; i++) {
                rows[i].style.display = "";
            }

            // Active nút
            document.querySelectorAll(".page-btn").forEach(btn => btn.classList.remove("active"));
            document.getElementById("page-" + page).classList.add("active");
        }

        // Render nút phân trang
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.id = "page-" + i;
            btn.classList.add("page-btn");
            btn.style.margin = "3px";
            btn.style.padding = "8px 14px";
            btn.style.borderRadius = "5px";
            btn.style.border = "1px solid #ccc";
            btn.style.cursor = "pointer";
            btn.onclick = () => showPage(i);
            pagination.appendChild(btn);
        }

        // Hiển thị trang đầu tiên
        showPage(1);
    </script>
</body>

</html>