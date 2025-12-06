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
                                <i class="fa fa-magic"></i> Tự động tạo 30 ngày tới
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

                                <div class="day-card day-item">
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
                        <div id="pagination" class="d-flex justify-content-center mt-4 mb-5 gap-2"></div>
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
        //phần phân Trang
        document.addEventListener('DOMContentLoaded', function () {
            const itemsPerPage = 9; // Số lượng ngày hiển thị trên 1 trang
            const items = document.querySelectorAll('.day-item');
            const paginationContainer = document.getElementById('pagination');
            const totalPages = Math.ceil(items.length / itemsPerPage);

            // Hàm hiển thị trang
            function showPage(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;

                items.forEach((item, index) => {
                    if (index >= start && index < end) {
                        item.style.display = 'block'; // Hiện
                    } else {
                        item.style.display = 'none';  // Ẩn
                    }
                });

                // Cập nhật trạng thái nút active
                updateButtons(page);
            }

            // Hàm tạo nút phân trang
            function createPagination() {
                if (totalPages <= 1) return; // Nếu chỉ có 1 trang thì khỏi hiện nút

                // Nút Trước
                /*
                const prevBtn = document.createElement('button');
                prevBtn.innerText = '«';
                prevBtn.className = 'pagination-btn';
                paginationContainer.appendChild(prevBtn);
                */

                // Các nút số trang
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.innerText = i;
                    btn.className = 'pagination-btn';
                    if (i === 1) btn.classList.add('active');

                    btn.addEventListener('click', () => {
                        showPage(i);
                        // Scroll nhẹ lên đầu danh sách cho dễ nhìn
                        document.getElementById('calendar-list').scrollIntoView({ behavior: 'smooth', block: 'start' });
                    });

                    paginationContainer.appendChild(btn);
                }
            }

            // Cập nhật màu nút
            function updateButtons(activePage) {
                const buttons = paginationContainer.querySelectorAll('.pagination-btn');
                buttons.forEach(btn => {
                    if (parseInt(btn.innerText) === activePage) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });
            }

            // Khởi chạy
            if (items.length > 0) {
                createPagination();
                showPage(1); // Mặc định hiện trang 1
            }
        });
    </script>
</body>

</html>