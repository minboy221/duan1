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

                        <label for="email">Email <span style="color: red;">*</span></label>
                        <input id="email" type="text" name="username" placeholder="Nhập email...">

                        <label for="password">Mật Khẩu <span style="color: red;">*</span></label>
                        <input id="password" type="password" name="password" placeholder="Nhập mật khẩu...">
                        
                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>
                        
                        <p id="error-msg" style="color:red; margin-top:10px; font-weight: bold;"></p>
                    </div>

                    <button class="btn" type="submit">Đăng Nhập</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangky_khachhang" class="link">Đăng Ký</a>
                        <a href="<?= BASE_URL ?>?act=quenmatkhau" class="quen">Bạn quên mật khẩu</a>
                    </div>
                </form>

                <script>
                    function validateLogin() {
                        // Lấy element input để thao tác style
                        let usernameInput = document.getElementById("email");
                        let passwordInput = document.getElementById("password");
                        
                        let username = usernameInput.value.trim();
                        let password = passwordInput.value.trim();
                        let error = document.getElementById("error-msg");
                        
                        // Reset lỗi cũ
                        error.innerText = "";
                        usernameInput.style.border = "1px solid #ccc"; // Reset viền về mặc định
                        passwordInput.style.border = "1px solid #ccc";

                        // 1. Kiểm tra để trống Email/Tên đăng nhập
                        if (username === "") {
                            error.innerText = "Vui lòng nhập email!";
                            usernameInput.style.border = "1px solid red";
                            usernameInput.focus();
                            return false;
                        }

                        // 2. Logic đặc biệt cho Admin
                        if (username === "admin") {
                            if (password === "") {
                                error.innerText = "Vui lòng nhập mật khẩu!";
                                passwordInput.style.border = "1px solid red";
                                passwordInput.focus();
                                return false;
                            }
                            return true; // Admin thì bỏ qua check định dạng email
                        }

                        // 3. Validate định dạng Email (nếu không phải admin)
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(username)) {
                            error.innerText = "Email không hợp lệ!";
                            usernameInput.style.border = "1px solid red";
                            usernameInput.focus();
                            return false;
                        }

                        // 4. Validate mật khẩu
                        if (password === "") {
                            error.innerText = "Vui lòng nhập mật khẩu!";
                            passwordInput.style.border = "1px solid red";
                            passwordInput.focus();
                            return false;
                        }
                        
                        if (password.length < 6) {
                            error.innerText = "Mật khẩu phải ít nhất 6 ký tự!";
                            passwordInput.style.border = "1px solid red";
                            passwordInput.focus();
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