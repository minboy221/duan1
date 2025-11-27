<?php
require_once './models/LichDatModel.php';

class LichDatController
{
    public $model;

    public function __construct()
    {
        $this->model = new LichDatModel();
    }

    // --- HIỂN THỊ DANH SÁCH ĐƠN ĐẶT (Đã gộp mảng + Phân trang) ---
    public function index()
    {
        // 1. Xử lý AJAX Phân trang (Nếu có yêu cầu từ JS)
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            $limit = 10;
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            if ($page < 1)
                $page = 1;
            $offset = ($page - 1) * $limit;

            // Lấy dữ liệu thô có phân trang
            $rawList = $this->model->getAllLichDatPaginate($limit, $offset);

            // QUAN TRỌNG: Gọi hàm gộp mảng trước khi trả về JSON
            $listLich = $this->processMergeBooking($rawList);

            $total = $this->model->countAllLichDat();
            $totalPages = ceil($total / $limit);

            echo json_encode([
                'listLich' => array_values($listLich), // Chuyển về mảng chỉ số số để JS dễ đọc
                'page' => $page,
                'totalPages' => $totalPages
            ]);
            exit;
        }

        // 2. Xử lý hiển thị trang thường (Load lần đầu)
        $rawList = $this->model->getAllLichDat(); // Lấy hết hoặc lấy trang 1 tùy bạn

        // QUAN TRỌNG: Gộp các dịch vụ cùng mã lịch lại
        $listLich = $this->processMergeBooking($rawList);

        // Gửi sang View
        require_once './views/admin/lichdat/list.php';
    }

    // --- HÀM HỖ TRỢ: Gộp các dịch vụ cùng mã lịch ---
    // Hàm này giúp code gọn hơn, không phải viết lặp lại logic gộp
    private function processMergeBooking($rawList)
    {
        $listLich = [];

        foreach ($rawList as $item) {
            $ma = $item['ma_lich'];

            if (!isset($listLich[$ma])) {
                // Nếu chưa có mã này trong danh sách -> Thêm mới
                $listLich[$ma] = $item;
                $listLich[$ma]['total_price'] = (float) $item['price'];
            } else {
                // Nếu đã có -> Gộp tên dịch vụ và cộng tiền
                $listLich[$ma]['ten_dichvu'] .= ', <br>' . $item['ten_dichvu'];
                $listLich[$ma]['total_price'] += (float) $item['price'];
            }
        }
        return $listLich;
    }

    // --- CẬP NHẬT TRẠNG THÁI (Dùng cho Admin & Nhân viên) ---
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ưu tiên lấy ID, nếu không có thì lấy MA_LICH (để tương thích cả 2 cách gọi)
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;
            $reason = $_POST['cancel_reason'] ?? null;

            if ($id && $status) {
                // Gọi model update
                $this->model->updateStatus($id, $status, $reason);
            }

            // Quay lại trang quản lý
            header("Location: index.php?act=qlylichdat");
            exit();
        }
    }

    // Cập nhật trạng thái dành riêng cho Nhân viên (Quay về Dashboard)
// Trong LichDatController.php

public function updateStatusNhanVien()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;
        // 💡 LẤY THÊM TRƯỜNG LÝ DO HỦY
        $reason = $_POST['cancel_reason'] ?? null; 

        if ($id && $status) {
            // 💡 TRUYỀN THÊM BIẾN $reason CHO MODEL
            $this->model->updateStatus($id, $status, $reason); 
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