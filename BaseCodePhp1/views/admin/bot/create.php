<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Thêm Cấu Hình Cho Bot | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .form-group.error input,
        .form-group.error textarea {
            border-color: #e74c3c !important;
            background-color: #fceae9;
        }

        .form-group .form-message {
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
            <li class="active"><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
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
                <h1>Thêm Cấu Hình</h1>
                <a href="?act=qlybot" class="btnthem btn-back">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <h3 class="mb-4">Dạy Bot Câu Trả Lời Mới</h3>

                <form action="index.php?act=storebot" method="POST" class="form-add" id="form-bot-answer">

                    <div class="form-group">
                        <label>Từ khóa nhận diện (Phân cách bằng dấu phẩy): <span style="color:red">*</span></label>
                        <input type="text" name="keywords" id="keywords" class="form-control"
                            placeholder="VD: giá, bao nhiêu tiền, chi phí" =>
                        <small class="text-muted">Khi khách chat có chứa 1 trong các từ này, Bot sẽ trả lời câu bên
                            dưới.</small>
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label>Nội dung Bot trả lời: <span style="color:red">*</span></label>
                        <textarea name="answer" id="answer" rows="4" class="form-control"
                            placeholder="VD: Dạ, cắt tóc bên em giá 100k ạ..."></textarea>
                        <span class="form-message"></span>
                    </div>

                    <button type="submit" class="btnthem btn-submit">Lưu Lại</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('form-bot-answer');

            // Hàm hiển thị lỗi
            function showError(input, message) {
                const formGroup = input.parentElement;
                // Thêm class 'error' vào form-group
                formGroup.classList.add('error');
                // Tìm và điền thông báo lỗi vào span.form-message
                formGroup.querySelector('.form-message').innerText = message;
            }

            // Hàm xóa lỗi (khi người dùng sửa lỗi)
            function showSuccess(input) {
                const formGroup = input.parentElement;
                // Xóa class 'error'
                formGroup.classList.remove('error');
                formGroup.querySelector('.form-message').innerText = '';
            }

            // Hàm chính kiểm tra tất cả các trường
            function validateForm() {
                let isValid = true;
                const keywordsInput = document.getElementById('keywords');
                const answerInput = document.getElementById('answer');

                // --- 1. Validate Từ khóa (Keywords) ---
                const keywordsValue = keywordsInput.value.trim();
                if (keywordsValue === '') {
                    showError(keywordsInput, 'Từ khóa không được để trống.');
                    isValid = false;
                } else {
                    // Tách, làm sạch và lọc các từ khóa rỗng
                    const keywordArray = keywordsValue.split(',').map(kw => kw.trim()).filter(kw => kw.length > 0);

                    if (keywordArray.length === 0) {
                        showError(keywordsInput, 'Vui lòng nhập từ khóa và phân cách bằng dấu phẩy.');
                        isValid = false;
                    } else {
                        let hasLongKeyword = false;
                        keywordArray.forEach(kw => {
                            // Kiểm tra độ dài từng từ khóa
                            if (kw.length > 50) {
                                showError(keywordsInput, 'Mỗi từ khóa không được vượt quá 50 ký tự.');
                                isValid = false;
                                hasLongKeyword = true;
                            }
                        });
                        if (!hasLongKeyword) {
                            showSuccess(keywordsInput);
                        }
                    }
                }

                // --- 2. Validate Câu trả lời (Answer) ---
                const answerValue = answerInput.value.trim();
                if (answerValue === '') {
                    showError(answerInput, 'Nội dung trả lời không được để trống.');
                    isValid = false;
                } else if (answerValue.length < 10) {
                    showError(answerInput, 'Nội dung trả lời quá ngắn (tối thiểu 10 ký tự).');
                    isValid = false;
                } else if (answerValue.length > 2000) {
                    showError(answerInput, 'Nội dung trả lời quá dài (tối đa 2000 ký tự).');
                    isValid = false;
                } else {
                    showSuccess(answerInput);
                }

                return isValid;
            }

            // --- BẮT SỰ KIỆN SUBMIT FORM ---
            form.addEventListener('submit', function (e) {
                if (!validateForm()) {
                    e.preventDefault(); // Chặn form submit nếu validation thất bại
                }
            });

            // --- (Tùy chọn) Xóa lỗi khi người dùng bắt đầu nhập ---
            const inputs = form.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function () {
                    // Chỉ cần xóa lỗi (không cần validate lại toàn bộ)
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