<?php
$editing = isset($nv);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
    <div class="content">

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
        <main>
            <div class="header">
                <h1><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên</h1>
                <a href="?act=admin-nhanvien" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <?php if (!empty($_SESSION['error'])): ?>
                    <ul style="color:red;">
                        <?php foreach ($_SESSION['error'] as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form method="POST"
                    action="<?= $editing ? "index.php?act=admin-nhanvien-update&id={$nv['id']}" : "index.php?act=admin-nhanvien-create-submit" ?>"
                    class="form-add" id="form-nhanvien">
                    <div class="form-group">
                        <label>Tên nhân viên <span style="color:red">*</span></label>
                        <input type="text" name="name" id="name"
                            value="<?= $editing ? htmlspecialchars($nv['name']) : '' ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>Email <span style="color:red">*</span></label>
                        <input type="email" name="email" id="email"
                            value="<?= $editing ? htmlspecialchars($nv['email']) : '' ?>">
                        <span class="error-msg"></span>
                    </div>

                    <?php if (!$editing): ?>
                        <div class="form-group">
                            <label>Mật khẩu <span style="color:red">*</span></label>
                            <input type="password" name="password" id="password">
                            <span class="error-msg"></span>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Số điện thoại <span style="color:red">*</span></label>
                        <input type="text" name="phone" id="phone"
                            value="<?= $editing ? htmlspecialchars($nv['phone']) : '' ?>">
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>Giới tính <span style="color:red">*</span></label>
                        <select name="gioitinh" id="gioitinh">
                            <option value="">--Chọn giới tính--</option>
                            <option value="nam" <?= ($editing && ($nv['gioitinh'] ?? '') == 'nam') ? 'selected' : '' ?>>Nam
                            </option>
                            <option value="nu" <?= ($editing && ($nv['gioitinh'] ?? '') == 'nu') ? 'selected' : '' ?>>Nữ
                            </option>
                        </select>
                        <span class="error-msg"></span>
                    </div>

                    <div class="form-group">
                        <label>Quyền / Vai trò <span style="color:red">*</span></label>
                        <select name="role_id" id="role_id">
                            <option value="">--Chọn quyền--</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= ($editing && isset($nv['role_id']) && $nv['role_id'] == $role['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($role['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="error-msg"></span>
                    </div>

                    <button class="btnthem" style="padding:10px 25px;" type="submit">
                        <?= $editing ? 'Cập nhật' : 'Thêm Nhân Viên' ?>
                    </button>
                </form>
            </div>
        </main>
        <script src="<?= BASE_URL ?>public/admin.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('form-nhanvien');

                // Hàm hiển thị lỗi (giống các form trước)
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

                // Hàm kiểm tra định dạng Email
                function isEmail(email) {
                    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }

                // Hàm kiểm tra định dạng Số điện thoại (chỉ chấp nhận số, 10-11 chữ số)
                function isPhoneNumber(phone) {
                    const re = /^(0|\+84)\d{9}$/;
                    return re.test(String(phone).trim());
                }

                // Hàm chính kiểm tra tất cả các trường
                function validateForm() {
                    let isValid = true;

                    // Lấy các element
                    const nameInput = document.getElementById('name');
                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password'); // Có thể là null nếu đang edit
                    const phoneInput = document.getElementById('phone');
                    const gioitinhInput = document.getElementById('gioitinh');
                    const roleIdInput = document.getElementById('role_id');

                    // --- 1. Validate Tên nhân viên ---
                    const nameValue = nameInput.value.trim();
                    showSuccess(nameInput); // Reset
                    if (nameValue === '') {
                        showError(nameInput, 'Tên nhân viên không được để trống.');
                        isValid = false;
                    } else if (nameValue.length < 3 || nameValue.length > 100) {
                        showError(nameInput, 'Tên phải dài từ 3 đến 100 ký tự.');
                        isValid = false;
                    }

                    // --- 2. Validate Email ---
                    const emailValue = emailInput.value.trim();
                    showSuccess(emailInput); // Reset
                    if (emailValue === '') {
                        showError(emailInput, 'Email không được để trống.');
                        isValid = false;
                    } else if (!isEmail(emailValue)) {
                        showError(emailInput, 'Email không đúng định dạng.');
                        isValid = false;
                    }

                    // --- 3. Validate Mật khẩu (Chỉ khi Thêm mới) ---
                    if (passwordInput) {
                        const passwordValue = passwordInput.value.trim();
                        showSuccess(passwordInput); // Reset
                        if (passwordValue === '') {
                            showError(passwordInput, 'Mật khẩu không được để trống.');
                            isValid = false;
                        } else if (passwordValue.length < 6) {
                            showError(passwordInput, 'Mật khẩu phải có ít nhất 6 ký tự.');
                            isValid = false;
                        }
                    }

                    // --- 4. Validate Số điện thoại ---
                    const phoneValue = phoneInput.value.trim();
                    showSuccess(phoneInput); // Reset
                    if (phoneValue === '') {
                        showError(phoneInput, 'Số điện thoại không được để trống.');
                        isValid = false;
                    } else if (!isPhoneNumber(phoneValue)) {
                        showError(phoneInput, 'Số điện thoại không hợp lệ (10 hoặc 11 chữ số).');
                        isValid = false;
                    }

                    // --- 5. Validate Giới tính ---
                    const gioitinhValue = gioitinhInput.value;
                    showSuccess(gioitinhInput); // Reset
                    if (gioitinhValue === '') {
                        showError(gioitinhInput, 'Vui lòng chọn giới tính.');
                        isValid = false;
                    }

                    // --- 6. Validate Quyền / Vai trò ---
                    const roleIdValue = roleIdInput.value;
                    showSuccess(roleIdInput); // Reset
                    if (roleIdValue === '') {
                        showError(roleIdInput, 'Vui lòng chọn quyền/vai trò.');
                        isValid = false;
                    }

                    return isValid;
                }

                // --- BẮT SỰ KIỆN SUBMIT FORM ---
                form.addEventListener('submit', function(e) {
                    if (!validateForm()) {
                        e.preventDefault(); // Chặn form submit nếu validation thất bại
                    }
                });

                // --- (Tùy chọn) Xóa lỗi khi người dùng bắt đầu nhập (UX) ---
                const inputs = form.querySelectorAll('input, select');
                inputs.forEach(input => {
                    input.addEventListener('input', function() {
                        const formGroup = this.parentElement;
                        if (formGroup.classList.contains('error')) {
                            formGroup.classList.remove('error');
                            formGroup.querySelector('.error-msg').innerText = '';
                        }
                    });
                });
                
                // 💡 LOGIC HIỂN THỊ SWEETALERT2 (BÂY GIỜ SẼ HOẠT ĐỘNG)
                <?php
                $error_message = $_SESSION['error_sa'] ?? '';
                $success_message = $_SESSION['success_sa'] ?? '';

                unset($_SESSION['error_sa']);
                unset($_SESSION['success_sa']);

                if (!empty($error_message)):
                ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi Thao Tác!',
                        html: '<?= htmlspecialchars($error_message) ?>',
                        confirmButtonText: 'Đóng',
                        confirmButtonColor: '#DB504A'
                    });
                <?php endif; ?>

                <?php if (!empty($success_message)): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành Công!',
                        text: '<?= htmlspecialchars($success_message) ?>',
                        showConfirmButton: false,
                        timer: 3000
                    });
                <?php endif; ?>
            });
        </script>
    </div>
</body>

</html>