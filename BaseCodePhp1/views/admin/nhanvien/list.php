<?php
// Đảm bảo $nhanviens và $roles đã được controller truyền vào
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
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

        .btnxem {
            padding: 6px 10px;
            background: #0dcaf0;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btnxem:hover {
            background: #0bb3d6;
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
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li class="active"><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
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
                <input type="hidden" name="act" value="admin-nhanvien-search">

                <div class="form-input">
                    <input type="text" name="keyword" placeholder="Tìm tên, email hoặc số điện thoại..."
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
        <!-- End of Navbar -->

        <main>
            <div class="header" style="display:flex; justify-content:space-between; align-items:center;">
                <div class="left">
                    <h1>Quản Lý Nhân Viên</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li> /
                        <li><a href="#" class="active">Quản Lý Nhân Viên</a></li>
                    </ul>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Danh Sách Nhân Viên</h3>
                        <div class="btn">
                            <a href="?act=admin-nhanvien-create" class="btnthem">+ Thêm Nhân Viên</a>
                        </div>
                    </div>
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>SDT</th>
                                <th>Giới Tính</th>
                                <th>Phân Quyền</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nhanviens as $nv): ?>
                                <tr>
                                    <td><?= htmlspecialchars($nv['name']) ?></td>
                                    <td><?= htmlspecialchars($nv['email']) ?></td>
                                    <td><?= htmlspecialchars($nv['phone'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($nv['gioitinh'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($nv['role_name'] ?? 'Chưa gán') ?></td>
                                    <td style="display:flex; gap:5px;">
                                        <!-- <a class="btnsua" href="?act=admin-nhanvien-edit&id=<?= $nv['id'] ?>">Sửa</a> -->

                                        <?php if ($nv['status'] == 1): ?>
                                            <a class="btnxoa" onclick="return confirm('Khóa tài khoản này?')"
                                                href="?act=lock_staff&id=<?= $nv['id'] ?>">
                                                Khóa
                                            </a>
                                        <?php else: ?>
                                            <a class="btnxem" style="background:#388E3C;"
                                                onclick="return confirm('Mở khóa tài khoản này?')"
                                                href="?act=unlock_staff&id=<?= $nv['id'] ?>">
                                                Mở Khóa
                                            </a>
                                        <?php endif; ?>
                                        <a href="?act=admin-nhanvien-delete&id=<?= $nv['id'] ?>" class="btnxoa">Xóa</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($nhanviens)): ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">Không có nhân viên nào</td>
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
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.getElementById('theme-toggle');
            toggler.addEventListener('change', function () {
                if (this.checked) {
                    document.body.classList.add('dark');
                } else {
                    document.body.classList.remove('dark');
                }
            });
        });
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            <?php if (isset($_SESSION['success_sa'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành Công!',
                    text: '<?= htmlspecialchars($_SESSION['success_sa']) ?>',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#388E3C', // Xanh lá
                    timer: 2000 // Tự động đóng sau 2 giây
                });
                <?php unset($_SESSION['success_sa']); // Xóa thông báo sau khi hiện xong ?>
            <?php endif; ?>

            // ----------------------------------------------------
            // 💡 LOGIC XÓA (SweetAlert2 cho nút Xóa Vĩnh viễn)
            // Thay thế hàm 'onclick="return confirm(...) " của nút Xóa
            // ----------------------------------------------------

            document.querySelector('main')?.addEventListener('click', function (event) {
                const deleteButton = event.target.closest('.btnxoa'); // Lắng nghe nút Xóa

                // Kiểm tra xem đây có phải nút xóa Nhân viên không (dựa vào href)
                if (deleteButton && deleteButton.href.includes('act=admin-nhanvien-delete')) {
                    event.preventDefault();
                    const staffName = deleteButton.closest('tr').querySelector('td:first-child').textContent.trim();
                    const deleteUrl = deleteButton.href;

                    Swal.fire({
                        title: 'Xác nhận xóa nhân viên?',
                        text: `Bạn chắc chắn muốn xóa vĩnh viễn ${staffName} ? Hành động này không thể hoàn tác.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DB504A',
                        cancelButtonColor: '#004085',
                        confirmButtonText: 'Có, Xóa!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Chuyển hướng đến URL xóa sau khi xác nhận
                            window.location.href = deleteUrl;
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>