<?php
$editing = isset($nv);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên | 31Shine</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/homeadmin.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    
    <style>
        body { background-color: #f5f6fa; color:#333; font-family:'Segoe UI',sans-serif; transition:0.3s;}
        body.dark { background-color:#1f1f2e; color:#f0f0f0; }
        .form-container { max-width:600px; margin:40px auto; padding:20px 30px; background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
        body.dark .form-container { background:#2a2a3d; }
        .form-container h2 { text-align:center; margin-bottom:25px; }
        .form-container label { display:block; margin-bottom:15px; font-weight:500; }
        .form-container input, .form-container select { width:100%; padding:10px; border:1px solid #ccc; border-radius:6px; margin-top:5px; }
        .form-container button { background:#4CAF50; color:#fff; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; }
        .form-container button:hover { background:#45a049; }
        .form-container a { display:inline-block; margin-top:15px; color:#4CAF50; text-decoration:none; }
        .form-container a:hover { text-decoration:underline; }
    </style>
</head>
<body>
<div class="form-container">
    <h2><?= $editing ? 'Sửa' : 'Thêm' ?> Nhân Viên</h2>
    <form method="POST" action="<?= $editing ? "index.php?act=admin-nhanvien-update&id={$nv['id']}" : "index.php?act=admin-nhanvien-create-submit" ?>">

        <label>Tên:
            <input type="text" name="name" value="<?= $editing ? htmlspecialchars($nv['name']) : '' ?>" required>
        </label>

        <label>Email:
            <input type="email" name="email" value="<?= $editing ? htmlspecialchars($nv['email']) : '' ?>" required>
        </label>

        <?php if(!$editing): ?>
        <label>Mật khẩu:
            <input type="password" name="password" required>
        </label>
        <?php endif; ?>

        <label>Số điện thoại:
            <input type="text" name="phone" value="<?= $editing ? htmlspecialchars($nv['phone']) : '' ?>" required>
        </label>

        <label>Giới Tính:
            <select name="gioitinh" required>
                <option value="nam" <?= ($editing && ($nv['gioitinh'] ?? '')=='nam') ? 'selected' : '' ?>>Nam</option>
                <option value="nu" <?= ($editing && ($nv['gioitinh'] ?? '')=='nu') ? 'selected' : '' ?>>Nữ</option>
            </select>
        </label>

        <label>Quyền:
            <select name="role_id" required>
                <option value="">Chọn quyền</option>

                <?php foreach($roles as $role): ?>
                    <option value="<?= $role['id'] ?>"
                        <?= ($editing && isset($nv['role_id']) && $nv['role_id']==$role['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($role['name']) ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </label>

        <br>
        <button type="submit"><?= $editing ? 'Cập nhật' : 'Thêm' ?></button>
    </form>

    <a href="index.php?act=admin-nhanvien">⬅ Quay lại</a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggler = document.getElementById('theme-toggle');
        if (toggler) {
            toggler.addEventListener('change', function () {
                if (this.checked) document.body.classList.add('dark');
                else document.body.classList.remove('dark');
            });
        }
    });
</script>
</body>
</html>
