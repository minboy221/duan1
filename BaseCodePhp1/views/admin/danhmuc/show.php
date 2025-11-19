<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li class="active"><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li><a href="#">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Khung Giờ</a></li>
            <li class="active"><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>

        <ul class="side-menu">
            <li><a href="#" class="logout"><i class="bx bx-log-out-circle"></i> Đăng Xuất</a></li>
        </ul>
    </div>

    <div class="content">

        <nav>
            <i class='bx bx-menu'></i>
            <a href="#" class="notif"><i class='bx bx-bell'></i><span class="count">12</span></a>
            <a href="#" class="profile"><img src="./anh/logochinh.424Z.png"></a>
        </nav>

        <main>
            <div class="header">
                <h1>Chi Tiết Danh Mục</h1>
                <a href="?act=qlydanhmuc" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="bottom-data">
                <div class="orders" style="padding:20px;">

                    <h2><?= htmlspecialchars($category['name']) ?></h2>
                    <p style="margin-top:10px;line-height:1.6;">
                        <?= nl2br(htmlspecialchars($category['description'])) ?>
                    </p>

                    <hr style="margin:20px 0">

                    <h3>Dịch vụ thuộc danh mục này:</h3>

                    <?php if (!empty($services)): ?>
                        <ul style="margin-top:10px;padding-left:20px;">
                            <?php foreach ($services as $sv): ?>
                                <li>
                                    <?= htmlspecialchars($sv['name']) ?>
                                    — <b><?= number_format($sv['price']) ?> đ</b>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p style="color:#666;">Không có dịch vụ nào trong danh mục này.</p>
                    <?php endif; ?>

                </div>
            </div>
        </main>
    </div>

</body>

</html>