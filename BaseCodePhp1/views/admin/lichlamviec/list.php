<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlylamviec.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Làm Việc | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li><a href="?act=qlylichdat">Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien">Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot">Quản Lý AI</a></li>
            <li><a href="?act=qlychat">Quản Lý Chat</a></li>
            <li class="active"><a href="?act=qlylichlamviec">Quản Lý Làm Việc</a></li>
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
        <!-- phần hiển thị nội dung -->
        <main>
            <div class="header">
                <div class="left">
                    <h1>Quản Lý Lịch Làm Việc</h1>
                </div>
            </div>

            <div class="bottom-data">
                <div class="orders">

                    <div class="header">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <i class='bx bx-calendar' style="font-size:24px; color:#3C91E6;"></i>
                            <h3>Lịch Làm Việc</h3>
                        </div>

                        <form action="index.php?act=auto_create_days" method="POST">
                            <button type="submit" class="btnthem"
                                onclick="return confirm('Hệ thống sẽ tạo ngày làm việc cho 7 ngày tới. Bạn chắc chắn chứ?')">
                                <i class="fa fa-magic"></i> Tự động tạo 7 ngày tới
                            </button>
                        </form>
                    </div>

                    <div class="calendar-grid">

                        <?php if (!empty($listNgay)): ?>
                            <?php
                            // 1. Tạo mảng dịch tiếng Việt
                            $thuTiengViet = [
                                1 => 'Thứ Hai',
                                2 => 'Thứ Ba',
                                3 => 'Thứ Tư',
                                4 => 'Thứ Năm',
                                5 => 'Thứ Sáu',
                                6 => 'Thứ Bảy',
                                7 => 'Chủ Nhật'
                            ];
                            ?>

                            <?php foreach ($listNgay as $ngay): ?>
                                <?php
                                $timestamp = strtotime($ngay['date']);
                                $dayNumber = date('N', $timestamp); // Lấy số thứ tự: 1 (Thứ 2) -> 7 (CN)
                        
                                // 2. Lấy tên tiếng Việt từ mảng
                                $tenThu = $thuTiengViet[$dayNumber] ?? 'Không rõ';

                                // 3. Kiểm tra cuối tuần (Thứ 7 hoặc CN)
                                $isWeekend = ($dayNumber >= 6);
                                $weekendClass = $isWeekend ? 'weekend' : '';
                                ?>

                                <div class="day-card">
                                    <div class="day-header <?= $weekendClass ?>">
                                        <span class="day-date"><?= date('d/m/Y', $timestamp) ?></span>
                                        <span class="day-weekday"><?= $tenThu ?></span>
                                    </div>

                                    <div class="day-body">
                                        <?php
                                        $thoList = (new LichLamViecModel())->getThoInNgay($ngay['id']);
                                        ?>

                                        <?php if (empty($thoList)): ?>
                                            <div class="empty-state">
                                                <i class='bx bx-user-x' style="font-size:30px; margin-bottom:5px;"></i>
                                                <span>Chưa có thợ phân công</span>
                                            </div>
                                        <?php else: ?>
                                            <?php foreach ($thoList as $tho): ?>
                                                <div class="staff-item">
                                                    <div class="staff-info">
                                                        <?php $img = !empty($tho['image']) ? './anhtho/' . $tho['image'] : './anhmau/default-avatar.png'; ?>
                                                        <img src="<?= $img ?>" class="staff-avatar" alt="Avatar">
                                                        <span class="staff-name"><?= htmlspecialchars($tho['name']) ?></span>
                                                    </div>
                                                    <a href="index.php?act=edit_times&id=<?= $tho['phan_cong_id'] ?>" class="btn-time">
                                                        <i class="fa fa-clock"></i> Sửa
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="day-footer">
                                        <a href="index.php?act=detail_ngay&id=<?= $ngay['id'] ?>" class="btn-action btn-detail">
                                            <i class="fa fa-eye"></i> Chi tiết
                                        </a>
                                        <a href="index.php?act=assign_tho&id=<?= $ngay['id'] ?>" class="btn-action btn-assign">
                                            <i class="fa fa-user-plus"></i> Gán Thợ
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                                <img src="./anhmau/empty-calendar.png" alt=""
                                    style="width:100px; opacity:0.5; margin-bottom:20px;">
                                <p style="color:#888;">Chưa có lịch làm việc nào. Hãy bấm nút tạo tự động!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>
    <script>
        function confirmDelete(e) {
            e.preventDefault();
            const url = e.currentTarget.getAttribute('href');

            Swal.fire({
                title: 'Bạn chắc muốn xoá?',
                text: "Không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xoá luôn',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });

            return false;
        }
        // Số user mỗi trang
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
    </script>
</body>

</html>