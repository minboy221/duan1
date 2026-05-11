<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu | 31Shine</title>
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
                    <h2><i class="fa-solid fa-key" style="margin-right:8px;"></i>Đặt Lại Mật Khẩu</h2>
                </div>

                <p style="color:#51cf66; font-size:13px; margin-bottom:20px;">
                    <i class="fa-solid fa-circle-check"></i> Xác thực OTP thành công! Hãy nhập mật khẩu mới.
                </p>

                <form action="?act=reset_password" method="POST" onsubmit="return validateNewPass();">
                    <div class="field">

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

                    <button class="btn" type="submit">
                        <i class="fa-solid fa-check"></i> Đổi Mật Khẩu
                    </button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Quay lại Đăng Nhập</a>
                    </div>
                </form>

                <script>
                    function validateNewPass() {
                        let newPass = document.getElementById("new_password");
                        let confirmPass = document.getElementById("confirm_password");
                        let error = document.getElementById("error-msg");

                        error.innerText = "";
                        [newPass, confirmPass].forEach(i => i.style.border = "1px solid #ccc");

                        if (newPass.value.trim() === "") {
                            error.innerText = "Vui lòng nhập mật khẩu mới!";
                            newPass.style.border = "1px solid red";
                            newPass.focus();
                            return false;
                        }
                        if (newPass.value.trim().length < 6) {
                            error.innerText = "Mật khẩu phải ít nhất 6 ký tự!";
                            newPass.style.border = "1px solid red";
                            newPass.focus();
                            return false;
                        }
                        if (confirmPass.value.trim() === "") {
                            error.innerText = "Vui lòng xác nhận mật khẩu!";
                            confirmPass.style.border = "1px solid red";
                            confirmPass.focus();
                            return false;
                        }
                        if (newPass.value !== confirmPass.value) {
                            error.innerText = "Mật khẩu nhập lại không khớp!";
                            confirmPass.style.border = "1px solid red";
                            confirmPass.focus();
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
