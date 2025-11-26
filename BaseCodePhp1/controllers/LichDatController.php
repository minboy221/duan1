<?php
require_once './models/LichDatModel.php';
class LichDatController
{
    public $model;

    public function __construct()
    {
        $this->model = new LichDatModel();
    }

    // Hiển thị danh sách đơn đặt
    public function index()
    {
        if(isset($_GET['ajax']) && $_GET['ajax']==1){
            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if($page<1) $page=1;
            $offset = ($page-1)*$limit;

            $listLich = $this->model->getAllLichDatPaginate($limit,$offset);
            $total = $this->model->countAllLichDat();
            $totalPages = ceil($total/$limit);

            echo json_encode([
                'listLich'=>$listLich,
                'page'=>$page,
                'totalPages'=>$totalPages
            ]);
            exit;
        }

        $listLich = $this->model->getAllLichDat();
        require_once './views/admin/lichdat/list.php';
    }

    // Cập nhật trạng thái (admin)
    public function updateStatus()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            // FIX LỖI TẠI ĐÂY — lấy đúng tên biến
            $reason = $_POST['cancel_reason'] ?? null;

            if($id && $status){
                $this->model->updateStatus($id,$status,$reason);
            }
            header("Location: index.php?act=qlylichdat");
            exit();
        }
    }

    // Cập nhật trạng thái (nhân viên)
    public function updateStatusNhanVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if($id && $status){
                $this->model->updateStatus($id,$status);
            }
            header("Location: index.php?act=nv-dashboard"); 
            exit();
        } else {
            header("Location: index.php?act=nv-dashboard");
            exit();
        }
    }
}
?>
