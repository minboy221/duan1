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
