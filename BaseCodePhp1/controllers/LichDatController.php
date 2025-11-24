<?php
require_once './models/LichDatModel.php';

class LichDatController
{
    public $model;
    public function __construct()
    {
        $this->model = new LichDatModel();
    }
    //hiển thị danh sách đơn đặt
    public function index()
    {
        $listLich = $this->model->getAllLichDat();
        require_once './views/admin/lichdat/list.php';
    }
    //phần cập nhật trạng thái
    public function updateStatus(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $status = $_POST['status'];
            $this->model->updateStatus($id,$status);
            header("Location: index.php?act=qlylichdat");
        }
    }
    // Trong LichDatController.php (hoặc NhanVienController.php)

// Ví dụ tạo hàm trong LichDatController, và sẽ gọi nó bằng route mới
public function updateStatusNhanVien() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $status = $_POST['status'];
        
        // Cập nhật trạng thái (vẫn dùng chung model update)
        $this->model->updateStatus($id, $status);
        
        // 💡 Chuyển hướng về Dashboard Nhân viên
        header("Location: index.php?act=nv-dashboard"); 
        exit(); 
    } else {
        // Xử lý truy cập bằng GET
        header("Location: index.php?act=nv-dashboard");
        exit();
    }
}
}
?>