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
                <form>
                    <div class="field">
                        <label for="name">Họ Và Tên</label>
                        <input id="name" type="text">

                        <label for="phone">Số Điện Thoại</label>
                        <input id="phone" type="number">

                        <label for="email">Email</label>
                        <input id="email" type="email">

                        <label for="password">Mật Khẩu</label>
                        <input id="password" type="password">
                    </div>
                    <button class="btn" type="submit">Đăng Ký</button>

                    <div class="footer">
                        <a href="<?= BASE_URL ?>?act=dangnhap" class="link">Đăng Nhập</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>

</html>