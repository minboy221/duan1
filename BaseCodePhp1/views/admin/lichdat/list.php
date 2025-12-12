<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Đặt Lịch | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    /* CSS riêng cho trang quản lý lịch để hiển thị đẹp hơn */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #cce5ff;
        color: #004085;
    }

    .status-done {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .btn-action {
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        margin-right: 5px;
        transition: 0.2s;
    }

    .btn-approve {
        background: #3C91E6;
        color: white;
    }

    .btn-cancel {
        background: #DB504A;
        color: white;
    }

    .btn-complete {
        background: #388E3C;
        color: white;
    }

    .btn-action:hover {
        opacity: 0.8;
    }

    .pagination button {
        margin: 3px;
        padding: 8px 14px;
        border-radius: 6px;
        border: 1px solid #ccc;
        background: #f5f5f5;
        cursor: pointer;
        transition: 0.2s;
    }

    .pagination button:hover {
        background: #e0e0e0;
    }

    .pagination .active {
        background: #0d6efd !important;
        /* màu xanh nổi bật */
        color: white !important;
        border-color: #0a58ca !important;
    }

    /* css phần lọc */
    /* Khung bao ngoài (Card) */
    .filter-card {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        /* Đổ bóng nhẹ */
        margin-bottom: 20px;
        border: 1px solid #eaecf4;
    }

    /* Flexbox cho form */
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        /* Tự xuống dòng trên màn hình nhỏ */
        gap: 15px;
        align-items: center;
    }

    /* Nhóm input */
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }

    /* Icon tìm kiếm nằm trong input */
    .input-icon {
        position: absolute;
        left: 10px;
        color: #888;
        font-size: 18px;
        pointer-events: none;
    }

    /* Style chung cho các ô input */
    .form-control {
        padding: 10px 15px;
        border: 1px solid #d1d3e2;
        border-radius: 5px;
        font-size: 14px;
        color: #6e707e;
        outline: none;
        transition: all 0.3s ease;
        height: 40px;
        /* Chiều cao cố định */
    }

    /* Padding riêng cho ô tìm kiếm vì có icon */
    .input-keyword {
        padding-left: 35px;
        width: 250px;
    }

    .input-date {
        width: 160px;
        color: #555;
    }

    .input-time {
        width: 150px;
    }

    /* Hiệu ứng Focus (khi bấm vào) */
    .form-control:focus {
        border-color: #4e73df;
        /* Màu xanh admin */
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    }

    /* Nhóm nút bấm */
    .btn-group {
        display: flex;
        gap: 10px;
    }

    /* Style chung cho nút */
    .btn-filter {
        padding: 0 20px;
        height: 40px;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        text-decoration: none;
        transition: 0.2s;
    }

    /* Nút Lọc (Xanh) */
    .btn-primary {
        background-color: #4e73df;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
    }

    /* Nút Reset (Xám) */
    .btn-secondary {
        background-color: #f8f9fc;
        color: #5a5c69;
        border: 1px solid #d1d3e2;
    }

    .btn-secondary:hover {
        background-color: #eaecf4;
        color: #333;
    }

    /* Responsive: Trên điện thoại thì full chiều rộng */
    @media (max-width: 768px) {
        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .input-keyword,
        .input-date,
        .input-time {
            width: 100%;
        }

        .btn-group {
            justify-content: space-between;
        }

        .btn-filter {
            flex: 1;
        }
    }
