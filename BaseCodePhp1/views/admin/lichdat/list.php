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
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
            <li class="active"><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot">Quản Lý AI</a></li>
            <li><a href="?act=qlychat">Quản Lý Chat</a></li>
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
            <li>
                <a href="<?= BASE_URL ?>?act=home" class="logout">
                    <i class='bx bx-log-out-circle'></i>Xem Website
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
                                <input type="text" name="time" class="form-control input-time"
                                    placeholder="Giờ (VD: 08:00)" value="<?= htmlspecialchars($_GET['time'] ?? '') ?>">
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
       class="btn-action" 
       style="background:#6c757d; color:white;" 
       title="Xem chi tiết">
        <i class='bx bx-show'></i>
    </a>
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

                    <div class="pagination" id="pagination"></div>
        </main>
        <script src="<?= BASE_URL ?>public/admin.js"></script>
        <script>
            // Phân trang
            const usersPerPage = 5;

            // Lấy bảng
            const table = document.getElementById("userTable");
            const rows = table.querySelectorAll("tbody tr");
            const totalRows = rows.length;

            // Tính số trang
            const totalPages = Math.ceil(totalRows / usersPerPage);

            // Tạo thanh phân trang
            const pagination = document.createElement("div");
            pagination.classList.add("pagination");
            pagination.style.margin = "20px";
            pagination.style.textAlign = "center";
            document.querySelector(".orders").appendChild(pagination);

            function showPage(page) {
                // Ẩn toàn bộ
                rows.forEach(r => r.style.display = "none");

                // Vị trí bắt đầu – kết thúc
                const start = (page - 1) * usersPerPage;
                const end = start + usersPerPage;

                // Hiển thị đúng 5 user
                for (let i = start; i < end && i < totalRows; i++) {
                    rows[i].style.display = "";
                }

                // Active nút
                document.querySelectorAll(".page-btn").forEach(btn => btn.classList.remove("active"));
                document.getElementById("page-" + page).classList.add("active");
            }

            // Render nút phân trang
            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement("button");
                btn.innerText = i;
                btn.id = "page-" + i;
                btn.classList.add("page-btn");
                btn.style.margin = "3px";
                btn.style.padding = "8px 14px";
                btn.style.borderRadius = "5px";
                btn.style.border = "1px solid #ccc";
                btn.style.cursor = "pointer";
                btn.onclick = () => showPage(i);
                pagination.appendChild(btn);
            }

            // Hiển thị trang đầu tiên
            showPage(1);

            // SweetAlert2: popup nhập lý do hủy
            document.querySelectorAll('.btn-cancel-popup').forEach(button => {
                button.addEventListener('click', function () {
                    const form = button.closest('form');
                    Swal.fire({
                        title: 'Nhập lý do hủy',
                        input: 'text',
                        inputPlaceholder: 'Nhập lý do hủy...',
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận',
                        cancelButtonText: 'Hủy',
                        preConfirm: (reason) => {
                            if (!reason) {
                                Swal.showValidationMessage('Bạn phải nhập lý do hủy');
                            }
                            return reason;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Xóa input ẩn cũ nếu click lại nhiều lần
                            form.querySelectorAll('input[name="cancel_reason"], input[name="status"]').forEach(i => i.remove());

                            // Thêm input ẩn
                            let inputReason = document.createElement('input');
                            inputReason.type = 'hidden';
                            inputReason.name = 'cancel_reason';
                            inputReason.value = result.value;
                            form.appendChild(inputReason);

                            let inputStatus = document.createElement('input');
                            inputStatus.type = 'hidden';
                            inputStatus.name = 'status';
                            inputStatus.value = 'cancelled';
                            form.appendChild(inputStatus);

                            form.submit();
                        }
                    });
                });
            });
        </script>
    </div>
</body>

</html>