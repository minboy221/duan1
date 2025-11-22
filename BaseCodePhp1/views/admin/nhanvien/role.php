<?php
$editing = isset($nv);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li class="active"><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>

        <ul class="side-menu">
            <li>
                <a href="<?= BASE_URL ?>?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i> Đăng Xuất
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- main -->
        <main>
            <div class="header">
                <h1><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên</h1>
                <a href="?act=admin-nhanvien" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <?php if (!empty($_SESSION['error'])): ?>
                    <ul style="color:red;">
                        <?php foreach ($_SESSION['error'] as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form method="POST"
                    action="<?= $editing ? "index.php?act=admin-nhanvien-update&id={$nv['id']}" : "index.php?act=admin-nhanvien-create-submit" ?>"
                    class="form-add">

                    <div class="form-group">
                        <label>Tên nhân viên</label>
                        <input type="text" name="name" value="<?= $editing ? htmlspecialchars($nv['name']) : '' ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?= $editing ? htmlspecialchars($nv['email']) : '' ?>"
                            required>
                    </div>

                    <?php if (!$editing): ?>
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input type="password" name="password" required>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" value="<?= $editing ? htmlspecialchars($nv['phone']) : '' ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Giới tính</label>
                        <select name="gioitinh" required>
                            <option value="">--Chọn giới tính--</option>
                            <option value="nam" <?= ($editing && ($nv['gioitinh'] ?? '') == 'nam') ? 'selected' : '' ?>>Nam
                            </option>
                            <option value="nu" <?= ($editing && ($nv['gioitinh'] ?? '') == 'nu') ? 'selected' : '' ?>>Nữ
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Quyền / Vai trò</label>
                        <select name="role_id" required>
                            <option value="">--Chọn quyền--</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= ($editing && isset($nv['role_id']) && $nv['role_id'] == $role['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($role['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="btnthem" style="padding:10px 25px;" type="submit">
                        <?= $editing ? 'Cập nhật' : 'Thêm Nhân Viên' ?>
                    </button>
                </form>
            </div>
        </main>
        <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>