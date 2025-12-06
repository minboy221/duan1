<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Xếp Giờ Cho Thợ | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />

    <style>
        /* container scroll để pagination không bị chìm */
        .time-list-container {
            max-height: 520px;
            overflow-y: auto;
            padding-right: 5px;
            margin-bottom: 20px;
        }

        .time-item {
            display: none;
        }

        #pagination {
            text-align: center;
            padding: 12px 0;
            margin-top: 15px;
        }

        #pagination .page-btn {
            margin: 4px;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #999;
            cursor: pointer;
            background: white;
        }

        #pagination .page-btn.active {
            background: #1976D2;
            color: white;
            border-color: #0a4fa6;
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
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
            <li class="active"><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
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

    <!-- Main Content -->
    <div class="content">

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
                <h1>Xếp Giờ Làm Việc</h1>
                <a href="index.php?act=detail_ngay&id=<?= $info['ngay_lv_id'] ?? '' ?>" class="btnthem btn-back"
                    style="background:#ccc;color:#000">
                    ← Quay lại
                </a>
            </div>

            <div class="form-wrapper">
                <form action="index.php?act=update_times" method="POST" class="form-add">
                    <input type="hidden" name="phan_cong_id" value="<?= $info['id'] ?>">

                    <div class="form-group">
                        <label>Thông tin phân công</label>
                        <?php
                        $dateShow = date('d/m/Y', strtotime($info['date']));
                        $textShow = $info['name'] . " - Ngày " . $dateShow;
                        ?>
                        <input type="text" value="<?= htmlspecialchars($textShow) ?>" disabled
                            style="background:#e9ecef; font-weight:bold;">
                    </div>

                    <div class="form-group">
                        <label>Chọn các khung giờ làm việc</label>

                        <div class="time-list-container">

                            <div id="timeList" class="row">
                                <?php
                                for ($h = 8; $h <= 21; $h++):
                                    foreach (['00', '30'] as $min):
                                        if ($h == 21 && $min == '30')
                                            continue;

                                        $time = str_pad($h, 2, "0", STR_PAD_LEFT) . ":" . $min;
                                        $checked = in_array($time, $currentTimes) ? 'checked' : '';
                                        ?>

                                        <div class="col-xl-3 col-md-4 col-6 mb-3 time-item">
                                            <label class="staff-checkbox-item">
                                                <input type="checkbox" name="times[]" value="<?= $time ?>" <?= $checked ?>>
                                                <span class="staff-info">
                                                    <i class='bx bx-time-five'></i> <?= $time ?>
                                                </span>
                                            </label>
                                        </div>

                                    <?php endforeach;
                                endfor; ?>
                            </div>
                            <div id="pagination"></div>
                        </div>
                    </div>

                    <button type="submit" class="btnthem" style="padding:12px 30px; width:100%; margin-top:20px;">
                        <i class='bx bx-save'></i> Lưu Thay Đổi
                    </button>
                </form>
            </div>
            <!-- phần popup thông báo -->
            <?php if (isset($_SESSION['error_sa'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi Xung Đột Lịch!',
                            // Sử dụng 'html' để cho phép thẻ <b> (in đậm) hiển thị trong thông báo
                            html: '<?= $_SESSION['error_sa'] ?>',
                            confirmButtonText: 'Đóng',
                            confirmButtonColor: '#DB504A'
                        });
                    });
                </script>
                <?php unset($_SESSION['error_sa']); // Xóa thông báo sau khi hiện xong 
                    ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_sa'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: '<?= htmlspecialchars($_SESSION['success_sa']) ?>',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    });
                </script>
                <?php unset($_SESSION['success_sa']); ?>
            <?php endif; ?>
        </main>
    </div>
    <script>
        const itemsPerPage = 5;
        const items = Array.from(document.querySelectorAll(".time-item"));
        const pagination = document.getElementById("pagination");

        const total = items.length;
        const pages = Math.ceil(total / itemsPerPage);

        function showPage(p) {
            items.forEach(el => el.style.display = "none");

            const start = (p - 1) * itemsPerPage;
            const end = start + itemsPerPage;

            for (let i = start; i < end && i < total; i++) {
                items[i].style.display = "flex";
            }

            document.querySelectorAll(".page-btn")
                .forEach(btn => btn.classList.remove("active"));

            document.getElementById("page-" + p).classList.add("active");
        }

        for (let i = 1; i <= pages; i++) {
            const btn = document.createElement("button");
            btn.innerText = i;
            btn.id = "page-" + i;
            btn.className = "page-btn";
            btn.type = "button"; // <<< FIX SUBMIT FORM
            btn.onclick = () => showPage(i);
            pagination.appendChild(btn);
        }

        showPage(1);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>