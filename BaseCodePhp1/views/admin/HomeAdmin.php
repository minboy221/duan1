<?php
// variables expected from controller:
// $totalStaff, $totalBookings, $dailyRevenue, $totalRevenue
// $topTho (array), $chartTopTho (array), $revenueLabels, $revenueValues, $chartMode
$totalStaff = $totalStaff ?? 0;
$totalBookings = $totalBookings ?? 0;
$dailyRevenue = $dailyRevenue ?? 0;
$totalRevenue = $totalRevenue ?? 0;
$topTho = $topTho ?? [];
$chartTopTho = $chartTopTho ?? ['labels'=>[], 'values'=>[], 'rows'=>[]];
$revenueLabels = $revenueLabels ?? [];
$revenueValues = $revenueValues ?? [];
$chartMode = $chartMode ?? 'month';
$month = $_GET['month'] ?? date('n');
$year  = $_GET['year'] ?? date('Y');
$search = $_GET['search'] ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>31Shine Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root{--bg:#f5f7fb;--white:#fff;--primary:#5a5af3;--dark:#1e1e2d;--radius:12px;--shadow:0 6px 20px rgba(0,0,0,0.06);}
        body{margin:0;font-family:Poppins,Segoe UI,Arial;background:var(--bg);display:flex;}
        .sidebar{width:260px;background:var(--dark);color:#fff;height:100vh;position:fixed;overflow:auto;padding:20px 0;}
        .sidebar .logo{padding-left:22px;font-weight:700;font-size:22px;margin-bottom:20px}
        .sidebar ul{list-style:none;padding:0;margin:0}
        .sidebar a{display:block;padding:12px 22px;color:#d3d3d3;text-decoration:none}
        .sidebar a.active,.sidebar a:hover{background:#2a2a3f;color:#fff}
        .main{margin-left:260px;padding:22px;width:calc(100% - 260px)}
        .navbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px}
        .cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
        .card{background:var(--white);padding:16px;border-radius:var(--radius);box-shadow:var(--shadow)}
        .card h3{margin:0;color:#666;font-size:14px}
        .card .value{font-weight:700;font-size:22px;margin-top:8px}
        .table-box{background:var(--white);padding:16px;border-radius:var(--radius);margin-top:18px;box-shadow:var(--shadow)}
        table{width:100%;border-collapse:collapse;margin-top:12px}
        table th,table td{padding:10px;border-bottom:1px solid #eee;text-align:left}
        img.avatar{width:44px;height:44px;border-radius:50%;object-fit:cover;margin-right:10px}
        .filter-inline{display:flex;gap:8px;align-items:center}
        .filter-inline select, .filter-inline input{padding:8px;border-radius:8px;border:1px solid #dcdcdc}
        .chart-box{background:var(--white);padding:16px;border-radius:var(--radius);margin-top:18px;box-shadow:var(--shadow)}
        .muted{color:#777}
        .no-data{padding:18px;text-align:center;color:#999}
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">31Shine</div>
    <ul>
        <li><a href="?act=homeadmin" class="active">Dashboard</a></li>
        <li><a href="?act=qlydichvu">Dịch Vụ</a></li>
        <li><a href="?act=qlytho">Thợ</a></li>
        <li><a href="?act=qlylichdat">Lịch Đặt</a></li>
        <li><a href="?act=admin-nhanvien">Nhân Viên</a></li>
        <li><a href="?act=qlybot">Quản Lý AI</a></li>
        <li><a href="?act=qlychat">Chat Admin</a></li>
        <li><a href="?act=logout">Đăng Xuất</a></li>
    </ul>
</div>

<div class="main">
    <div class="navbar">
        <div>
            <h2 style="margin:0">Dashboard</h2>
            <div class="muted">Thống kê & báo cáo</div>
        </div>

        <form method="get" style="display:flex;gap:8px;align-items:center">
            <input type="hidden" name="act" value="homeadmin">
            <div class="filter-inline">
                <label class="muted">Tháng</label>
                <select name="month">
                    <?php for($i=1;$i<=12;$i++): ?>
                        <option value="<?= $i ?>" <?= ($i == (int)$month ? 'selected' : '') ?>><?= 'Tháng '.$i ?></option>
                    <?php endfor; ?>
                </select>
                <label class="muted">Năm</label>
                <select name="year">
                    <?php for($y = date('Y') - 3; $y <= date('Y'); $y++): ?>
                        <option value="<?= $y ?>" <?= ($y == (int)$year ? 'selected' : '') ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>

                <label class="muted">Chart</label>
                <select name="chartMode">
                    <option value="month" <?= ($chartMode=='month'?'selected':'') ?>>Theo tháng (năm <?= $year ?>)</option>
                    <option value="week" <?= ($chartMode=='week'?'selected':'') ?>>Theo tuần (năm <?= $year ?>)</option>
                </select>

                <button style="background:#5a5af3;color:#fff;border:none;padding:8px 12px;border-radius:8px;cursor:pointer">Lọc</button>
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
        <h3>Top Thợ Được Đặt Nhiều Nhất (Tháng <?= $month ?>/<?= $year ?>)</h3>

        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px">
            <div class="muted">Hiển thị top <?= count($topTho) ?> thợ</div>
            <input id="searchTho" placeholder="Tìm thợ..." style="padding:8px;border-radius:8px;border:1px solid #ddd">
        </div>

        <table id="tableTho" style="margin-top:10px">
            <thead>
                <tr><th>Thợ</th><th>Lượt đặt</th><th>Doanh thu</th></tr>
            </thead>
            <tbody>
                <?php if (empty($topTho)): ?>
                    <tr><td colspan="3" class="no-data">Không có dữ liệu cho tháng này</td></tr>
                <?php else: ?>
                    <?php foreach ($topTho as $t): ?>
                        <tr>
                            <td style="display:flex;align-items:center">
                                <?php if (!empty($t['anh'])): ?>
                                    <img src="<?= BASE_URL ?>uploads/tho/<?= htmlspecialchars($t['anh']) ?>" class="avatar" alt="">
                                <?php else: ?>
                                    <div class="avatar" style="background:#eee;display:inline-block"></div>
                                <?php endif; ?>
                                <?= htmlspecialchars($t['ten_tho']) ?>
                            </td>
                            <td><?= (int)$t['total_bookings'] ?></td>
                            <td><?= number_format($t['total_revenue']) ?>đ</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="chart-box">
        <h3>Biểu đồ doanh thu (<?= ($chartMode == 'week') ? 'Theo tuần — Năm '.$year : '12 tháng — Năm '.$year ?>)</h3>
        <?php if (empty($revenueLabels) || empty($revenueValues)): ?>
            <div class="no-data">Không có dữ liệu biểu đồ cho lựa chọn này</div>
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

<script>
    // Realtime search for stylists (client-side)
    const searchInput = document.getElementById('searchTho');
    searchInput.addEventListener('input', function(){
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
                            callback: function(value){ return value.toLocaleString(); }
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
</body>
</html>
