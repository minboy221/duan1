<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Đặt | Nhân Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary"><i class="fa-solid fa-file-invoice"></i> CHI TIẾT ĐƠN HÀNG</h3>
            <a href="index.php?act=nv-dashboard" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between">
                        <h5 class="m-0 fw-bold text-secondary">Thông tin đặt lịch</h5>
                        <span class="text-muted">Ngày tạo:
                            <?= date('H:i d/m/Y', strtotime($booking['created_at'])) ?></span>
                    </div>
                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col-md-6 border-end">
                                <h6 class="text-muted text-uppercase small fw-bold">Khách hàng</h6>
                                <p class="mb-1 fw-bold fs-5"><?= htmlspecialchars($booking['ten_khach']) ?></p>
                                <p class="text-primary mb-0"><i class="fa-solid fa-phone"></i>
                                    <?= htmlspecialchars($booking['phone']) ?></p>
                            </div>
                            <div class="col-md-6 ps-4">
                                <h6 class="text-muted text-uppercase small fw-bold">Thời gian hẹn</h6>
                                <p class="mb-1 fs-5">
                                    <span class="badge bg-info text-dark"><i class="fa-regular fa-clock"></i>
                                        <?= $booking['gio_lam'] ?></span>
                                </p>
                                <p class="mb-0">Ngày:
                                    <strong><?= date('d/m/Y', strtotime($booking['ngay_lam'])) ?></strong></p>
                                <p class="mb-0 mt-1">Stylist:
                                    <strong><?= htmlspecialchars($booking['ten_tho']) ?></strong></p>
                            </div>
                        </div>

                        <hr>

                        <h6 class="text-muted text-uppercase small fw-bold mb-3">Dịch vụ sử dụng</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">STT</th>
                                        <th>Tên dịch vụ</th>
                                        <th class="text-end">Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($services as $sv):
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($sv['ten_dichvu']) ?></td>
                                            <td class="text-end fw-bold"><?= number_format($sv['price']) ?> đ</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="2" class="text-end fw-bold">TỔNG CỘNG</td>
                                        <td class="text-end text-danger fw-bold fs-5">
                                            <?= number_format($booking['price']) ?> VNĐ
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <?php if (!empty($booking['note'])): ?>
                            <div class="alert alert-warning mt-4 mb-0">
                                <i class="fa-solid fa-note-sticky"></i> <strong>Ghi chú của khách:</strong>
                                <?= htmlspecialchars($booking['note']) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($booking['status'] == 'cancelled'): ?>
                            <div class="alert alert-danger mt-3 mb-0">
                                <i class="fa-solid fa-circle-exclamation"></i> <strong>Lý do hủy:</strong>
                                <?= htmlspecialchars($booking['cancel_reason']) ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Trạng thái đơn hàng</h5>

                        <?php
                        $st = $booking['status'];
                        $badgeClass = 'bg-secondary';
                        $statusText = 'Chờ duyệt';

                        if ($st == 'confirmed') {
                            $badgeClass = 'bg-primary';
                            $statusText = 'Đã xác nhận';
                        }
                        if ($st == 'done') {
                            $badgeClass = 'bg-success';
                            $statusText = 'Hoàn thành';
                        }
                        if ($st == 'cancelled') {
                            $badgeClass = 'bg-danger';
                            $statusText = 'Đã hủy';
                        }
                        ?>

                        <div class="text-center mb-4">
                            <span class="badge <?= $badgeClass ?> fs-5 w-100 py-3"><?= $statusText ?></span>
                        </div>

                        <div class="d-grid gap-2">
                            <?php if ($st == 'pending'): ?>
                                <a href="index.php?act=xacnhan_lich&id=<?= $booking['id'] ?>"
                                    class="btn btn-success fw-bold py-2" onclick="return confirm('Xác nhận đơn hàng này?')">
                                    <i class="fa-solid fa-check"></i> XÁC NHẬN ĐƠN
                                </a>
                                <a href="index.php?act=huylich_nv&id=<?= $booking['id'] ?>"
                                    class="btn btn-outline-danger py-2" onclick="return confirm('Hủy đơn hàng này?')">
                                    <i class="fa-solid fa-xmark"></i> HỦY ĐƠN
                                </a>
                            <?php endif; ?>

                            <?php if ($st == 'confirmed'): ?>
                                <a href="index.php?act=hoanthanh_lich&id=<?= $booking['id'] ?>"
                                    class="btn btn-primary fw-bold py-2"
                                    onclick="return confirm('Xác nhận đã phục vụ xong?')">
                                    <i class="fa-solid fa-check-double"></i> HOÀN THÀNH
                                </a>
                                <a href="index.php?act=huylich_nv&id=<?= $booking['id'] ?>"
                                    class="btn btn-outline-danger py-2" onclick="return confirm('Khách bỏ lịch/Hủy?')">
                                    <i class="fa-solid fa-xmark"></i> HỦY ĐƠN
                                </a>
                            <?php endif; ?>

                            <?php if ($st == 'done' || $st == 'cancelled'): ?>
                                <button class="btn btn-secondary" disabled>Không thể thao tác</button>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>