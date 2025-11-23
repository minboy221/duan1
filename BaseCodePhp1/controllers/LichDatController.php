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
}
?>