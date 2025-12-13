<?php
require_once './models/LichDatModel.php';
require_once './models/ThoModel.php'; 

class LichDatController
{
    public $model;
    public $thoModel;

    public function __construct()
    {
        $this->model = new LichDatModel();
        $this->thoModel = new ThoModel();
    }

    // --- HIỂN THỊ DANH SÁCH ĐƠN ĐẶT (Đã gộp mảng + Phân trang) ---
public function index()
    {
        // Lấy tham số lọc/tìm kiếm từ URL
        $keyword = $_GET['keyword'] ?? null;
        $date = $_GET['date'] ?? null;
        $time = $_GET['time'] ?? null;
        $status = $_GET['status'] ?? null;
        $thoName = $_GET['tho_name'] ?? null; // LẤY TÊN THỢ
        
        $limit = 999999999;
        $offset = 0;
        
        // 1. Xử lý AJAX Phân trang (Nếu có yêu cầu từ JS)
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            if ($page < 1) $page = 1;
            $offset = ($page - 1) * $limit;

            // LẤY DỮ LIỆU CÓ LỌC/TÌM KIẾM
            $rawList = $this->model->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time, $status, $thoName);

            // TÍNH TỔNG SỐ TRANG DỰA TRÊN LỌC/TÌM KIẾM
            $total = $this->model->countAllLichDat($keyword, $date, $time, $status, $thoName);
            $totalPages = ceil($total / $limit);

            // Gộp dịch vụ và trả về JSON
            $listLich = $this->processMergeBooking($rawList);
            
            echo json_encode([
                'listLich' => array_values($listLich),
                'page' => $page,
                'totalPages' => $totalPages,
                'filter' => ['keyword' => $keyword, 'date' => $date, 'time' => $time, 'status' => $status, 'tho_name' => $thoName]
            ]);
            exit();
        }

        // 2. Xử lý hiển thị trang thường (Load lần đầu)
        $rawList = $this->model->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time, $status, $thoName); 

        // Gộp các dịch vụ cùng mã lịch lại
        $listLich = $this->processMergeBooking($rawList);

        // Tính tổng số trang
        $total = $this->model->countAllLichDat($keyword, $date, $time, $status, $thoName);
        $totalPages = ceil($total / $limit);
        $currentPage = 1;
        
        //LẤY DANH SÁCH TẤT CẢ THỢ CHO DROPDOWN
        $allTho = $this->thoModel->all(); 

        // Gửi sang View
        require_once './views/admin/lichdat/list.php';
    }
    private function processMergeBooking($rawList)
    {
        $listLich = [];

        foreach ($rawList as $item) {
            $ma = $item['ma_lich'];

            if (!isset($listLich[$ma])) {
                $listLich[$ma] = $item;
                $listLich[$ma]['total_price'] = (float) $item['price'];
            } else {
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
            // Ưu tiên lấy ID, nếu không có thì lấy MA_LICH
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
    public function detail()
{
    if (!isset($_GET['ma_lich'])) {
        echo "Không tìm thấy mã lịch!";
        exit();
    }

    $ma_lich = $_GET['ma_lich'];

    // Lấy đầy đủ thông tin đơn
    $bookingList = $this->model->getBookingByCode($ma_lich);

    if (empty($bookingList)) {
        echo "Không tìm thấy đơn đặt lịch!";
        exit();
    }

    // Vì 1 mã lịch có thể có N dịch vụ → tách ra phần chung + phần dịch vụ
    $info = $bookingList[0]; // thông tin chung
    $services = [];

    foreach ($bookingList as $item) {
        $services[] = [
            'ten_dichvu' => $item['ten_dichvu'],
            'price'      => $item['price']
        ];
    }

    require_once "./views/admin/lichdat/detail.php";
}

}
?>