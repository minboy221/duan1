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
                        
                        <label for="email">Email đăng ký</label>
                        <input id="email" type="text" name="email" placeholder="Nhập email...">

                        <label for="phone">Số điện thoại</label>
                        <input id="phone" type="text" name="phone" placeholder="Nhập số điện thoại...">

                        <label for="new_password">Mật khẩu mới</label>
                        <input id="new_password" type="password" name="new_password" placeholder="Nhập mật khẩu mới...">

                        <label for="confirm_password">Nhập lại mật khẩu</label>
                        <input id="confirm_password" type="password" name="confirm_password" placeholder="Xác nhận lại mật khẩu...">

                        <?php if (!empty($error)): ?>
                            <p style="color: red; font-style: italic; margin-top: 10px; font-weight: bold;">
                                <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                            </p>
                        <?php endif; ?>

                        <p id="error-msg" style="color:red; margin-top:10px;"></p>
                    </div>

                    <button class="btn" type="submit" name="btn_reset">Đổi Mật Khẩu</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap_khachhang" class="link">Quay lại Đăng Nhập</a>
                    </div>
                </form>

                <script>
                    function validateResetPass() {
                        // Lấy giá trị các ô input
                        let email = document.getElementById("email").value.trim();
                        let phone = document.getElementById("phone").value.trim();
                        let newPass = document.getElementById("new_password").value.trim();
                        let confirmPass = document.getElementById("confirm_password").value.trim();
                        let error = document.getElementById("error-msg");
                        
                        error.innerText = ""; // Reset lỗi

                        // 1. Kiểm tra để trống
                        if (email === "" || phone === "" || newPass === "" || confirmPass === "") {
                            error.innerText = "Vui lòng nhập đầy đủ thông tin!";
                            return false;
                        }

                        // 2. Validate Email
                        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(email)) {
                            error.innerText = "Email không đúng định dạng!";
                            return false;
                        }

                        // 3. Validate Số điện thoại (Ví dụ: 10 số)
                        let phonePattern = /(84|0[3|5|7|8|9])+([0-9]{8})\b/;
                        if (!phonePattern.test(phone)) {
                             // Nếu bạn muốn check kỹ hơn thì dùng regex trên, 
                             // còn đơn giản chỉ cần check số thì dùng: isNaN(phone)
                            error.innerText = "Số điện thoại không hợp lệ!";
                            return false;
                        }

                        // 4. Validate độ dài mật khẩu
                        if (newPass.length < 6) {
                            error.innerText = "Mật khẩu mới phải ít nhất 6 ký tự!";
                            return false;
                        }

                        // 5. Kiểm tra mật khẩu nhập lại có khớp không
                        if (newPass !== confirmPass) {
                            error.innerText = "Mật khẩu nhập lại không khớp!";
                            return false;
                        }

                        return true; // Cho phép submit
                    }
                </script>

            </div>
        </main>
    </div>
</body>

</html>