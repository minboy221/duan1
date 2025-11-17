<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydichvu.css">
    <title>Thêm Dịch Vụ | 31Shine</title>
</head>

<body>

<div class="content">
    <main>
        <div class="header">
            <h1>Thêm Dịch Vụ</h1>
            <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
        </div>

        <div class="bottom-data" style="padding:20px;">
            <?php if (!empty($_SESSION['error'])): ?>
                <ul style="color:red;">
                    <?php foreach ($_SESSION['error'] as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form action="?act=store_dichvu" method="POST" enctype="multipart/form-data" class="form-add">
                <div class="form-group">
                    <label>Tên dịch vụ</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" name="price" min="0" required>
                </div>

                <div class="form-group">
                    <label>Thời gian (phút)</label>
                    <input type="number" name="time" min="0">
                </div>

                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="danhmuc_id" required>
                        <option value="">--Chọn danh mục--</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button class="btnthem" style="padding:10px 25px;">Thêm Dịch Vụ</button>
            </form>
        </div>
    </main>
</div>

</body>
</html>
