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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
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

            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <?php if (!empty($_SESSION['error'])): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?= $_SESSION['error']; ?>',
                    confirmButtonColor: '#d33'
                });
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: '<?= $_SESSION['success']; ?>',
                    confirmButtonColor: '#28a745'
                });
            </script>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
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

                    <table id="userTable">
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
                                        <a class="btnxoa" href="?act=delete_danhmuc&id=<?= $cat['id'] ?>"
                                            onclick="return confirmDelete(event)">
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
    <script>
        function confirmDelete(e) {
            e.preventDefault();
            const url = e.currentTarget.getAttribute('href');

            Swal.fire({
                title: 'Bạn chắc muốn xoá?',
                text: "Không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xoá luôn',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });

            return false;
        }
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