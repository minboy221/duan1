<?php
require_once './models/KhachHangModel.php';
require_once './models/NhanVienModel.php';
class KhachHangController
{
    private $khachhang;
    private $nhanvien;

    public function __construct()
    {
        $this->khachhang = new Khachhang();
        $this->nhanvien = new NhanVienModel();
    }
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

    public function register()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';

            //phần kiểm tra tài kho
            $check = $this->khachhang->login($email);
            if ($check) {
                $error = "Email đã tồn tại trong hệ thống!";
            } else {
                $password_md5 = md5($password);
                $result = $this->khachhang->register($name, $email, $phone, $password_md5);

                if ($result) {
                    echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='index.php?act=dangnhap_khachhang';</script>";
                    exit();
                } else {
                    $error = "Đăng ký thất bại.";
                }
            }
        }

        require_once './views/clien/DangkyView.php';
    }
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

    //phần quên mk cho nhân viên và khách hàng
    public function forgotPassword()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $new_pass = $_POST['new_password'] ?? '';
            $confirm_pass = $_POST['confirm_password'] ?? '';

            if (empty($email) || empty($phone) || empty($new_pass) || empty($confirm_pass)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } elseif ($new_pass !== $confirm_pass) {
                $error = "Mật khẩu xác nhận không khớp!";
            } else {

                $new_pass_md5 = md5($new_pass);

                // 1. Check Khách hàng 
                $khachhang = $this->khachhang->checkUserReset($email, $phone);

                if ($khachhang) {
                    $this->khachhang->updatePassword($email, $new_pass_md5);
                    echo "<script>alert('Đổi mật khẩu Khách hàng thành công!'); window.location.href='index.php?act=dangnhap_khachhang';</script>";
                    exit();
                }

                // 2. Check Nhân viên
                else {
                    $staff = $this->nhanvien->checkStaffReset($email, $phone);

                    if ($staff) {
                        // --- LOGIC KIỂM TRA 14 NGÀY ---
                        $allow_reset = true;

                        // Nếu đã từng đổi pass trước đây (cột last_reset_pass không null)
                        if (!empty($staff['last_reset_pass'])) {
                            $last_reset = strtotime($staff['last_reset_pass']); // Thời gian lần đổi cuối
                            $now = time(); // Thời gian hiện tại

                            // Tính khoảng cách ngày
                            $days_diff = ($now - $last_reset) / (60 * 60 * 24);

                            if ($days_diff < 14) {
                                $allow_reset = false;
                                // Tính số ngày còn lại phải đợi
                                $wait_days = ceil(14 - $days_diff);
                                $error = "Bạn vừa đổi mật khẩu gần đây. Vui lòng đợi thêm $wait_days ngày nữa để thực hiện lại.";
                            }
                        }

                        // Nếu đủ điều kiện thì cho đổi
                        if ($allow_reset) {
                            $this->nhanvien->updatePassword($email, $new_pass_md5);
                            echo "<script>
                                    alert('Đổi mật khẩu Nhân viên thành công!'); 
                                    window.location.href='index.php?act=dangnhap_khachhang';
                                  </script>";
                            exit();
                        }

                    } else {
                        $error = "Email hoặc số điện thoại không chính xác!";
                    }
                }
            }
        }

        require_once './views/clien/QuenmatkhauView.php';
    }
    //phần đổi mk cho nhân viên
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
                    // 2. Mã hóa mật khẩu mới bằng password_hash (BCRYPT)
                    $new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);

                    // Cập nhật vào DB
                    $this->nhanvien->changePasswordById($user_id, $new_pass_hash);

                    echo "<script>
                            alert('Đổi mật khẩu thành công! Vui lòng đăng nhập lại.');
                            window.location.href='index.php?act=logout'; 
                          </script>";
                    exit();
                }
            }
        }

        // Gọi View
        require_once './views/nhanvien/DoiMatKhauView.php';
    }
}