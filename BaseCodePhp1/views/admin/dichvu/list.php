<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <title>Quản Lý Dịch Vụ | 31Shine</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
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
    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="" method="GET">
                <input type="hidden" name="act" value="qlydichvu">
                <div class="form-input">
                    <input type="text" name="keyword" placeholder="Tìm theo tên, giá, thời gian..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
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
            <div class="header">
                <div class="left">
                    <h1>Quản Lý Dịch Vụ</h1>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Dịch Vụ</h3>

                        <div class="btn">
                            <a href="?act=createdichvu" class="btnthem">+ Thêm Dịch Vụ</a>
                        </div>
                    </div>

                    <?php if (!empty($services)): ?>
                        <table id="userTable">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên Dịch Vụ</th>
                                    <th>Mô Tả</th>
                                    <th>Giá</th>
                                    <th>Thời Gian (phút)</th>
                                    <th>Danh Mục</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($services as $item): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($item['image'])): ?>
                                                <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($item['image']) ?>" width="80"
                                                    style="border-radius:8px">
                                            <?php else: ?>
                                                <span>Chưa có ảnh</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= htmlspecialchars($item['name'] ?? '') ?></td>
                                        <td><?= htmlspecialchars(substr($item['description'] ?? '', 0, 50)) ?>...</td>
                                        <td><?= !empty($item['price']) ? number_format($item['price']) . ' đ' : '' ?></td>
                                        <td><?= htmlspecialchars($item['time'] ?? '') ?> phút</td>
                                        <td><?= htmlspecialchars($item['category_name'] ?? '') ?></td>
                                        <td>
                                            <a class="btnsua"
                                                href="?act=edit_dichvu&id=<?= htmlspecialchars($item['id']) ?>">Sửa</a>
                                            <a class="btnxem"
                                                href="?act=show_dichvu&id=<?= htmlspecialchars($item['id']) ?>">Xem</a>
                                            <a class="btnxoa" onclick="return confirm('Bạn chắc chắn muốn xoá dịch vụ này?')"
                                                href="?act=delete_dichvu&id=<?= htmlspecialchars($item['id']) ?>">
                                                Xoá
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Chưa có dịch vụ nào trong hệ thống.</p>
                    <?php endif; ?>

                </div>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ----------------------------------------------------
            // LOGIC HIỂN THỊ THÔNG BÁO SWEETALERT2 (SAU KHI REDIRECT)
            // ----------------------------------------------------

            <?php if (isset($_SESSION['error_sa'])): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Xóa Dịch Vụ!',
                    text: '<?= htmlspecialchars($_SESSION['error_sa']) ?>',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#DB504A'
                });
                <?php unset($_SESSION['error_sa']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_sa'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành Công!',
                    text: '<?= htmlspecialchars($_SESSION['success_sa']) ?>',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#388E3C'
                });
                <?php unset($_SESSION['success_sa']); ?>
            <?php endif; ?>

            // ----------------------------------------------------
            // LOGIC PHÂN TRANG (PAGINATION)
            // Giữ nguyên logic phân trang client-side của bạn
            // ----------------------------------------------------

            const usersPerPage = 5;
            const table = document.getElementById("userTable");

            // Kiểm tra xem có dữ liệu hay không để tránh lỗi JS
            if (!table || table.querySelector("tbody tr") === null) {
                return;
            }

            const rows = table.querySelectorAll("tbody tr");
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / usersPerPage);

            let pagination = document.querySelector(".orders .pagination");
            if (!pagination) {
                pagination = document.createElement("div");
                pagination.classList.add("pagination");
                pagination.style.margin = "20px";
                pagination.style.textAlign = "center";
                document.querySelector(".orders").appendChild(pagination);
            }

            let currentPage = 1;

            function showPage(page) {
                currentPage = page;
                rows.forEach(r => r.style.display = "none");
                const start = (page - 1) * usersPerPage;
                const end = start + usersPerPage;

                for (let i = start; i < end && i < totalRows; i++) {
                    rows[i].style.display = "";
                }

                document.querySelectorAll(".page-btn").forEach(btn => btn.classList.remove("active"));
                document.getElementById("page-" + page)?.classList.add("active");
            }

            // Render nút phân trang
            pagination.innerHTML = '';
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
            if (totalRows > 0) {
                showPage(1);
            }
        });
    </script>
</body>

</html>