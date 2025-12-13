<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dangky-dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1(chinh)/BaseCodePhp1/anhmau/logotron.png">
</head>

<body>
    <div class="container">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="dangnhap">
                <div class="title">
                    <h2>Quên Mật Khẩu</h2>
                </div>
                
                <form action="?act=quenmatkhau" method="POST" onsubmit="return validateResetPass();">
                    <div class="field">
                        
                        <label for="email">Email đăng ký <span style="color: red;">*</span></label>
                        <input id="email" type="text" name="email" placeholder="Nhập email...">

                        <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                        <input id="phone" type="number" name="phone" placeholder="Nhập số điện thoại...">

                        <label for="new_password">Mật khẩu mới <span style="color: red;">*</span></label>
                        <input id="new_password" type="password" name="new_password" placeholder="Nhập mật khẩu mới...">

                        <label for="confirm_password">Nhập lại mật khẩu <span style="color: red;">*</span></label>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Xác nhận lại mật khẩu...">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <p id="error-msg" style="color:red; margin-top:10px; font-weight: bold;"></p>
                    </div>

                    <button class="btn" type="submit" name="btn_reset">Đổi Mật Khẩu</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Quay lại Đăng Nhập</a>
                    </div>
                </form>

                <script>
                    function validateResetPass() {
                        // Lấy thẻ input
                        let emailInput = document.getElementById("email");
                        let phoneInput = document.getElementById("phone");
                        let newPassInput = document.getElementById("new_password");
                        let confirmPassInput = document.getElementById("confirm_password");
                        let error = document.getElementById("error-msg");
                        
                        // Lấy giá trị
                        let email = emailInput.value.trim();
                        let phone = phoneInput.value.trim();
                        let newPass = newPassInput.value.trim();
                        let confirmPass = confirmPassInput.value.trim();

                        // Reset trạng thái lỗi cũ
                        error.innerText = "";
                        let inputs = [emailInput, phoneInput, newPassInput, confirmPassInput];
                        inputs.forEach(input => input.style.border = "1px solid #ccc");

                        // 1. Validate Email
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (email === "") {
                            error.innerText = "Vui lòng nhập email!";
                            emailInput.style.border = "1px solid red";
                            emailInput.focus();
                            return false;
                        } else if (!emailPattern.test(email)) {
                            error.innerText = "Email không đúng định dạng!";
                            emailInput.style.border = "1px solid red";
                            emailInput.focus();
                            return false;
                        }

                        // 2. Validate Số điện thoại
                        let phonePattern = /^(0|\+84)\d{9}$/;
                        if (phone === "") {
                            error.innerText = "Vui lòng nhập số điện thoại!";
                            phoneInput.style.border = "1px solid red";
                            phoneInput.focus();
                            return false;
                        } else if (!phonePattern.test(phone)) {
                            error.innerText = "Số điện thoại không hợp lệ! (VD: 0987654321)";
                            phoneInput.style.border = "1px solid red";
                            phoneInput.focus();
                            return false;
                        }

                        // 3. Validate Mật khẩu mới
                        if (newPass === "") {
                            error.innerText = "Vui lòng nhập mật khẩu mới!";
                            newPassInput.style.border = "1px solid red";
                            newPassInput.focus();
                            return false;
                        } else if (newPass.length < 6) {
                            error.innerText = "Mật khẩu mới phải ít nhất 6 ký tự!";
                            newPassInput.style.border = "1px solid red";
                            newPassInput.focus();
                            return false;
                        }

                        // 4. Validate Nhập lại mật khẩu
                        if (confirmPass === "") {
                            error.innerText = "Vui lòng xác nhận lại mật khẩu!";
                            confirmPassInput.style.border = "1px solid red";
                            confirmPassInput.focus();
                            return false;
                        } else if (newPass !== confirmPass) {
                            error.innerText = "Mật khẩu nhập lại không khớp!";
                            confirmPassInput.style.border = "1px solid red";
                            confirmPassInput.focus();
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