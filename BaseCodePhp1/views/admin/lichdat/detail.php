<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Đặt Lịch #<?= $info['ma_lich'] ?></title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">

    <style>
        .detail-container {
            background: var(--light);
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--box-shadow);
            margin-top: 25px;
        }

        .detail-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .detail-box {
            padding: 14px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .detail-label {
            font-weight: 600;
            color: #444;
        }

        .status-badge {
            display: inline-block;
            padding: 7px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .confirmed {
            background: #cce5ff;
            color: #004085;
        }

        .done {
            background: #d4edda;
            color: #155724;
        }

        .cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            margin-top: 14px;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ececec;
        }

        th {
            background: #f6f8fc;
            text-align: left;
        }

        .total {
            color: #e74a3b;
            font-weight: 700;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: #0d6efd;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-back:hover {
            background: #0a58ca;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-cut'></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li><a href="?act=homeadmin"><i class='bx bxs-dashboard'></i>Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc"><i class='bx bx-store-alt'></i>Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li class="active"><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
            <li><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho"><i class='bx bx-cut'></i>Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan"><i class='bx bx-group'></i>Quản Lý Người Dùng</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="<?= BASE_URL ?>?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>?act=home" class="logout">
                    <i class='bx bx-home-alt-2'></i>Xem Website
                </a>
            </li>
        </ul>
    </div>
    <!-- Main -->
    <div class="content">

        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form>
                <div class="form-input">
                    <input type="search" placeholder="Tìm kiếm...">
                    <button type="submit" class="search-btn">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="profile">
                <img src="<?= BASE_URL ?>anhmau/logochinh.424Z.png">
            </a>
        </nav>

        <main>
            <div class="detail-container">

                <h2 class="detail-title">Chi Tiết Đơn Đặt Lịch</h2>

                <div class="detail-box">
                    <span class="detail-label">Mã Lịch:</span>
                    <div>#<?= $info['ma_lich'] ?></div>
                </div>

                <div class="detail-box">
                    <span class="detail-label">Khách Hàng:</span>
                    <div><?= htmlspecialchars($info['ten_khach']) ?> - <?= htmlspecialchars($info['phone']) ?></div>
                </div>

                <div class="detail-box">
                    <span class="detail-label">Thợ:</span>
                    <div><?= htmlspecialchars($info['ten_tho']) ?></div>
                </div>
                <div class="detail-box">
                    <span class="detail-label">Khách Hàng Ghi Chú:</span>
                    <div><?= htmlspecialchars($info['note']) ?> </div>
                </div>

                <div class="detail-box">
                    <span class="detail-label">Thời Gian Làm:</span>
                    <div><?= date("d/m/Y", strtotime($info['ngay_lam'])) ?> - <?= $info['gio_lam'] ?></div>
                </div>

                <div class="detail-box">
                    <span class="detail-label">Trạng Thái:</span>
                    <?php
                    $classMap = [
                        'pending' => 'pending',
                        'confirmed' => 'confirmed',
                        'done' => 'done',
                        'cancelled' => 'cancelled'
                    ];

                    $textMap = [
                        'pending' => 'Chờ duyệt',
                        'confirmed' => 'Đã duyệt',
                        'done' => 'Hoàn thành',
                        'cancelled' => 'Đã hủy'
                    ];

                    $st = $info['status'];
                    ?>

                    <span class="status-badge <?= $classMap[$st] ?? '' ?>">
                        <?= $textMap[$st] ?? 'Không xác định' ?>
                    </span>
                </div>
                <?php if (!empty($info['cancel_reason'])): ?>
                    <div class="detail-box">
                        <span class="detail-label">Lý Do Hủy:</span>
                        <div><?= htmlspecialchars($info['cancel_reason']) ?></div>
                    </div>
                <?php endif; ?>

                <h3 style="margin-top:25px;">Dịch Vụ Đã Đặt</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Dịch vụ</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $sum = 0;
                        foreach ($services as $s):
                            $sum += $s['price']; ?>
                            <tr>
                                <td><?= htmlspecialchars($s['ten_dichvu']) ?></td>
                                <td><?= number_format($s['price']) ?> đ</td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <th>Tổng Cộng</th>
                            <th class="total"><?= number_format($sum) ?> đ</th>
                        </tr>

                    </tbody>
                </table>

                <a href="index.php?act=qlylichdat" class="btn-back">
                    <i class='bx bx-arrow-back'></i> Quay Lại
                </a>

            </div>
        </main>
    </div>

    <script src="<?= BASE_URL ?>public/admin.js"></script>

</body>

</html>