<?php
// Đảm bảo $nhanviens và $roles đã được controller truyền vào
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="?act=homeadmin" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li><a href="#">Quản Lý Đặt Lịch</a></li>
            <li class="active"><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="#">Quản Lý Khung Giờ</a></li>
            <li><a href="?act=qlytho">Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan">Quản Lý Người Dùng</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="?act=dangxuat" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
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
        <!-- End of Navbar -->

        <main>
            <div class="header" style="display:flex; justify-content:space-between; align-items:center;">
                <div class="left">
                    <h1>Quản Lý Nhân Viên</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li> /
                        <li><a href="#" class="active">Quản Lý Nhân Viên</a></li>
                    </ul>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Danh Sách Nhân Viên</h3>
                        <div class="btn">
                            <a href="?act=admin-nhanvien-create" class="btnthem">+ Thêm Nhân Viên</a>
                        </div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>SDT</th>
                                <th>Giới Tính</th>
                                <th>Phân Quyền</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nhanviens as $nv): ?>
                                <tr>
                                    <td><?= htmlspecialchars($nv['name']) ?></td>
                                    <td><?= htmlspecialchars($nv['email']) ?></td>
                                    <td><?= htmlspecialchars($nv['phone'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($nv['gioitinh'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($nv['role_name'] ?? '') ?></td>
                                    <td style="display:flex; gap:5px;">
                                        <a class="btnsua" href="?act=admin-nhanvien-edit&id=<?= $nv['id'] ?>">Sửa</a>
                                        <?php if ($nv['role_id'] != 1): ?>
                                            <a href="?act=admin-nhanvien-delete&id=<?= $nv['id'] ?>" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">Xóa</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($nhanviens)): ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">Không có nhân viên nào</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>

    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.getElementById('theme-toggle');
            toggler.addEventListener('change', function () {
                if (this.checked) {
                    document.body.classList.add('dark');
                } else {
                    document.body.classList.remove('dark');
                }
            });
        });
    </script>
</body>

</html>