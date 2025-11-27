<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập | 31Shine</title>
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
                    <h2>Đăng Nhập</h2>
                </div>
                <form action="?act=dangnhap_khachhang" method="POST" onsubmit="return validateLogin();">
                    <div class="field">

                        <label for="email">Email</label>
                        <input id="email" type="text" name="username">

                        <label for="password">Mật Khẩu</label>
                        <input id="password" type="password" name="password">
                        <!-- báo sai tài khoản mật khẩu -->
                        <!-- báo lỗi trùng email -->
                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>
                        <!-- Hiển thị lỗi -->
                        <p id="error-msg" style="color:red; margin-top:10px;"></p>
                    </div>

                    <button class="btn" type="submit">Đăng Nhập</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangky_khachhang" class="link">Đăng Ký</a>
                        <a href="<?= BASE_URL ?>?act=quenmatkhau" class="quen">?Bạn quên mật khẩu</a>
                    </div>
                </form>

                <!-- VALIDATE JAVASCRIPT -->
                <script>
                    function validateLogin() {
                        let username = document.getElementById("email").value.trim();
                        let password = document.getElementById("password").value.trim();
                        let error = document.getElementById("error-msg");
                        error.innerText = "";

                        // 1. Nếu username là "admin" thì không cần validate email
                        if (username === "admin") {
                            if (password === "") {
                                error.innerText = "Vui lòng nhập mật khẩu!";
                                return false;
                            }
                            return true; // CHO PHÉP submit
                        }

                        // 2. Ngược lại: validate email cho khách hàng
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(username)) {
                            error.innerText = "Email không hợp lệ!";
                            return false;
                        }

                        if (password.length < 6) {
                            error.innerText = "Mật khẩu phải ít nhất 6 ký tự!";
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