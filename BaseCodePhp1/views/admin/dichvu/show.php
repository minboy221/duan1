<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydichvu.css">
    <title>Chi Tiết Dịch Vụ | 31Shine</title>
</head>

<body>

<div class="content">
    <main>
        <div class="header">
            <h1>Chi Tiết Dịch Vụ</h1>
            <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
        </div>

        <div class="bottom-data" style="padding:20px;">
            <?php if (!empty($service)): ?>
                <div class="service-detail">
                    <h2><?= htmlspecialchars($service['name'] ?? '') ?></h2>
                    <p><strong>Danh mục:</strong> <?= htmlspecialchars($service['category_name'] ?? '') ?></p>
                    <p><strong>Giá:</strong> <?= !empty($service['price']) ? number_format($service['price']) . ' đ' : '' ?></p>
                    <p><strong>Thời gian:</strong> <?= htmlspecialchars($service['time'] ?? '') ?> phút</p>
                    <p><strong>Mô tả:</strong> <?= htmlspecialchars($service['description'] ?? '') ?></p>
                    <?php if (!empty($service['image'])): ?>
                        <p><img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($service['image']) ?>" width="200" style="border-radius:8px;"></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p style="color:red;">Dịch vụ không tồn tại.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

</body>
</html>
