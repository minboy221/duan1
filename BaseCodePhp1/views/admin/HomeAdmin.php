<?php
// variables expected from controller:
// $totalStaff, $totalBookings, $dailyRevenue, $totalRevenue
// $topTho (array), $chartTopTho (array), $revenueLabels, $revenueValues, $chartMode
$totalStaff = $totalStaff ?? 0;
$totalBookings = $totalBookings ?? 0;
$dailyRevenue = $dailyRevenue ?? 0;
$totalRevenue = $totalRevenue ?? 0;
$topTho = $topTho ?? [];
$chartTopTho = $chartTopTho ?? ['labels' => [], 'values' => [], 'rows' => []];
$revenueLabels = $revenueLabels ?? [];
$revenueValues = $revenueValues ?? [];
$chartMode = $chartMode ?? 'month';
$month = $_GET['month'] ?? date('n');
$year = $_GET['year'] ?? date('Y');
$search = $_GET['search'] ?? '';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Trị | 31Shine</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-cut'></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="?act=homeadmin"><i class='bx bxs-dashboard'></i>Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc"><i class='bx bx-store-alt'></i>Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"><i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
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
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->

        <main>
            <div class="header">
                <div>
                    <div class="left">
                        <h1>Bảng điều khiển</h1>
                    </div>
                    <div class="muted">Thống kê & báo cáo</div>
                </div>
                <form method="get" style="display:flex;gap:8px;align-items:center">
                    <input type="hidden" name="act" value="homeadmin">
                    <div class="filter-inline">
                        <label class="muted">Tháng</label>
                        <select name="month">
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?= $i ?>" <?= ($i == (int) $month ? 'selected' : '') ?>>Tháng <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>


                        <label class="muted">Năm</label>
                        <select name="year">
                            <?php for ($y = date('Y') - 3; $y <= date('Y'); $y++): ?>
                                <option value="<?= $y ?>" <?= ($y == (int) $year ? 'selected' : '') ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>


                        <label class="muted">Chart</label>
                        <select name="chartMode">
                            <option value="month" <?= ($chartMode == 'month' ? 'selected' : '') ?>>Theo tháng
                                (<?= $year ?>)
                            </option>
                            <option value="week" <?= ($chartMode == 'week' ? 'selected' : '') ?>>Theo tuần (<?= $year ?>)
                            </option>
                        </select>


                        <button
                            style="background:#5a5af3;color:#fff;border:none;padding:8px 12px;border-radius:8px;cursor:pointer">Lọc</button>
                    </div>
                </form>
            </div>

            <div class="cards">
                <div class="card">
                    <h3>Nhân Viên</h3>
                    <div class="value"><?= number_format($totalStaff) ?></div>
                </div>
                <div class="card">
                    <h3>Tổng Đơn Đặt</h3>
                    <div class="value"><?= number_format($totalBookings) ?></div>
                </div>
                <div class="card">
                    <h3>Doanh Thu Trong Ngày</h3>
                    <div class="value"><?= number_format($dailyRevenue) ?>đ</div>
                </div>
                <div class="card">
                    <h3>Tổng Doanh Thu (Tháng <?= $month ?>/<?= $year ?>)</h3>
                    <div class="value"><?= number_format($totalRevenue) ?>đ</div>
                </div>
            </div>
            <div class="table-box">
                <div class="table-box">
                    <h3>Top Thợ Được Đặt Nhiều Nhất (Tháng <?= $month ?>/<?= $year ?>)</h3>


                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px">
                        <div class="muted">Hiển thị top <?= count($topTho) ?> thợ</div>
                        <input id="searchTho" placeholder="Tìm thợ..."
                            style="padding:8px;border-radius:8px;border:1px solid #ddd">
                    </div>


                    <table id="tableTho" style="margin-top:10px">
                        <thead>
                            <tr>
                                <th>Thợ</th>
                                <th>Lượt đặt</th>
                                <th>Doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($topTho)): ?>
                                <tr>
                                    <td colspan="3" class="no-data">Không có dữ liệu cho tháng này</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($topTho as $t): ?>
                                    <tr>
                                        <td style="display:flex;align-items:center;gap:8px">
                                            <?php if (!empty($t['anh'])): ?>
                                                <img src="<?= BASE_URL ?>anhtho/<?= htmlspecialchars($t['anh']) ?>" class="avatar"
                                                    alt="">
                                            <?php else: ?>
                                                <div class="avatar" style="background:#eee;display:inline-block"></div>
                                            <?php endif; ?>
                                            <?= htmlspecialchars($t['ten_tho']) ?>
                                        </td>
                                        <td><?= (int) $t['total_bookings'] ?></td>
                                        <td><?= number_format($t['total_revenue']) ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="chart-box">
                    <h3>Biểu đồ doanh thu
                        (<?= $chartMode == 'week' ? 'Theo tuần — ' . $year : '12 tháng — ' . $year ?>)
                    </h3>
                    <?php if (empty($revenueLabels) || empty($revenueValues)): ?>
                        <div class="no-data">Không có dữ liệu biểu đồ</div>
                    <?php else: ?>
                        <canvas id="chartRevenue" height="90"></canvas>
                    <?php endif; ?>
                </div>
                <div class="chart-box">
                    <h3>Biểu đồ Top Thợ (Lượt đặt) — Tháng <?= $month ?>/<?= $year ?></h3>
                    <?php if (empty($chartTopTho['labels']) || empty($chartTopTho['values'])): ?>
                        <div class="no-data">Không có dữ liệu</div>
                    <?php else: ?>
                        <canvas id="chartTopTho" height="90"></canvas>
                    <?php endif; ?>
                </div>
            </div>
        </main>

        <script>
            // Realtime search for stylists (client-side)
            const searchInput = document.getElementById('searchTho');
            searchInput.addEventListener('input', function () {
                const q = this.value.toLowerCase().trim();
                const rows = document.querySelectorAll('#tableTho tbody tr');
                rows.forEach(r => {
                    const text = r.innerText.toLowerCase();
                    if (text.indexOf(q) !== -1) r.style.display = '';
                    else r.style.display = 'none';
                });
            });

            // Chart data passed from PHP
            const revenueLabels = <?= json_encode($revenueLabels) ?>;
            const revenueValues = <?= json_encode($revenueValues) ?>;

            if (revenueLabels.length > 0 && revenueValues.length > 0) {
                const ctx = document.getElementById('chartRevenue').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: revenueLabels,
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: revenueValues,
                            backgroundColor: 'rgba(54,162,235,0.6)',
                            borderColor: 'rgba(54,162,235,1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                ticks: {
                                    callback: function (value) { return value.toLocaleString(); }
                                }
                            }
                        },
                    }
                });
            }

            // top tho chart
            const topLabels = <?= json_encode($chartTopTho['labels'] ?? []) ?>;
            const topValues = <?= json_encode($chartTopTho['values'] ?? []) ?>;
            if (topLabels.length > 0 && topValues.length > 0) {
                const ctx2 = document.getElementById('chartTopTho').getContext('2d');
                new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: topLabels,
                        datasets: [{
                            label: 'Lượt đặt',
                            data: topValues,
                            borderColor: 'rgba(255,99,132,1)',
                            backgroundColor: 'rgba(255,99,132,0.2)',
                            tension: 0.3,
                            fill: true,
                            borderWidth: 2
                        }]
                    },
                    options: { responsive: true }
                });
            }
        </script>
        <script src="<?= BASE_URL ?>public/admin.js"></script>
</body>

</html>