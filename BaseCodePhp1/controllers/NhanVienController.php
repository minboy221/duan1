<?php
require_once './models/NhanVienModel.php';
require_once './models/LichDatModel.php';

class NhanVienController
{
    protected $nvModel;
    protected $lichModel;

    public function __construct()
    {
        $this->nvModel = new NhanVienModel();
        $this->lichModel = new LichDatModel();
    }

    // form login
    public function loginForm()
    {
        include 'views/nhanvien/login.php';
    }

    // xử lý login
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $nv = $this->nvModel->findByEmail($email);

            if (!$nv || !password_verify($password, $nv['password'])) {
                $_SESSION['error'] = "Sai email hoặc mật khẩu!";
                header("location: index.php?act=nv-login");
                exit;
            }

            $_SESSION['nhanvien'] = $nv;
            header("location: index.php?act=nv-dashboard");
            exit;
        }
    }

    // giao diện dashboard
    public function dashboard()
    {
        $lich = $this->lichModel->all();
        include 'views/nhanvien/dashboard.php';
    }

    // xem chi tiết lịch
    public function chitiet()
    {
        $id = $_GET['id'];
        $lich = $this->lichModel->find($id);
        include 'views/nhanvien/chitiet.php';
    }

    // xác nhận lịch
    public function xacnhan()
    {
        $id = $_GET['id'];
        $this->lichModel->updateStatus($id, 1);
        header("location: index.php?act=nv-dashboard");
    }

    // hủy lịch
    public function huy()
    {
        $id = $_GET['id'];
        $this->lichModel->updateStatus($id, 2);
        header("location: index.php?act=nv-dashboard");
    }
}
