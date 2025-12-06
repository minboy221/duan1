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
        /* CSS Phân trang và các nút đã có (Giữ nguyên) */
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
            color: white !important;
            border-color: #0a58ca !important;
        }
    </style>

</head>

<body>

    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-cut'></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li><a href="?act=homeadmin"><i class='bx bxs-dashboard'></i>Thống Kê</a></li>
            <li class="active"><a href="?act=qlydanhmuc"><i class='bx bx-store-alt'></i>Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
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
    <div class="content">
        <nav>
            <i class='bx bx-menu'></i>
            <form method="GET" action="index.php">
                <input type="hidden" name="act" value="qlydanhmuc">
                <div class="form-input">
                    <input type="text" name="keyword" placeholder="Tìm danh mục..."
                        value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
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
                            <?php if (!empty($categories)): ?>
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
                                            <a class="btnxoa btn-delete-cat" href="?act=delete_danhmuc&id=<?= $cat['id'] ?>"
                                                style="cursor: pointer;" data-id="<?= htmlspecialchars($cat['id']) ?>"
                                                data-name="<?= htmlspecialchars($cat['name']) ?>">
                                                Xoá
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align:center; padding:20px;">
                                        Chưa có danh mục nào.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="pagination" id="pagination"></div>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ----------------------------------------------------
            // LOGIC HIỂN THỊ THÔNG BÁO SWEETALERT2 (SESSION FLASH)
            // ----------------------------------------------------
            <?php
            // Lấy thông báo từ SESSION (Đây là trang đích)
            $success_message = $_SESSION['success_sa'] ?? '';
            $error_message = $_SESSION['error_sa'] ?? '';
            // Dọn dẹp session sau khi lấy xong
            unset($_SESSION['success_sa']);
            unset($_SESSION['error_sa']);
            ?>
            // Hiển thị thông báo Thành công
            <?php if (!empty($success_message)): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành Công!',
                    text: '<?= htmlspecialchars($success_message) ?>',
                    showConfirmButton: false,
                    timer: 3000 // Tự đóng sau 3 giây
                });
            <?php endif; ?>
            // Hiển thị thông báo Lỗi (Ví dụ: Lỗi xóa)
            <?php if (!empty($error_message)): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Thao Tác!',
                    text: '<?= htmlspecialchars($error_message) ?>',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#DB504A'
                });
            <?php endif; ?>
            // ----------------------------------------------------
            // LOGIC XÓA DÙNG SWEETALERT2 VÀ EVENT DELEGATION
            // ----------------------------------------------------
            document.querySelector('.orders')?.addEventListener('click', function (e) {
                const deleteButton = e.target.closest('.btn-delete-cat');
                if (deleteButton) {
                    e.preventDefault();
                    const url = deleteButton.getAttribute('href');
                    const catName = deleteButton.dataset.name; // Lấy tên từ data-name
                    Swal.fire({
                        title: 'Xác nhận xóa Danh mục?',
                        text: `Bạn chắc chắn muốn xoá danh mục "${catName}"? Hành động này không thể hoàn tác.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DB504A',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Có, Xóa luôn!',
                        cancelButtonText: 'Hủy'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Chuyển hướng đến URL xóa sau khi xác nhận SweetAlert2
                            window.location.href = url;
                        }
                    });
                }
            });
            // ----------------------------------------------------
            // LOGIC PHÂN TRANG (Client-side Pagination)
            // ----------------------------------------------------
            const usersPerPage = 5;
            const table = document.getElementById("userTable");
            const rows = Array.from(table.querySelectorAll("tbody tr"))
                .filter(r => r.querySelectorAll("td").length >= 3); // CHỈ lấy dòng dữ liệu

            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / usersPerPage);

            const pagination = document.getElementById("pagination");
            pagination.innerHTML = "";

            let currentPage = 1;

            function renderPage(page) {
                currentPage = page;

                // Ẩn tất cả dòng
                rows.forEach(r => r.style.display = "none");

                const start = (page - 1) * usersPerPage;
                const end = start + usersPerPage;

                // Hiện các dòng thuộc trang
                for (let i = start; i < end && i < totalRows; i++) {
                    rows[i].style.display = "";
                }

                // Active nút trang
                document.querySelectorAll("#pagination button").forEach(btn => btn.classList.remove("active"));
                document.getElementById("page-" + page).classList.add("active");
            }

            // Render nút phân trang
            if (totalPages > 1) {
                for (let i = 1; i <= totalPages; i++) {
                    let btn = document.createElement("button");
                    btn.id = "page-" + i;
                    btn.innerText = i;
                    btn.classList.add("page-btn");
                    btn.onclick = () => renderPage(i);
                    pagination.appendChild(btn);
                }
            }

            // Hiện trang đầu tiên
            renderPage(1);
        });
    </script>
</body>

</html>