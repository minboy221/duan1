<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydichvu.css">
    <title>Sửa Dịch Vụ | 31Shine</title>
</head>

<body>

<div class="content">
    <main>
        <div class="header">
            <h1>Sửa Dịch Vụ</h1>
            <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
        </div>

        <div class="bottom-data" style="padding:20px;">
            <?php if (!empty($service)): ?>
                <form action="?act=update_dichvu" method="POST" enctype="multipart/form-data" class="form-add">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($service['id']) ?>">

                    <div class="form-group">
                        <label>Tên dịch vụ</label>
                        <input type="text" name="name" value="<?= htmlspecialchars($service['name'] ?? '') ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" rows="4"><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Giá</label>
                        <input type="number" name="price" value="<?= htmlspecialchars($service['price'] ?? '') ?>" min="0" required>
                    </div>

                    <div class="form-group">
                        <label>Thời gian (phút)</label>
                        <input type="number" name="time" value="<?= htmlspecialchars($service['time'] ?? '') ?>" min="0">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="danhmuc_id" required>
                            <option value="">--Chọn danh mục--</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == ($service['danhmuc_id'] ?? '')) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ảnh hiện tại</label>
                        <?php if (!empty($service['image'])): ?>
                            <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($service['image']) ?>" width="100" style="display:block;margin-bottom:10px;">
                        <?php else: ?>
                            <p>Chưa có ảnh</p>
                        <?php endif; ?>
                        <label>Đổi ảnh</label>
                        <input type="file" name="image" accept="image/*">
                    </div>

                    <button class="btnthem" style="padding:10px 25px;">Lưu Thay Đổi</button>
                </form>
            <?php else: ?>
                <p style="color:red;">Dịch vụ không tồn tại.</p>
            <?php endif; ?>
        </div>
    </main>
</div>

</body>
</html>
