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
        // 1. Lấy tất cả dữ liệu thô
        $rawList = $this->model->getAllLichDat();

        // 2. LOGIC GỘP MẢNG (Giống hệt bên Client)
        $listLich = [];

        foreach ($rawList as $item) {
            $ma = $item['ma_lich'];

            if (!isset($listLich[$ma])) {
                $listLich[$ma] = $item;
                $listLich[$ma]['total_price'] = (float) $item['price'];
            } else {
                $listLich[$ma]['ten_dichvu'] .= ', <br>' . $item['ten_dichvu']; // Bên Admin dùng <br> cho dễ nhìn
                $listLich[$ma]['total_price'] += (float) $item['price'];
            }
        }

        // 3. Gửi danh sách đã gộp sang View Admin
        require_once './views/admin/lichdat/list.php';
    }


    // Ví dụ tạo hàm trong LichDatController, và sẽ gọi nó bằng route mới
    public function updateStatusNhanVien()
    {
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
    //hàm cập nhật trạng thái cho ADMIN
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy ma_lich thay vì id
            $ma_lich = $_POST['ma_lich'];
            $status = $_POST['status'];

            // Gọi model cập nhật toàn bộ dịch vụ của mã này
            $this->model->updateStatus($ma_lich, $status);

            header("Location: index.php?act=qlylichdat");
        }
    }
}
?>