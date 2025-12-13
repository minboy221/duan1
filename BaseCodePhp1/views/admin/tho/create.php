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
        .form-group.error input,
        .form-group.error textarea {
            border-color: #e74c3c !important;
            /* Viền đỏ */
            background-color: #fceae9;
        }

        .form-group .error-msg {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
            font-style: italic;
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

            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->
        <main>
            <div class="header">
                <h1>Thêm Thợ</h1>
                <a href="?act=qlytho" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <h3 class="mb-4">Thêm Thợ Mới</h3>
                <form id="formTho" action="index.php?act=storetho" method="POST" enctype="multipart/form-data"
                    class="form-add">

                    <div class="form-group">
                        <label for="name">Tên thợ <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Nhập tên thợ..." >
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="image">Ảnh đại diện</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*"
                            style="padding: 5px;">
                        <small class="text-muted" style="display:block; margin-top:5px;">Chấp nhận: jpg, jpeg, png, webp
                            (Max 2MB)</small>
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label for="lylich">Lý lịch / Kinh nghiệm</label>
                        <textarea name="lylich" id="lylich" rows="4"
                            placeholder="Nhập lý lịch, kinh nghiệm..."></textarea>
                        <span class="error-msg"></span>
                    </div>

                    <button class="btnthem btn-submit" type="submit">Thêm Mới</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('formTho');

            // Hàm hiển thị lỗi (dùng class .error-msg)
            function showError(input, message) {
                const formGroup = input.parentElement;
                formGroup.classList.add('error');
                formGroup.querySelector('.error-msg').innerText = message;
            }

            // Hàm xóa lỗi
            function showSuccess(input) {
                const formGroup = input.parentElement;
                formGroup.classList.remove('error');
                formGroup.querySelector('.error-msg').innerText = '';
            }

            // Hàm kiểm tra định dạng và kích thước ảnh
            function validateImage(input) {
                const file = input.files[0];
                showSuccess(input); // Xóa lỗi cũ trước

                if (!file) return true; // Ảnh không bắt buộc, nếu không có thì bỏ qua

                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                const maxSize = 2 * 1024 * 1024; // 2MB

                // 1. Kiểm tra định dạng
                if (!allowedTypes.includes(file.type)) {
                    showError(input, 'Chỉ chấp nhận file ảnh (JPG, PNG, WEBP).');
                    return false;
                }

                // 2. Kiểm tra kích thước
                if (file.size > maxSize) {
                    showError(input, 'File ảnh quá lớn (Tối đa 2MB).');
                    return false;
                }
                return true;
            }

            // Hàm chính kiểm tra tất cả các trường
            function validateForm() {
                let isValid = true;
                const nameInput = document.getElementById('name');
                const imageInput = document.getElementById('image');
                const lylichInput = document.getElementById('lylich');

                // --- 1. Validate Tên thợ (Name) ---
                const nameValue = nameInput.value.trim();
                showSuccess(nameInput); // Reset trước khi kiểm tra

                if (nameValue === '') {
                    showError(nameInput, 'Tên thợ không được để trống.');
                    isValid = false;
                } else if (nameValue.length < 3) {
                    showError(nameInput, 'Tên thợ phải có ít nhất 3 ký tự.');
                    isValid = false;
                } else if (nameValue.length > 100) {
                    showError(nameInput, 'Tên thợ quá dài (tối đa 100 ký tự).');
                    isValid = false;
                }

                // --- 2. Validate Ảnh đại diện (Image) ---
                if (!validateImage(imageInput)) {
                    isValid = false;
                }

                // --- 3. Validate Lý lịch / Kinh nghiệm (LyLich) ---
                const lylichValue = lylichInput.value.trim();
                showSuccess(lylichInput); // Reset trước khi kiểm tra

                if (lylichValue.length > 1000) {
                    showError(lylichInput, 'Lý lịch quá dài (tối đa 1000 ký tự).');
                    isValid = false;
                }

                return isValid;
            }

            // --- BẮT SỰ KIỆN SUBMIT FORM ---
            form.addEventListener('submit', function (e) {
                if (!validateForm()) {
                    e.preventDefault(); // Chặn form submit nếu validation thất bại
                }
            });

            // --- Xóa lỗi khi người dùng bắt đầu nhập (UX) ---
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    // Lắng nghe sự kiện input/change để xóa lỗi
                    const formGroup = this.parentElement;
                    if (formGroup.classList.contains('error') && this.type !== 'file') {
                        formGroup.classList.remove('error');
                        formGroup.querySelector('.error-msg').innerText = '';
                    }
                });

                // Xử lý riêng cho input type="file"
                if (input.type === 'file') {
                    input.addEventListener('change', function () {
                        validateImage(this); // Validate lại khi file thay đổi
                    });
                }
            });
        });
    </script>
</body>

</html>