<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once './src/PHPMailer.php';
require_once './src/SMTP.php';
require_once './src/Exception.php';

/**
 * Tạo mã OTP 6 chữ số ngẫu nhiên
 */
function generateOTP() {
    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
}

/**
 * Gửi OTP qua email
 * @param string $email - Email người nhận
 * @param string $otp - Mã OTP 6 số
 * @param string $purpose - Mục đích: 'register', 'forgot', 'changepass'
 * @return bool
 */
function sendOTP($email, $otp, $purpose = 'register') {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'phamtuan20061969@gmail.com';
        $mail->Password = 'nuxsavohkrkjhcqn';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('phamtuan20061969@gmail.com', '31Shine');
        $mail->addAddress($email);

        // Xác định tiêu đề và nội dung theo mục đích
        switch ($purpose) {
            case 'register':
                $subject = '31Shine - Xác thực đăng ký tài khoản';
                $purposeText = 'xác thực đăng ký tài khoản';
                break;
            case 'forgot':
                $subject = '31Shine - Xác thực đặt lại mật khẩu';
                $purposeText = 'đặt lại mật khẩu';
                break;
            case 'changepass':
                $subject = '31Shine - Xác thực đổi mật khẩu';
                $purposeText = 'đổi mật khẩu';
                break;
            default:
                $subject = '31Shine - Mã xác thực OTP';
                $purposeText = 'xác thực';
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = '
        <div style="max-width:480px;margin:0 auto;font-family:Arial,sans-serif;background:#1a1a2e;border-radius:16px;overflow:hidden;border:1px solid #f5c542;">
            <div style="background:linear-gradient(135deg,#f5c542,#e6a817);padding:25px;text-align:center;">
                <h1 style="margin:0;color:#1a1a2e;font-size:28px;letter-spacing:2px;">31SHINE</h1>
                <p style="margin:5px 0 0;color:#333;font-size:13px;">Hair Salon & Spa</p>
            </div>
            <div style="padding:30px;text-align:center;">
                <p style="color:#ccc;font-size:15px;margin:0 0 8px;">Mã OTP để <strong style="color:#f5c542;">' . $purposeText . '</strong></p>
                <div style="background:#16213e;border:2px dashed #f5c542;border-radius:12px;padding:20px;margin:20px 0;">
                    <span style="font-size:36px;font-weight:bold;letter-spacing:12px;color:#f5c542;">' . $otp . '</span>
                </div>
                <p style="color:#999;font-size:13px;margin:0;">⏱ Mã có hiệu lực trong <strong style="color:#ff6b6b;">5 phút</strong></p>
                <p style="color:#666;font-size:12px;margin:15px 0 0;">Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email.</p>
            </div>
            <div style="background:#16213e;padding:15px;text-align:center;border-top:1px solid #333;">
                <p style="margin:0;color:#555;font-size:11px;">© 2026 31Shine. All rights reserved.</p>
            </div>
        </div>';

        return $mail->send();
    } catch (Exception $e) {
        error_log("Lỗi gửi mail OTP: " . $mail->ErrorInfo);
        return false;
    }
}
?>