<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu Nhân Viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* 1. Thiết lập cơ bản */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* Màu nền Gradient hiện đại */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* 2. Container chính (Thẻ Form) */
        .container-changepass {
            background: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 20px;
            /* Đổ bóng chiều sâu */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* 3. Input Group */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            padding-left: 40px;
            /* Chừa chỗ cho icon */
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            outline: none;
            color: #333;
        }

        /* Icon bên trong input */
        .form-group i {
            position: absolute;
            left: 15px;
            top: 42px;
            /* Căn chỉnh tùy theo height của label */
            color: #aaa;
            font-size: 14px;
            transition: 0.3s;
        }

        /* Hiệu ứng khi click vào input */
        .form-group input:focus {
            border-color: #333;
            /* Màu đen chủ đạo của 31Shine hoặc màu thương hiệu */
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        .form-group input:focus+i {
            color: #333;
        }

        /* 4. Nút bấm (Button) */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #1976D2;
            /* Màu đen sang trọng */
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background: #444;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* 5. Thông báo lỗi */
        .alert-error {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            border: 1px solid #ffcdd2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* 6. Link quay lại */
        .back-link {
            display: block;
            margin-top: 25px;
            text-align: center;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .back-link:hover {
            color: #000;
            text-decoration: underline;
        }

        /* Animation xuất hiện */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="container-changepass">
        <h2>Đổi Mật Khẩu</h2>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="index.php?act=doimatkhau_nhanvien" method="POST">

            <div class="form-group">
                <label for="old_pass">Mật khẩu hiện tại</label>
                <input type="password" id="old_pass" name="old_password" required placeholder="••••••">
                <i class="fa-solid fa-lock"></i>
            </div>

            <div class="form-group">
                <label for="new_pass">Mật khẩu mới</label>
                <input type="password" id="new_pass" name="new_password" required placeholder="••••••">
                <i class="fa-solid fa-key"></i>
            </div>

            <div class="form-group">
                <label for="confirm_pass">Xác nhận mật khẩu mới</label>
                <input type="password" id="confirm_pass" name="confirm_password" required placeholder="••••••">
                <i class="fa-solid fa-check-double"></i>
            </div>

            <button type="submit" class="btn-submit">
                Cập nhật mật khẩu <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i>
            </button>

            <a href="index.php?act=nv-dashboard" class="back-link">
                <i class="fa-solid fa-arrow-left-long"></i> Quay lại Dashboard
            </a>
        </form>
    </div>

</body>

</html>