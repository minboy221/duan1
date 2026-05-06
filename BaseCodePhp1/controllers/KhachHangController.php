<?php
require_once './models/KhachHangModel.php';
require_once './models/NhanVienModel.php';
require_once './utils/send_mail.php';

class KhachHangController
{
    private $khachhang;
    private $nhanvien;

    public function __construct()
    {
        $this->khachhang = new Khachhang();
        $this->nhanvien = new NhanVienModel();
    }

    /**
     * Ẩn một phần email: pham***@gmail.com
     */
    private function maskEmail($email)
    {
        $parts = explode('@', $email);
        $name = $parts[0];
        $domain = $parts[1];
        $len = strlen($name);
        if ($len <= 3) {
            $masked = $name[0] . str_repeat('*', $len - 1);
        } else {
            $masked = substr($name, 0, 3) . str_repeat('*', $len - 3);
        }
        return $masked . '@' . $domain;
    }

    // ============================
    // ĐĂNG NHẬP
    // ============================
    public function login()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // 1. Check admin cứng trước
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'admin';

                header('Location: index.php?act=homeadmin');
                exit();
            }

            // 2. Validate email cho khách hàng
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email không hợp lệ!';
            } else {
                $md5Pass = md5($password);
                $user = $this->khachhang->login($username); // Lấy user KH

                if ($user && $user['password'] === $md5Pass) {
                    
                    // Kiểm tra tài khoản khách hàng bị khóa
                    if (isset($user['status']) && $user['status'] == 0) {
                        $error = "Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên!";
                        require_once './views/clien/DangnhapView.php';
                        return;
                    }
                    
                    // Đăng nhập Khách hàng thành công
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = 'khachhang';

                    header('Location: index.php?act=home');
                    exit();
                } else {
                    // 3. Check đăng nhập cho nhân viên
                    $staff = $this->nhanvien->checkLogin($username); // Lấy staff (cần lấy cả status)
                    
                    if ($staff) {
                        
                        // Kiểm tra trạng thái tài khoản nhân viên bị khóa
                        if (isset($staff['status']) && $staff['status'] == 0) {
                            $error = "Tài khoản nhân viên của bạn đã bị khóa bởi quản trị viên!";
                            require_once './views/clien/DangnhapView.php';
                            return;
                        }
                        
                        if (password_verify($password, $staff['password'])) {
                            // Đăng nhập Nhân viên thành công
                            $_SESSION['is_logged_in'] = true;
                            $_SESSION['username'] = $staff['name'];
                            $_SESSION['user_id'] = $staff['id'];
                            // Gán role name từ DB (ví dụ: 'Nhân Viên')
                            $_SESSION['role'] = $staff['role_name'] ?? 'Staff'; 
                            
                            header('Location: index.php?act=nv-dashboard');
                            exit();
                        } else {
                            $error = 'Tài khoản hoặc mật khẩu không đúng!';
                        }
                    } else {
                        $error = 'Tài khoản hoặc mật khẩu không đúng!';
                    }
                }
            }
        }
        require_once './views/clien/DangnhapView.php';
    }

    // ============================
    // ĐĂNG KÝ - BƯỚC 1: Nhập thông tin + Gửi OTP
    // ============================
    public function register()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';

            //phần kiểm tra tài khoản
            $check = $this->khachhang->login($email);
            if ($check) {
                $error = "Email đã tồn tại trong hệ thống!";
            } else {
                // Lưu tạm thông tin vào session
                $_SESSION['pending_register'] = [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'password' => md5($password)
                ];

                // Tạo và gửi OTP
                $otp = generateOTP();
                $_SESSION['otp'] = $otp;
                $_SESSION['otp_time'] = time();
                $_SESSION['otp_type'] = 'register';
                $_SESSION['otp_email'] = $email;

                $sent = sendOTP($email, $otp, 'register');
                if ($sent) {
                    header('Location: index.php?act=verify_otp_register');
                    exit();
                } else {
                    $error = "Không thể gửi email OTP. Vui lòng thử lại!";
                }
            }
        }

        require_once './views/clien/DangkyView.php';
    }

    // ============================
    // ĐĂNG KÝ - BƯỚC 2: Xác thực OTP
    // ============================
    public function verifyOtpRegister()
    {
        $error = '';
        $success = '';
        $otp_action = 'verify_otp_register';
        $otp_type = 'register';
        $masked_email = $this->maskEmail($_SESSION['otp_email'] ?? '');

        // Kiểm tra session có dữ liệu đăng ký chưa
        if (!isset($_SESSION['pending_register']) || !isset($_SESSION['otp'])) {
            header('Location: index.php?act=dangky_khachhang');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputOtp = $_POST['otp'] ?? '';

            // Kiểm tra hết hạn (5 phút)
            $elapsed = time() - ($_SESSION['otp_time'] ?? 0);
            if ($elapsed > 300) {
                $error = "Mã OTP đã hết hạn! Vui lòng gửi lại.";
            } elseif ($inputOtp !== $_SESSION['otp']) {
                $error = "Mã OTP không chính xác!";
            } else {
                // OTP đúng → lưu vào DB
                $data = $_SESSION['pending_register'];
                $result = $this->khachhang->register($data['name'], $data['email'], $data['phone'], $data['password']);

                if ($result) {
                    // Xóa session tạm
                    unset($_SESSION['pending_register'], $_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['otp_type'], $_SESSION['otp_email']);
                    echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='index.php?act=dangnhap_khachhang';</script>";
                    exit();
                } else {
                    $error = "Đăng ký thất bại. Vui lòng thử lại!";
                }
            }
        }

        require_once './views/clien/OtpVerifyView.php';
    }

    // ============================
    // ĐĂNG XUẤT
    // ============================
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header('Location: index.php?act=home');
        exit();
    }

    // ============================
    // QUÊN MẬT KHẨU - BƯỚC 1: Nhập email + SĐT → Gửi OTP
    // ============================
    public function forgotPassword()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';

            if (empty($email) || empty($phone)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } else {
                // Kiểm tra email + phone trong DB
                $khachhang = $this->khachhang->checkUserReset($email, $phone);
                $staff = null;
                $userType = 'khachhang';

                if (!$khachhang) {
                    $staff = $this->nhanvien->checkStaffReset($email, $phone);
                    $userType = 'nhanvien';
                }

                if ($khachhang || $staff) {
                    // Nếu là nhân viên, kiểm tra giới hạn 14 ngày
                    if ($staff && !empty($staff['last_reset_pass'])) {
                        $last_reset = strtotime($staff['last_reset_pass']);
                        $days_diff = (time() - $last_reset) / (60 * 60 * 24);
                        if ($days_diff < 14) {
                            $wait_days = ceil(14 - $days_diff);
                            $error = "Bạn vừa đổi mật khẩu gần đây. Vui lòng đợi thêm $wait_days ngày nữa.";
                            require_once './views/clien/QuenmatkhauView.php';
                            return;
                        }
                    }

                    // Lưu thông tin tạm
                    $_SESSION['pending_forgot'] = [
                        'email' => $email,
                        'phone' => $phone,
                        'user_type' => $userType
                    ];

                    // Tạo và gửi OTP
                    $otp = generateOTP();
                    $_SESSION['otp'] = $otp;
                    $_SESSION['otp_time'] = time();
                    $_SESSION['otp_type'] = 'forgot';
                    $_SESSION['otp_email'] = $email;

                    $sent = sendOTP($email, $otp, 'forgot');
                    if ($sent) {
                        header('Location: index.php?act=verify_otp_forgot');
                        exit();
                    } else {
                        $error = "Không thể gửi email OTP. Vui lòng thử lại!";
                    }
                } else {
                    $error = "Email hoặc số điện thoại không chính xác!";
                }
            }
        }

        require_once './views/clien/QuenmatkhauView.php';
    }

    // ============================
    // QUÊN MẬT KHẨU - BƯỚC 2: Nhập OTP + Mật khẩu mới
    // ============================
    public function verifyOtpForgot()
    {
        $error = '';
        $success = '';
        $otp_action = 'verify_otp_forgot';
        $otp_type = 'forgot';
        $masked_email = $this->maskEmail($_SESSION['otp_email'] ?? '');

        if (!isset($_SESSION['pending_forgot']) || !isset($_SESSION['otp'])) {
            header('Location: index.php?act=quenmatkhau');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputOtp = $_POST['otp'] ?? '';

            // Kiểm tra hết hạn
            $elapsed = time() - ($_SESSION['otp_time'] ?? 0);
            if ($elapsed > 300) {
                $error = "Mã OTP đã hết hạn! Vui lòng quay lại gửi lại.";
            } elseif ($inputOtp !== $_SESSION['otp']) {
                $error = "Mã OTP không chính xác!";
            } else {
                // OTP đúng → hiện form nhập mật khẩu mới
                $_SESSION['otp_verified_forgot'] = true;
                header('Location: index.php?act=reset_password');
                exit();
            }
        }

        require_once './views/clien/OtpVerifyView.php';
    }

    // ============================
    // QUÊN MẬT KHẨU - BƯỚC 3: Đặt mật khẩu mới (sau khi OTP đúng)
    // ============================
    public function resetPassword()
    {
        $error = '';

        if (!isset($_SESSION['otp_verified_forgot']) || !isset($_SESSION['pending_forgot'])) {
            header('Location: index.php?act=quenmatkhau');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_pass = $_POST['new_password'] ?? '';
            $confirm_pass = $_POST['confirm_password'] ?? '';

            if (empty($new_pass) || empty($confirm_pass)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif (strlen($new_pass) < 6) {
                $error = "Mật khẩu mới phải ít nhất 6 ký tự!";
            } elseif ($new_pass !== $confirm_pass) {
                $error = "Mật khẩu xác nhận không khớp!";
            } else {
                $data = $_SESSION['pending_forgot'];
                $new_pass_md5 = md5($new_pass);

                if ($data['user_type'] === 'khachhang') {
                    $this->khachhang->updatePassword($data['email'], $new_pass_md5);
                } else {
                    $this->nhanvien->updatePassword($data['email'], $new_pass_md5);
                }

                // Xóa session
                unset($_SESSION['pending_forgot'], $_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['otp_type'], $_SESSION['otp_email'], $_SESSION['otp_verified_forgot']);

                echo "<script>alert('Đổi mật khẩu thành công!'); window.location.href='index.php?act=dangnhap_khachhang';</script>";
                exit();
            }
        }

        require_once './views/clien/ResetPasswordView.php';
    }

    // ============================
    // ĐỔI MẬT KHẨU KHÁCH HÀNG
    // ============================
    public function changePasswordClient()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        if (!isset($_SESSION['is_logged_in']) || !isset($_SESSION['user_id']) || $_SESSION['role'] !== 'khachhang') {
            header('Location: index.php?act=dangnhap_khachhang');
            exit();
        }

        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_pass = $_POST['old_password'] ?? '';
            $new_pass = $_POST['new_password'] ?? '';
            $confirm_pass = $_POST['confirm_password'] ?? '';

            if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif ($new_pass !== $confirm_pass) {
                $error = "Mật khẩu xác nhận không khớp!";
            } elseif (strlen($new_pass) < 6) {
                $error = "Mật khẩu mới phải từ 6 ký tự trở lên!";
            } else {
                $user_id = $_SESSION['user_id'];
                $current_user = $this->khachhang->findById($user_id);

                if (!$current_user || md5($old_pass) !== $current_user['password']) {
                    $error = "Mật khẩu hiện tại không chính xác!";
                } else {
                    $this->khachhang->updatePassword($current_user['email'], md5($new_pass));
                    echo "<script>
                            alert('Đổi mật khẩu thành công! Vui lòng đăng nhập lại.');
                            window.location.href='index.php?act=logout'; 
                          </script>";
                    exit();
                }
            }
        }

        require_once './views/clien/DoiMatKhauClientView.php';
    }

    // ============================
    // ĐỔI MẬT KHẨU NHÂN VIÊN - BƯỚC 1: Validate + Gửi OTP
    // ============================
    public function changePasswordStaff()
    {
        // 1. Kiểm tra đăng nhập
        if (session_status() === PHP_SESSION_NONE)
            session_start();

        // Nếu chưa đăng nhập hoặc không phải admin/nhân viên -> đuổi về login
        if (!isset($_SESSION['is_logged_in']) || !isset($_SESSION['user_id'])) {
            header('Location: index.php?act=dangnhap_khachhang');
            exit();
        }

        $error = '';
        $success = '';

        // Lấy thông tin user đang đăng nhập
        $user_id = $_SESSION['user_id'];
        $current_user = $this->nhanvien->findById($user_id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_pass = $_POST['old_password'] ?? '';
            $new_pass = $_POST['new_password'] ?? '';
            $confirm_pass = $_POST['confirm_password'] ?? '';

            // Validate
            if (empty($old_pass) || empty($new_pass) || empty($confirm_pass)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif ($new_pass !== $confirm_pass) {
                $error = "Mật khẩu xác nhận không khớp!";
            } elseif (strlen($new_pass) < 6) {
                $error = "Mật khẩu mới phải trên 6 ký tự!";
            } else {
                // 1. Kiểm tra mật khẩu cũ bằng password_verify
                if (!password_verify($old_pass, $current_user['password'])) {
                    $error = "Mật khẩu cũ không chính xác!";
                } else {
                    // 2. Lưu tạm thông tin đổi pass
                    $_SESSION['pending_changepass'] = [
                        'user_id' => $user_id,
                        'new_password' => password_hash($new_pass, PASSWORD_DEFAULT)
                    ];

                    // 3. Gửi OTP về email nhân viên
                    $otp = generateOTP();
                    $_SESSION['otp'] = $otp;
                    $_SESSION['otp_time'] = time();
                    $_SESSION['otp_type'] = 'changepass';
                    $_SESSION['otp_email'] = $current_user['email'];

                    $sent = sendOTP($current_user['email'], $otp, 'changepass');
                    if ($sent) {
                        header('Location: index.php?act=verify_otp_changepass');
                        exit();
                    } else {
                        $error = "Không thể gửi email OTP. Vui lòng thử lại!";
                    }
                }
            }
        }

        // Gọi View
        require_once './views/nhanvien/DoiMatKhauView.php';
    }

    // ============================
    // ĐỔI MẬT KHẨU NHÂN VIÊN - BƯỚC 2: Xác thực OTP
    // ============================
    public function verifyOtpChangePass()
    {
        $error = '';
        $success = '';
        $otp_action = 'verify_otp_changepass';
        $otp_type = 'changepass';
        $masked_email = $this->maskEmail($_SESSION['otp_email'] ?? '');

        if (!isset($_SESSION['pending_changepass']) || !isset($_SESSION['otp'])) {
            header('Location: index.php?act=doimatkhau_nhanvien');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputOtp = $_POST['otp'] ?? '';

            // Kiểm tra hết hạn
            $elapsed = time() - ($_SESSION['otp_time'] ?? 0);
            if ($elapsed > 300) {
                $error = "Mã OTP đã hết hạn! Vui lòng thực hiện lại.";
            } elseif ($inputOtp !== $_SESSION['otp']) {
                $error = "Mã OTP không chính xác!";
            } else {
                // OTP đúng → đổi mật khẩu
                $data = $_SESSION['pending_changepass'];
                $this->nhanvien->changePasswordById($data['user_id'], $data['new_password']);

                // Xóa session
                unset($_SESSION['pending_changepass'], $_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['otp_type'], $_SESSION['otp_email']);

                echo "<script>
                        alert('Đổi mật khẩu thành công! Vui lòng đăng nhập lại.');
                        window.location.href='index.php?act=logout'; 
                      </script>";
                exit();
            }
        }

        require_once './views/nhanvien/OtpVerifyStaffView.php';
    }

    // ============================
    // GỬI LẠI OTP
    // ============================
    public function resendOtp()
    {
        $type = $_POST['resend_type'] ?? $_SESSION['otp_type'] ?? '';
        $email = $_SESSION['otp_email'] ?? '';

        if (empty($email) || empty($type)) {
            header('Location: index.php?act=home');
            exit();
        }

        // Tạo OTP mới
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_time'] = time();

        sendOTP($email, $otp, $type);

        // Redirect lại form OTP
        switch ($type) {
            case 'register':
                header('Location: index.php?act=verify_otp_register');
                break;
            case 'forgot':
                header('Location: index.php?act=verify_otp_forgot');
                break;
            case 'changepass':
                header('Location: index.php?act=verify_otp_changepass');
                break;
            default:
                header('Location: index.php?act=home');
        }
        exit();
    }
}