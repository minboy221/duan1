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

                        <label for="name">Họ Và Tên</label>
                        <input id="name" type="text" name="name">

                        <label for="phone">Số Điện Thoại</label>
                        <input id="phone" type="number" name="phone">

                        <label for="email">Email</label>
                        <input id="email" type="email" name="email">

                        <label for="password">Mật Khẩu</label>
                        <input id="password" type="password" name="password">
                        <!-- báo lỗi trùng email -->
                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <!-- Hiển thị lỗi -->
                        <p id="error-msg" style="color:red; margin-top:10px;"></p>
                    </div>

                    <button class="btn" type="submit">Đăng Ký</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Đăng Nhập</a>
                    </div>
                </form>

                <!-- VALIDATE JS -->
                <script>
                    function validateRegister() {
                        let name = document.getElementById("name").value.trim();
                        let phone = document.getElementById("phone").value.trim();
                        let email = document.getElementById("email").value.trim();
                        let password = document.getElementById("password").value.trim();
                        let error = document.getElementById("error-msg");

                        error.innerText = "";

                        // Validate họ tên
                        if (name === "") {
                            error.innerText = "Vui lòng nhập họ tên!";
                            return false;
                        }

                        // Validate số điện thoại
                        let phonePattern = /^(0|\+84)\d{9}$/;
                        if (!phonePattern.test(phone)) {
                            error.innerText = "Số điện thoại không hợp lệ! (VD: 0987654321)";
                            return false;
                        }

                        // Validate email
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(email)) {
                            error.innerText = "Email không hợp lệ!";
                            return false;
                        }

                        // Validate mật khẩu
                        if (password.length < 8) {
                            error.innerText = "Mật khẩu phải từ 8 ký tự trở lên!";
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