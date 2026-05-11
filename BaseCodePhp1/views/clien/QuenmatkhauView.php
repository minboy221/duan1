<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dangky-dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/responsive.css">
</head>

<body>
    <div class="container">
        <div class="background">
            <img src="<?= BASE_URL ?>anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="dangnhap">
                <div class="title">
                    <h2>Quên Mật Khẩu</h2>
                </div>
                
                <p style="color:#ccc; font-size:13px; margin-bottom:20px; line-height:1.5;">
                    <i class="fa-solid fa-circle-info" style="color:#f5c542;"></i>
                    Nhập email và số điện thoại đã đăng ký. Chúng tôi sẽ gửi mã OTP xác thực về email của bạn.
                </p>

                <form action="?act=quenmatkhau" method="POST" onsubmit="return validateResetPass();">
                    <div class="field">
                        
                        <label for="email">Email đăng ký <span style="color: red;">*</span></label>
                        <input id="email" type="text" name="email" placeholder="Nhập email...">

                        <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                        <input id="phone" type="number" name="phone" placeholder="Nhập số điện thoại...">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <p id="error-msg" style="color:red; margin-top:10px; font-weight: bold;"></p>
                    </div>

                    <button class="btn" type="submit" name="btn_reset">
                        <i class="fa-solid fa-paper-plane"></i> Gửi Mã OTP
                    </button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Quay lại Đăng Nhập</a>
                    </div>
                </form>

                <script>
                    function validateResetPass() {
                        let emailInput = document.getElementById("email");
                        let phoneInput = document.getElementById("phone");
                        let error = document.getElementById("error-msg");
                        
                        let email = emailInput.value.trim();
                        let phone = phoneInput.value.trim();

                        error.innerText = "";
                        [emailInput, phoneInput].forEach(input => input.style.border = "1px solid #ccc");

                        // Validate Email
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

                        // Validate SĐT
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

                        return true;
                    }
                </script>

            </div>
        </main>
    </div>
</body>

</html>