</style>

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
    <!-- End Sidebar -->
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form method="GET" action="">
                <div class="form-input">
                    <input type="hidden" name="act" value="qlydanhmuc">
                    <input type="text" name="keyword" placeholder="Tìm danh mục..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <main>
            <div class="header">
                <div class="left">
                    <h1>Quản Lý Đơn Đặt Lịch</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        /
                        <li><a href="#" class="active">Lịch hẹn</a></li>
                    </ul>
                </div>
                <div class="bottom-data">
                    <div class="filter-card">
                        <form method="GET" action="index.php" class="filter-form">
                            <input type="hidden" name="act" value="qlylichdat">

                            <div class="input-group">
                                <span class="input-icon"><i class='bx bx-search'></i></span>
                                <input type="search" name="keyword" class="form-control input-keyword"
                                    placeholder="Mã lịch, Tên khách..."
                                    value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                            </div>

                            <div class="input-group">
                                <input type="date" name="date" class="form-control input-date"
                                    value="<?= htmlspecialchars($_GET['date'] ?? '') ?>" title="Lọc theo ngày">
                            </div>
                            <div class="input-group">
                                <select name="tho_name" class="form-control" style="width: 150px;">
                                    <option value="">--Chọn Thợ--</option>
                                    <?php
                                    $currentTho = $_GET['tho_name'] ?? '';
                                    // Giả định $allTho đã được truyền từ Controller (Bước 2)
                                    if (isset($allTho)):
                                        foreach ($allTho as $tho):
                                            $selected = ($currentTho === $tho['name']) ? 'selected' : '';
                                            // Lọc theo TÊN THỢ
                                            echo "<option value=\"" . htmlspecialchars($tho['name']) . "\" {$selected}>" . htmlspecialchars($tho['name']) . "</option>";
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>

                            <div class="input-group">
                                <select name="time" class="form-control input-time" style="width: 150px;">
                                    <option value="">--Chọn Giờ--</option>
                                    <?php
                                    // Danh sách các khung giờ 30 phút từ 08:00 đến 21:00
                                    $currentTime = $_GET['time'] ?? '';
                                    $timeSlots = [];
                                    for ($h = 8; $h <= 21; $h++) {
                                        foreach (['00', '30'] as $min) {
                                            if ($h == 21 && $min == '30') continue; // Loại bỏ 21:30
                                            $time = str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . $min;
                                            $timeSlots[] = $time;
                                        }
                                    }

                                    foreach ($timeSlots as $timeOption) {
                                        $selected = ($currentTime === $timeOption) ? 'selected' : '';
                                        echo "<option value=\"{$timeOption}\" {$selected}>{$timeOption}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <select name="status" class="form-control" style="width: 150px;">
                                    <option value="">--Tất cả Trạng thái--</option>

                                    <?php
                                    $currentStatus = $_GET['status'] ?? '';
                                    $statuses = [
                                        'pending' => 'Chờ duyệt',
                                        'confirmed' => 'Đã duyệt',
                                        'done' => 'Hoàn thành',
                                        'cancelled' => 'Đã hủy'
                                    ];

                                    foreach ($statuses as $val => $text):
                                    ?>
                                        <option value="<?= $val ?>" <?= ($currentStatus === $val) ? 'selected' : '' ?>>
                                            <?= $text ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="btn-group">
                                <button type="submit" class="btn-filter btn-primary">
                                    Lọc Dữ Liệu
                                </button>

                                <a href="index.php?act=qlylichdat" class="btn-filter btn-secondary">
                                    <i class='bx bx-refresh'></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <i class='bx bx-calendar-event'></i>
                        <h3>Danh Sách Lịch Hẹn</h3>
                    </div>
                    <table id="userTable">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Khách hàng</th>
                                <th>Dịch vụ</th>
                                <th>Thợ</th>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Thời gian đặt</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Lý do hủy</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listLich)): ?>
                                <?php foreach ($listLich as $item):
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
                                    <tr>
                                        <td>#<?= htmlspecialchars($item['ma_lich']) ?></td>
                                        <td><?= htmlspecialchars($item['ten_khach']) ?><br><?= htmlspecialchars($item['sdt_khach']) ?>
                                        </td>
                                        <td>
                                            <p style="margin:0; font-size: 14px; line-height: 1.5;">
                                                <?= $item['ten_dichvu'] ?>
                                            </p>
                                        </td>
                                        <td><?= htmlspecialchars($item['ten_tho']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($item['ngay_lam'])) ?></td>
                                        <td><?= htmlspecialchars($item['gio_lam']) ?></td>
                                        <td>
                                            <span style="font-size: 13px; color: #555;">
                                                <i class="fa fa-clock"></i>
                                                <?= date('H:i:s', strtotime($item['created_at'])) ?>
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                <?= date('d/m/Y', strtotime($item['created_at'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <strong style="color: #DB504A; display: block; margin-top: 5px;">
                                                <?= number_format($item['total_price']) ?> đ
                                            </strong>
                                        </td>
                                        <td><span class="status-badge <?= $class ?>"><?= $text ?></span></td>
                                        <td><?= !empty($item['cancel_reason']) ? htmlspecialchars($item['cancel_reason']) : '---' ?>
                                        </td>
                                        <td>
                                            <form action="index.php?act=update_status_lich" method="POST"
                                                style="display:inline-block" class="status-form">
                                                <input type="hidden" name="id" value="<?= $item['ma_lich'] ?>">
                                                <?php if ($st == 'pending'): ?>
                                                    <button name="status" value="confirmed" class="btn-action btn-approve"
                                                        title="Duyệt"><i class='bx bx-check'></i></button>
                                                    <button type="button" class="btn-action btn-cancel btn-cancel-popup"
                                                        title="Hủy"><i class='bx bx-x'></i></button>
                                                <?php elseif ($st == 'confirmed'): ?>
                                                    <button name="status" value="done" class="btn-action btn-complete"
                                                        title="Hoàn thành"><i class='bx bx-check-double'></i></button>
                                                    <button type="button" class="btn-action btn-cancel btn-cancel-popup"
                                                        title="Hủy"><i class='bx bx-x'></i></button>
                                                <?php else: ?>
                                                    <a href="index.php?act=admin-lichdat-detail&ma_lich=<?= $item['ma_lich'] ?>"
                                                        class="btn-action" style="background: #6c757d; 
                                                                            color: white; 
                                                                            display: inline-flex; 
                                                                            align-items: center;   
                                                                            justify-content: center;  
                                                                            padding: 8px 12px;      
                                                                            border-radius: 5px;         
                                                                            text-decoration: none;"
                                                        title="Xem chi tiết">
                                                        <i class='bx bx-show' style="font-size: 18px;"></i> </a>
                                                <?php endif; ?>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" style="text-align:center; padding:30px; color:#888;">
                                        <i class='bx bx-calendar-x'
                                            style="font-size:40px; display:block; margin-bottom:10px;"></i>Chưa có lịch đặt
                                        nào.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <script src="<?= BASE_URL ?>public/admin.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // --- 2. PHẦN XỬ LÝ NÚT HỦY (SỬA LẠI DÙNG DELEGATION) ---
                document.addEventListener('click', function(e) {
                    // Kiểm tra nếu bấm vào nút có class 'btn-cancel-popup' hoặc icon bên trong nó
                    const target = e.target.closest('.btn-cancel-popup');

                    if (target) {
                        e.preventDefault(); // Ngăn chặn hành vi mặc định

                        const form = target.closest('form');

                        Swal.fire({
                            title: 'HỦY LỊCH HẸN',
                            text: "Vui lòng nhập lý do hủy:",
                            input: 'textarea',
                            inputPlaceholder: 'Ví dụ: Khách bận, Cửa hàng nghỉ...',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Xác nhận Hủy',
                            cancelButtonText: 'Quay lại',
                            inputValidator: (value) => {
                                if (!value) return 'Bạn bắt buộc phải nhập lý do!';
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Xóa input cũ (nếu có) để tránh trùng lặp
                                const oldInputs = form.querySelectorAll('input[name="cancel_reason"], input[name="status"]');
                                oldInputs.forEach(input => input.remove());

                                // Tạo input Status = cancelled
                                const inputStatus = document.createElement('input');
                                inputStatus.type = 'hidden';
                                inputStatus.name = 'status';
                                inputStatus.value = 'cancelled';
                                form.appendChild(inputStatus);

                                // Tạo input Lý do
                                const inputReason = document.createElement('input');
                                inputReason.type = 'hidden';
                                inputReason.name = 'cancel_reason';
                                inputReason.value = result.value;
                                form.appendChild(inputReason);

                                // Submit form
                                form.submit();
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</body>

</html>