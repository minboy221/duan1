<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dangky-dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/responsive.css">
</head>

<body>
    <div class="container">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="dangnhap">
                <div class="title">
                    <h2>Đổi Mật Khẩu</h2>
                </div>
                
                <p style="color:#ccc; font-size:13px; margin-bottom:20px; line-height:1.5;">
                    <i class="fa-solid fa-shield-halved" style="color:#f5c542;"></i>
                    Vui lòng nhập mật khẩu hiện tại và mật khẩu mới để bảo mật tài khoản.
                </p>

                <form action="?act=doimatkhau_khachhang" method="POST" onsubmit="return validateClientChangePass();">
                    <div class="field">
                        
                        <label for="old_password">Mật khẩu hiện tại <span style="color: red;">*</span></label>
                        <input id="old_password" type="password" name="old_password" placeholder="Nhập mật khẩu hiện tại...">

                        <label for="new_password">Mật khẩu mới <span style="color: red;">*</span></label>
                        <input id="new_password" type="password" name="new_password" placeholder="Nhập mật khẩu mới...">

                        <label for="confirm_password">Xác nhận mật khẩu mới <span style="color: red;">*</span></label>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới...">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <p id="error-msg" style="color:red; margin-top:10px; font-weight: bold;"></p>
                    </div>

                    <button class="btn" type="submit" name="btn_change">
                        <i class="fa-solid fa-save"></i> Cập Nhật
                    </button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=home" class="link">Quay lại Trang Chủ</a>
                    </div>
                </form>

                <script>
                    function validateClientChangePass() {
                        let oldPassInput = document.getElementById("old_password");
                        let newPassInput = document.getElementById("new_password");
                        let confirmPassInput = document.getElementById("confirm_password");
                        let error = document.getElementById("error-msg");

                        let oldPass = oldPassInput.value;
                        let newPass = newPassInput.value;
                        let confirmPass = confirmPassInput.value;

                        error.innerText = "";
                        [oldPassInput, newPassInput, confirmPassInput].forEach(input => input.style.border = "1px solid #ccc");

                        if (oldPass === '') {
                            error.innerText = 'Vui lòng nhập mật khẩu hiện tại!';
                            oldPassInput.style.border = '1px solid red';
                            oldPassInput.focus();
                            return false;
                        }
                        if (newPass === '') {
                            error.innerText = 'Vui lòng nhập mật khẩu mới!';
                            newPassInput.style.border = '1px solid red';
                            newPassInput.focus();
                            return false;
                        }
                        if (confirmPass === '') {
                            error.innerText = 'Vui lòng xác nhận mật khẩu mới!';
                            confirmPassInput.style.border = '1px solid red';
                            confirmPassInput.focus();
                            return false;
                        }
                        if (newPass.length < 6) {
                            error.innerText = 'Mật khẩu mới phải từ 6 ký tự trở lên!';
                            newPassInput.style.border = '1px solid red';
                            newPassInput.focus();
                            return false;
                        }
                        if (newPass !== confirmPass) {
                            error.innerText = 'Mật khẩu mới và xác nhận mật khẩu không khớp!';
                            confirmPassInput.style.border = '1px solid red';
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
