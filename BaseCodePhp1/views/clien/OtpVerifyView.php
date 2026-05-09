<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực OTP | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dangky-dangnhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/responsive.css">
</head>

<body>
    <div class="container">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="dangnhap otp-container">
                <div class="title">
                    <h2><i class="fa-solid fa-shield-halved" style="margin-right:8px;"></i>Xác Thực OTP</h2>
                </div>

                <p class="otp-desc">
                    Mã xác thực đã được gửi đến email<br>
                    <strong class="otp-email"><?= $masked_email ?? '' ?></strong>
                </p>

                <form action="<?= BASE_URL ?>?act=<?= $otp_action ?? 'verify_otp_register' ?>" method="POST" id="otpForm">
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

                    <?php if (!empty($error)): ?>
                        <p class="otp-error">
                            <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                        </p>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <p class="otp-success">
                            <i class="fa fa-check-circle"></i> <?= $success ?>
                        </p>
                    <?php endif; ?>

                    <!-- Đếm ngược -->
                    <div class="otp-timer">
                        <i class="fa-regular fa-clock"></i>
                        Mã hết hạn sau: <span id="countdown">05:00</span>
                    </div>

                    <button class="btn otp-btn" type="submit">
                        <i class="fa-solid fa-check"></i> Xác Nhận
                    </button>
                </form>

                <!-- Gửi lại OTP -->
                <div class="otp-resend" id="resendBlock" style="display:none;">
                    <form action="<?= BASE_URL ?>?act=resend_otp" method="POST">
                        <input type="hidden" name="resend_type" value="<?= $otp_type ?? 'register' ?>">
                        <button type="submit" class="otp-resend-btn">
                            <i class="fa-solid fa-rotate-right"></i> Gửi lại mã OTP
                        </button>
                    </form>
                </div>

                <div class="footer" style="margin-top:20px;">
                    <?php if (($otp_type ?? '') === 'register'): ?>
                        <a href="<?= BASE_URL ?>?act=dangky_khachhang" class="link">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại đăng ký
                        </a>
                    <?php elseif (($otp_type ?? '') === 'forgot'): ?>
                        <a href="<?= BASE_URL ?>?act=quenmatkhau" class="link">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>?act=home" class="link">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại trang chủ
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </main>
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

        // Submit form khi gõ đủ 6 số - cập nhật hidden trước
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
