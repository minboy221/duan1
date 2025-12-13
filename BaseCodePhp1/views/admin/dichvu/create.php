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
    <style>
        /* Style cho ô input khi có lỗi */
        .form-group.error input,
        .form-group.error select,
        .form-group.error textarea {
            border-color: #e74c3c;
            /* Viền đỏ */
            background-color: #fceae9;
        }

        .form-group .form-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
            font-style: italic;
        }

        .form-group.success input {
            border-color: #2ecc71;
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
                <form action="?act=store_dichvu" method="POST" enctype="multipart/form-data" class="form-add"
                    id="form-dichvu">

                    <div class="form-group">
                        <label>Tên dịch vụ <span style="color:red">*</span></label>
                        <input type="text" id="name" name="name" placeholder="Nhập tên dịch vụ...">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea id="description" name="description" rows="4"></textarea>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Giá (VNĐ) <span style="color:red">*</span></label>
                        <input type="number" id="price" name="price" placeholder="0">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Thời gian (phút)</label>
                        <input type="number" id="time" name="time" placeholder="VD: 60">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Danh mục <span style="color:red">*</span></label>
                        <select id="danhmuc_id" name="danhmuc_id">
                            <option value="">--Chọn danh mục--</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Ảnh đại diện</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <span class="form-message"></span>
                    </div>

                    <button type="submit" class="btnthem" style="padding:10px 25px;">Thêm Dịch Vụ</button>
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
        //phần validate
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-dichvu');

            // Hàm hiển thị lỗi
            function showError(input, message) {
                const formGroup = input.parentElement;
                const messageSpan = formGroup.querySelector('.form-message');

                formGroup.className = 'form-group error'; // Thêm class error để đổi màu đỏ
                messageSpan.innerText = message;
            }

            // Hàm xóa lỗi (khi người dùng nhập đúng)
            function showSuccess(input) {
                const formGroup = input.parentElement;
                const messageSpan = formGroup.querySelector('.form-message');

                formGroup.className = 'form-group success'; // (Tùy chọn) Thêm class success
                messageSpan.innerText = '';
            }

            // Hàm kiểm tra định dạng ảnh
            function validateImage(input) {
                const file = input.files[0];
                if (!file) return true;

                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    showError(input, 'Chỉ chấp nhận file ảnh (JPG, PNG, WEBP).');
                    return false;
                }

                if (file.size > maxSize) {
                    showError(input, 'File ảnh quá lớn (Tối đa 2MB).');
                    return false;
                }

                return true;
            }
            form.addEventListener('submit', function (e) {
                let isValid = true; // Cờ kiểm tra, mặc định là đúng

                // 1. Lấy các element
                const name = document.getElementById('name');
                const price = document.getElementById('price');
                const time = document.getElementById('time');
                const category = document.getElementById('danhmuc_id');
                const image = document.getElementById('image');

                // 2. Validate Tên Dịch Vụ
                if (name.value.trim() === '') {
                    showError(name, 'Tên dịch vụ không được để trống.');
                    isValid = false;
                } else if (name.value.trim().length < 3) {
                    showError(name, 'Tên dịch vụ phải có ít nhất 3 ký tự.');
                    isValid = false;
                } else {
                    showSuccess(name);
                }

                // 3. Validate Giá
                if (price.value === '') {
                    showError(price, 'Vui lòng nhập giá dịch vụ.');
                    isValid = false;
                } else if (parseFloat(price.value) < 0) {
                    showError(price, 'Giá dịch vụ không được âm.');
                    isValid = false;
                } else {
                    showSuccess(price);
                }

                // 4. Validate Thời Gian (nếu có nhập)
                if (time.value !== '' && parseFloat(time.value) < 0) {
                    showError(time, 'Thời gian thực hiện không được âm.');
                    isValid = false;
                } else {
                    showSuccess(time);
                }

                // 5. Validate Danh Mục
                if (category.value === '') {
                    showError(category, 'Vui lòng chọn một danh mục.');
                    isValid = false;
                } else {
                    showSuccess(category);
                }

                // 6. Validate Ảnh
                if (!validateImage(image)) {
                    isValid = false;
                } else {
                    // Nếu validateImage trả về true, ta cần xóa lỗi cũ (nếu có)
                    showSuccess(image);
                }

                // 7. Kết luận
                if (!isValid) {
                    e.preventDefault(); // CHẶN form submit nếu có lỗi
                }
                // Nếu isValid = true, form sẽ tự động gửi đi sang PHP
            });

            // (Tùy chọn) Xóa lỗi ngay khi người dùng bắt đầu nhập lại
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    // Chỉ xóa style lỗi, không cần validate lại ngay lập tức cho đỡ rối
                    const formGroup = this.parentElement;
                    if (formGroup.classList.contains('error')) {
                        formGroup.classList.remove('error');
                        formGroup.querySelector('.form-message').innerText = '';
                    }
                });
            });
        });
    </script>
</body>

</html>