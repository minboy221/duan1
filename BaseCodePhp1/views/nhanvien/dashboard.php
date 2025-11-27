<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Phân trang */
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .page-btn {
            margin: 3px;
            padding: 8px 14px;
            border-radius: 5px;
            border: 1px solid #95a5a6;
            background: #f5f5f5;
            cursor: pointer;
            transition: 0.2s;
        }

        .page-btn:hover {
            background: #e0e0e0;
        }

        .page-btn.active {
            background: #3C91E6 !important;
            color: white !important;
            border-color: #3C91E6 !important;
        }

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

        /* 💡 CSS CHÍNH CHO PHÂN TRANG */
        /* Định dạng chung */
        .pagination {
            padding-top: 15px;
            /* Thêm khoảng cách trên */
        }

        .pagination button {
            /* Đã tối ưu hóa styles đã được inject trong JS */
            background: #f5f5f5;
            border: 1px solid #ccc;
            /* Thêm lại các style đã bị ghi đè trong JS */
        }

        /* 💡 SỬA LỖI MÀU HOVER */
        .pagination button:hover {
            background: #e0e0e0;
        }

        /* 💡 MÀU ACTIVE (Đã đúng) */
        .pagination .active {
            background: #3C91E6 !important;
            color: white !important;
            border-color: #3C91E6 !important;
        }
    </style>
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

                    <table id="table">
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
                                                        title="Duyệt"><i class='bx bx-check'></i></button>
                                                    <button type="button" class="btn-action btn-cancel btn-cancel-popup"
                                                        title="Hủy"><i class='bx bx-x'></i></button>
                                                <?php elseif ($st == 'confirmed'): ?>
                                                    <button name="status" value="done" class="btn-action btn-complete"
                                                        title="Hoàn thành"><i class='bx bx-check-double'></i></button>
                                                    <button type="button" class="btn-action btn-cancel btn-cancel-popup"
                                                        title="Hủy"><i class='bx bx-x'></i></button>
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
                    <div class="pagination" id="pagination"></div>

                </div>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        // public/admin.js

        document.addEventListener("DOMContentLoaded", function() {

    /* ---------------- PHÂN TRANG ---------------- */
    const rowsPerPage = 6; 
    const table = document.getElementById("table");
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));
    const pagination = document.getElementById("pagination");

    let currentPage = 1;
    const pageCount = Math.ceil(rows.length / rowsPerPage);

    function showPage(page) {
        currentPage = page;

        rows.forEach((row, i) => {
            row.style.display =
                i >= (page - 1) * rowsPerPage && i < page * rowsPerPage
                    ? ""
                    : "none";
        });

        pagination.querySelectorAll(".page-btn").forEach(btn =>
            btn.classList.remove("active")
        );

        const activeBtn = document.getElementById("page-" + page);
        if (activeBtn) activeBtn.classList.add("active");
    }

    function setupPagination() {
        pagination.innerHTML = "";

        for (let i = 1; i <= pageCount; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.className = "page-btn";
            btn.id = "page-" + i;

            btn.addEventListener("click", function () {
                showPage(i);
            });

            pagination.appendChild(btn);
        }
    }

    setupPagination();
    showPage(1);



            // ----------------------------------------------------
            // 2. LOGIC XỬ LÝ NÚT HỦY (SWEETALERT2 & Event Delegation)
            // Áp dụng cho các nút có class 'btn-cancel-popup' (trong các form)
            // ----------------------------------------------------

            // Dùng Event Delegation để lắng nghe sự kiện trên toàn bộ khu vực nội dung chính
            // Điều này đảm bảo các nút vẫn hoạt động ngay cả khi được phân trang ẩn/hiện
            document.querySelector('.content main').addEventListener('click', function(event) {

                // Kiểm tra xem phần tử được click có phải là nút hủy không
                const button = event.target.closest('.btn-cancel-popup');

                if (button) {
                    event.preventDefault(); // Ngăn hành động mặc định của nút (dùng type="button")

                    const form = button.closest('form');
                    // Cố gắng lấy mã lịch đặt từ phần tử gần nhất để hiển thị trong tiêu đề
                    const maLichElement = form.closest('tr').querySelector('td:first-child span');
                    const maLich = maLichElement ? maLichElement.textContent.trim() : '#Lịch đặt';

                    // Sử dụng SweetAlert2 để lấy lý do
                    Swal.fire({
                        title: 'Nhập lý do hủy ' + maLich,
                        input: 'text',
                        inputPlaceholder: 'Nhập lý do hủy...',
                        showCancelButton: true,
                        confirmButtonText: 'Xác nhận hủy',
                        cancelButtonText: 'Đóng',

                        // Kiểm tra ràng buộc
                        preConfirm: (reason) => {
                            if (!reason || reason.trim() === '') {
                                Swal.showValidationMessage('Bạn phải nhập lý do hủy');
                            }
                            return reason;
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {

                            // 1. Xóa các input ẩn status/reason cũ (nếu có)
                            form.querySelectorAll('input[name="cancel_reason"], input[name="status"]').forEach(i => i.remove());

                            // 2. Tạo và thêm input ẩn lý do hủy
                            let inputReason = document.createElement('input');
                            inputReason.type = 'hidden';
                            inputReason.name = 'cancel_reason';
                            inputReason.value = result.value;
                            form.appendChild(inputReason);

                            // 3. Tạo và thêm input ẩn trạng thái hủy
                            let inputStatus = document.createElement('input');
                            inputStatus.type = 'hidden';
                            inputStatus.name = 'status';
                            inputStatus.value = 'cancelled';
                            form.appendChild(inputStatus);

                            // 4. Gửi form đến Controller (update_status_nv)
                            form.submit();
                        }
                    });
                }
            });

        });
    </script>
</body>

</html>