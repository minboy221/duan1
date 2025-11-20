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

            // 1. Check admin trước
            if ($username === 'admin' && $password === 'admin123') {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'admin';

                header('Location: index.php?act=homeadmin');
                exit();
            }

            // 2. Validate email cho khách hàng (không kiểm tra với admin)
            if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $error = 'Email không hợp lệ!';
            } else {
                $md5Pass = md5($password);
                $user = $this->khachhang->login($username);

                if ($user && $user['password'] === $md5Pass) {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['username'] = $user['name'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['role'] = 'khachhang';

                    header('Location: index.php?act=home');
                    exit();
                } else {
                    //phần đăng nhập cho nhân viên
                    $staff = $this->nhanvien->checkLogin($username);
                    if ($staff && password_verify($password, $staff['password'])) {
                        $_SESSION['is_logged_in'] = true;
                        $_SESSION['username'] = $staff['name'];
                        $_SESSION['user_id'] = $staff['id'];
                        $_SESSION['role'] = $staff['role_name'] ?? 'Staff';
                        header('Location: index.php?act=nv-dashboard');
                        exit();
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
}
?>