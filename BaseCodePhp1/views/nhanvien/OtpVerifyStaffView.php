<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực OTP Nhân Viên</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">

    <style>
        /* 1. Thiết lập cơ bản */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            /* Màu nền Gradient hiện đại giống trang đổi mật khẩu */
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* 2. Container chính */
        .container-otp {
            background: #ffffff;
            width: 100%;
            max-width: 450px;
            padding: 40px;
            border-radius: 20px;
            /* Đổ bóng chiều sâu */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .otp-desc {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .otp-email {
            color: #1976D2;
            font-weight: 600;
            word-break: break-all;
        }

        /* 3. Khối nhập OTP */
        .otp-boxes {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .otp-input {
            width: 45px;
            height: 55px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #333;
            transition: all 0.3s ease;
            outline: none;
            background: #fafafa;
        }

        .otp-input:focus {
            border-color: #333;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.05);
        }

        /* 4. Nút bấm (Button) */
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #1976D2;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .btn-submit:hover {
            background: #444;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* 5. Gửi lại OTP & Thời gian */
        .otp-timer {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            font-weight: 500;
        }

        #countdown {
            color: #d32f2f;
            font-weight: bold;
        }

        .otp-resend {
            margin-bottom: 20px;
        }

        .otp-resend-btn {
            background: none;
            border: none;
            color: #1976D2;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
            transition: 0.3s;
        }

        .otp-resend-btn:hover {
            color: #333;
        }

        /* 6. Link quay lại */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #000;
            text-decoration: underline;
        }

        /* Thông báo lỗi */
        .alert-error {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #ffcdd2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            border: 1px solid #c8e6c9;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
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
    <link rel="stylesheet" href="<?= BASE_URL ?>public/responsive.css">
</head>

<body>

    <div class="container-otp">
        <h2><i class="fa-solid fa-shield-halved" style="margin-right:8px; color: #1976D2;"></i>Xác Thực OTP</h2>
        <p class="otp-desc">
            Mã xác thực đã được gửi đến email<br>
            <span class="otp-email"><?= $masked_email ?? '' ?></span>
        </p>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> <?= $success ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>?act=<?= $otp_action ?? 'verify_otp_changepass' ?>" method="POST" id="otpForm">
            <div class="otp-boxes">
                <input type="text" maxlength="1" class="otp-input" data-index="0" autocomplete="off" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-input" data-index="1" autocomplete="off" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-input" data-index="2" autocomplete="off" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-input" data-index="3" autocomplete="off" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-input" data-index="4" autocomplete="off" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-input" data-index="5" autocomplete="off" inputmode="numeric">
            </div>
            <!-- Hidden input chứa OTP đầy đủ -->
            <input type="hidden" name="otp" id="otpHidden">

            <div class="otp-timer">
                <i class="fa-regular fa-clock"></i> Mã hết hạn sau: <span id="countdown">05:00</span>
            </div>

            <button type="submit" class="btn-submit">
                Xác Nhận <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i>
            </button>
        </form>

        <!-- Gửi lại OTP -->
        <div class="otp-resend" id="resendBlock" style="display:none;">
            <form action="<?= BASE_URL ?>?act=resend_otp" method="POST">
                <input type="hidden" name="resend_type" value="<?= $otp_type ?? 'changepass' ?>">
                <button type="submit" class="otp-resend-btn">
                    <i class="fa-solid fa-rotate-right"></i> Gửi lại mã OTP
                </button>
            </form>
        </div>

        <a href="index.php?act=doimatkhau_nhanvien" class="back-link">
            <i class="fa-solid fa-arrow-left-long"></i> Quay lại Đổi Mật Khẩu
        </a>
    </div>

    <script>
        // === OTP Input Logic ===
        const inputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otpHidden');
        const form = document.getElementById('otpForm');

        // Auto focus ô đầu tiên
        inputs[0].focus();

        inputs.forEach((input, index) => {
            // Chỉ cho nhập số
            input.addEventListener('input', (e) => {
                let val = e.target.value.replace(/[^0-9]/g, '');
                e.target.value = val;

                if (val && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHidden();
            });

            // Xử lý phím Backspace
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && index > 0) {
                    inputs[index - 1].focus();
                    inputs[index - 1].value = '';
                    updateHidden();
                }
            });

            // Paste OTP
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                let paste = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
                for (let i = 0; i < Math.min(paste.length, inputs.length); i++) {
                    inputs[i].value = paste[i];
                }
                if (paste.length >= inputs.length) {
                    inputs[inputs.length - 1].focus();
                } else {
                    inputs[Math.min(paste.length, inputs.length - 1)].focus();
                }
                updateHidden();
            });
        });

        function updateHidden() {
            let otp = '';
            inputs.forEach(input => otp += input.value);
            otpHidden.value = otp;
        }

        // Submit form khi ấn Xác nhận - cập nhật hidden trước
        form.addEventListener('submit', () => {
            updateHidden();
        });

        // === Countdown Timer ===
        let timeLeft = 300; // 5 phút = 300 giây
        const countdownEl = document.getElementById('countdown');
        const resendBlock = document.getElementById('resendBlock');

        const timer = setInterval(() => {
            timeLeft--;
            let min = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            let sec = (timeLeft % 60).toString().padStart(2, '0');
            countdownEl.textContent = min + ':' + sec;

            if (timeLeft <= 0) {
                clearInterval(timer);
                countdownEl.textContent = 'Hết hạn!';
                countdownEl.style.color = '#ff4444';
            }
        }, 1000);

        // Hiện nút gửi lại sau 60 giây
        setTimeout(() => {
            resendBlock.style.display = 'block';
        }, 60000);
    </script>
</body>

</html>
