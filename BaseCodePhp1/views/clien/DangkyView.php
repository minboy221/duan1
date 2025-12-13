<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dangky-dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
</head>

<body>
    <div class="container">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="dangnhap">
                <div class="title">
                    <h2>Đăng Ký</h2>
                </div>
                <form action="<?= BASE_URL ?>?act=dangky_khachhang" method="POST" onsubmit="return validateRegister();">
                    <div class="field">

                        <label for="name">Họ Và Tên <span style="color: red;">*</span></label>
                        <input id="name" type="text" name="name" placeholder="Nhập họ và tên...">

                        <label for="phone">Số Điện Thoại <span style="color: red;">*</span></label>
                        <input id="phone" type="number" name="phone" placeholder="Nhập số điện thoại...">

                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input id="email" type="email" name="email" placeholder="Nhập email...">

                        <label for="password">Mật Khẩu <span style="color: red;">*</span></label>
                        <input id="password" type="password" name="password" placeholder="Nhập mật khẩu...">

                        <label for="confirm_password">Nhập Lại Mật Khẩu <span style="color: red;">*</span></label>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Nhập lại mật khẩu...">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <p id="error-msg" style="color:red; margin-top:10px; font-weight: bold;"></p>
                    </div>

                    <button class="btn" type="submit">Đăng Ký</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Đăng Nhập</a>
                    </div>
                </form>

                <script>
                    function validateRegister() {
                        // Lấy giá trị và loại bỏ khoảng trắng thừa
                        let name = document.getElementById("name").value.trim();
                        let phone = document.getElementById("phone").value.trim();
                        let email = document.getElementById("email").value.trim();
                        let password = document.getElementById("password").value.trim();
                        let confirmPassword = document.getElementById("confirm_password").value.trim();
                        let error = document.getElementById("error-msg");
                        
                        // Lấy danh sách các ô input để highlight lỗi
                        let inputs = document.querySelectorAll('.field input');
                        
                        // Reset style lỗi cũ 
                        inputs.forEach(input => input.style.border = "1px solid #ccc"); 
                        error.innerText = "";

                        // Validate họ tên
                        if (name === "") {
                            error.innerText = "Vui lòng nhập họ tên!";
                            document.getElementById("name").style.border = "1px solid red"; // Viền đỏ cảnh báo
                            document.getElementById("name").focus();
                            return false;
                        }

                        // Validate số điện thoại
                        let phonePattern = /^(0|\+84)\d{9}$/;
                        if (phone === "") {
                            error.innerText = "Vui lòng nhập số điện thoại!";
                            document.getElementById("phone").style.border = "1px solid red";
                            document.getElementById("phone").focus();
                            return false;
                        } else if (!phonePattern.test(phone)) {
                            error.innerText = "Số điện thoại không hợp lệ! (VD: 0987654321)";
                            document.getElementById("phone").style.border = "1px solid red";
                            document.getElementById("phone").focus();
                            return false;
                        }

                        // Validate email
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (email === "") {
                            error.innerText = "Vui lòng nhập email!";
                            document.getElementById("email").style.border = "1px solid red";
                            document.getElementById("email").focus();
                            return false;
                        } else if (!emailPattern.test(email)) {
                            error.innerText = "Email không hợp lệ!";
                            document.getElementById("email").style.border = "1px solid red";
                            document.getElementById("email").focus();
                            return false;
                        }

                        // Validate mật khẩu
                        if (password === "") {
                            error.innerText = "Vui lòng nhập mật khẩu!";
                            document.getElementById("password").style.border = "1px solid red";
                            document.getElementById("password").focus();
                            return false;
                        } else if (password.length < 8) {
                            error.innerText = "Mật khẩu phải từ 8 ký tự trở lên!";
                            document.getElementById("password").style.border = "1px solid red";
                            document.getElementById("password").focus();
                            return false;
                        }

                        // Validate nhập lại mật khẩu
                        if (confirmPassword === "") {
                            error.innerText = "Vui lòng xác nhận lại mật khẩu!";
                            document.getElementById("confirm_password").style.border = "1px solid red";
                            document.getElementById("confirm_password").focus();
                            return false;
                        } else if (confirmPassword !== password) {
                            error.innerText = "Mật khẩu nhập lại không khớp!";
                            document.getElementById("confirm_password").style.border = "1px solid red";
                            document.getElementById("confirm_password").focus();
                            return false;
                        }

                        return true;
                    }
                </script>

            </div>
        </main>
    </div>
</body>

</html>