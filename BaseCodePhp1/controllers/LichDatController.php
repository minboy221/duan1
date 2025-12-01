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
// Trong LichDatController.php, hàm index()

    public function index()
    {
        // 💡 Lấy tham số lọc/tìm kiếm từ URL (Mã lịch, KH, Ngày, Giờ)
        $keyword = $_GET['keyword'] ?? null;
        $date = $_GET['date'] ?? null;
        $time = $_GET['time'] ?? null;
        $limit = 10;
        $offset = 0;

        // 1. Xử lý AJAX Phân trang (Nếu có yêu cầu từ JS)
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            if ($page < 1)
                $page = 1;
            $offset = ($page - 1) * $limit;

            // 💡 LẤY DỮ LIỆU CÓ LỌC/TÌM KIẾM
            // Bạn cần cập nhật hàm getAllLichDatPaginate trong Model để nhận 3 tham số lọc này.
            $rawList = $this->model->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time);

            // 💡 TÍNH TỔNG SỐ TRANG DỰA TRÊN LỌC/TÌM KIẾM
            $total = $this->model->countAllLichDat($keyword, $date, $time);
            $totalPages = ceil($total / $limit);

            // Gộp dịch vụ và trả về JSON
            $listLich = $this->processMergeBooking($rawList);

            echo json_encode([
                'listLich' => array_values($listLich),
                'page' => $page,
                'totalPages' => $totalPages,
                'filter' => ['keyword' => $keyword, 'date' => $date, 'time' => $time]
            ]);
            exit();
        }

        // 2. Xử lý hiển thị trang thường (Load lần đầu)
        // 💡 LẤY DỮ LIỆU CÓ LỌC/TÌM KIẾM CHO LẦN TẢI ĐẦU
        $rawList = $this->model->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time);

        // Gộp các dịch vụ cùng mã lịch lại
        $listLich = $this->processMergeBooking($rawList);

        // Tính tổng số trang (để truyền cho View)
        $total = $this->model->countAllLichDat($keyword, $date, $time);
        $totalPages = ceil($total / $limit);
        $currentPage = 1;

        // Gửi sang View
        require_once './views/admin/lichdat/list.php';
    }
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
                $this->model->updateStatusByMaLich($id, $status, $reason);
            }

            // Quay lại trang quản lý
            header("Location: index.php?act=qlylichdat");
            exit();
        }
    }

    // Cập nhật trạng thái dành riêng cho Nhân viên (Quay về Dashboard)
    public function updateStatusNhanVien()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;
            $reason = $_POST['cancel_reason'] ?? null;

            if ($id && $status) {
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