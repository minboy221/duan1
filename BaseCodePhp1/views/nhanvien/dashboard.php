<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="?act=nv_home" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="index.php?act=nv-dashboard">Quản Lý Lịch Đặt</a></li>
            <li class="<?= ($_GET['act'] ?? '') == 'doimatkhau_nhanvien' ? 'active' : '' ?>">
                <a href="index.php?act=doimatkhau_nhanvien">Đổi Mật Khẩu</a>
            </li>
            <li>
                <a href="?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
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
        <!-- Main -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Lịch Đặt</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Nhân Viên</a></li> /
                        <li><a href="#" class="active">Lịch Đặt</a></li>
                    </ul>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Tất Cả Lịch Đặt</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Mã Lịch</th>
                                <th>Khách Hàng</th>
                                <th>Dịch Vụ</th>
                                <th>Thời Gian & Thợ</th>
                                <th>Ghi Chú</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($lich)): ?>
                                <?php foreach ($lich as $item): ?>
                                    <tr>
                                        <td>
                                            <span style="font-weight: bold; color: #555;">
                                                #<?= htmlspecialchars($item['ma_lich']) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <div style="display:flex; align-items:center; gap:10px;">
                                                <div
                                                    style="width:35px; height:35px; background:#eee; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                                                    <i class='bx bx-user'></i>
                                                </div>
                                                <div>
                                                    <p style="font-weight:600; margin:0;">
                                                        <?= htmlspecialchars($item['ten_khach']) ?>
                                                    </p>
                                                    <small
                                                        style="color:#888;"><?= htmlspecialchars($item['sdt_khach']) ?></small>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <p style="margin:0;"><?= htmlspecialchars($item['ten_dichvu']) ?></p>
                                            <strong style="color: #DB504A;"><?= number_format($item['price']) ?> đ</strong>
                                        </td>

                                        <td>
                                            <div style="font-size:13px;">
                                                <div style="margin-bottom:4px;">
                                                    <i class='bx bx-calendar'></i>
                                                    <?= date('d/m/Y', strtotime($item['ngay_lam'])) ?>
                                                </div>
                                                <div style="margin-bottom:4px;">
                                                    <i class='bx bx-time'></i> <strong><?= $item['gio_lam'] ?></strong>
                                                </div>
                                                <div style="color:#3C91E6;">
                                                    <i class='bx bx-cut'></i> <?= htmlspecialchars($item['ten_tho']) ?>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span style="color:#666; font-style:italic; font-size:13px;">
                                                <?= !empty($item['note']) ? htmlspecialchars($item['note']) : '---' ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?php
                                            $st = $item['status'];
                                            $class = 'status-pending';
                                            $text = 'Chờ duyệt';

                                            if ($st == 'confirmed') {
                                                $class = 'status-confirmed';
                                                $text = 'Đã duyệt';
                                            }
                                            if ($st == 'done') {
                                                $class = 'status-done';
                                                $text = 'Hoàn thành';
                                            }
                                            if ($st == 'cancelled') {
                                                $class = 'status-cancelled';
                                                $text = 'Đã hủy';
                                            }
                                            ?>
                                            <span class="status-badge <?= $class ?>"><?= $text ?></span>
                                        </td>

                                        <td>
                                            <form action="index.php?act=update_status_nv" method="POST"
                                                style="display:inline-block">
                                                <input type="hidden" name="id" value="<?= $item['id'] ?>">

                                                <?php if ($st == 'pending'): ?>
                                                    <button name="status" value="confirmed" class="btn-action btn-approve"
                                                        title="Duyệt">
                                                        <i class='bx bx-check'></i>
                                                    </button>
                                                    <button name="status" value="cancelled" class="btn-action btn-cancel"
                                                        title="Hủy" onclick="return confirm('Hủy lịch này?')">
                                                        <i class='bx bx-x'></i>
                                                    </button>

                                                <?php elseif ($st == 'confirmed'): ?>
                                                    <button name="status" value="done" class="btn-action btn-complete"
                                                        title="Hoàn thành">
                                                        <i class='bx bx-check-double'></i>
                                                    </button>
                                                    <button name="status" value="cancelled" class="btn-action btn-cancel"
                                                        title="Hủy" onclick="return confirm('Hủy lịch này?')">
                                                        <i class='bx bx-x'></i>
                                                    </button>

                                                <?php else: ?>
                                                    <span style="color:#ccc; font-size:20px;"><i class='bx bx-lock-alt'></i></span>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" style="text-align:center; padding:30px; color:#888;">
                                        <i class='bx bx-calendar-x'
                                            style="font-size:40px; display:block; margin-bottom:10px;"></i>
                                        Chưa có lịch đặt nào.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>