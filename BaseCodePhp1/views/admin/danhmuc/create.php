<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Thêm Danh Mục | 31Shine</title>
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

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->
        <main>
            <div class="header">
                <h1>Thêm Danh Mục</h1>
                <a href="?act=qlydanhmuc" class="btnthem btn-back">← Quay lại</a>
            </div>
            

            <div class="form-wrapper">
                <form id="formDanhMuc" action="?act=store_danhmuc" method="POST" class="form-add">

                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" name="name" id="name" placeholder="Nhập tên danh mục...">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" id="description" rows="4" placeholder="Nhập mô tả..."></textarea>
                        <span class="error-msg"></span>
                    </div>

                    <button class="btnthem btn-submit">Thêm</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        document.getElementById("formDanhMuc").addEventListener("submit", function (e) {
            let isValid = true;

            // Lấy input
            let name = document.getElementById("name");
            let description = document.getElementById("description");

            // Reset lỗi cũ
            document.querySelectorAll(".error-msg").forEach(el => el.textContent = "");
            name.classList.remove("error");
            description.classList.remove("error");

            // Validate Tên danh mục
            if (name.value.trim() === "") {
                setError(name, "Tên danh mục không được để trống");
                isValid = false;
            } else if (name.value.trim().length < 3) {
                setError(name, "Tên danh mục phải từ 3 ký tự trở lên");
                isValid = false;
            }

            // Validate Mô tả
            if (description.value.trim() === "") {
                setError(description, "Mô tả không được để trống");
                isValid = false;
            } else if (description.value.trim().length < 10) {
                setError(description, "Mô tả phải ít nhất 10 ký tự");
                isValid = false;
            }

            // Nếu có lỗi thì không submit
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Hàm set lỗi
        function setError(input, message) {
            let formGroup = input.parentElement;
            let errorMsg = formGroup.querySelector(".error-msg");
            input.classList.add("error");
            errorMsg.textContent = message;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            <?php if (isset($_SESSION['error_sa'])): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Thao Tác!',
                    text: '<?= htmlspecialchars($_SESSION['error_sa']) ?>',
                    confirmButtonText: 'Đóng',
                    confirmButtonColor: '#DB504A'
                });
                <?php unset($_SESSION['error_sa']); ?>
            <?php endif; ?>   
        });
    </script>
</body>

</html>