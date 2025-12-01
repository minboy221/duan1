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

    // --- GIAO DIỆN DASHBOARD (CÓ LỌC & PHÂN TRANG) ---
    public function dashboard()
    {
        // 1. Lấy tham số lọc từ URL
        $keyword = $_GET['keyword'] ?? null;
        $date = $_GET['date'] ?? null;
        $time = $_GET['time'] ?? null;

        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        // 2. Xử lý AJAX (Nếu JS gọi để phân trang/lọc không tải lại)
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            // Gọi Model (Sửa $this->model thành $this->lichModel)
            $rawList = $this->lichModel->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time);
            $total = $this->lichModel->countAllLichDat($keyword, $date, $time);
            $totalPages = ceil($total / $limit);

            // Gộp dịch vụ
            $listLich = $this->processMergeBooking($rawList);

            echo json_encode([
                'listLich' => array_values($listLich),
                'page' => $page,
                'totalPages' => $totalPages,
                'filter' => ['keyword' => $keyword, 'date' => $date, 'time' => $time]
            ]);
            exit();
        }

        // 3. Xử lý hiển thị thường (Lần đầu vào trang)
        $rawList = $this->lichModel->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time);

        // Gộp dịch vụ (Hàm này bạn bị thiếu ở code cũ)
        $listLich = $this->processMergeBooking($rawList);

        $total = $this->lichModel->countAllLichDat($keyword, $date, $time);
        $totalPages = ceil($total / $limit);
        $currentPage = $page;

        // Gửi sang View
        require_once './views/nhanvien/dashboard.php';
    }

    // --- HÀM HỖ TRỢ: GỘP MẢNG DỊCH VỤ (Bắt buộc phải có) ---
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

    // --- CÁC HÀM KHÁC (Chi tiết, Xác nhận, Hủy) ---
    public function chitiet()
    {
        $ma_lich = $_GET['ma_lich'] ?? null; // Nên dùng ma_lich
        if (!$ma_lich) {
            header("location: index.php?act=nv-dashboard");
            exit;
        }

        $bookingList = $this->lichModel->getBookingByCode($ma_lich);
        if (empty($bookingList)) {
            echo "Không tìm thấy đơn hàng";
            exit;
        }

        // Xử lý gộp cho trang chi tiết
        $booking = $bookingList[0];
        $totalPrice = 0;
        foreach ($bookingList as $item) {
            $totalPrice += $item['price'];
        }
        $booking['price'] = $totalPrice;

        include 'views/nhanvien/chitiet.php';
    }

    public function xacnhan()
    {
        $id = $_GET['id'];
        $this->lichModel->updateStatus($id, 'confirmed');
        header("location: index.php?act=nv-dashboard");
    }

    public function huy()
    {
        $id = $_GET['id'];
        $this->lichModel->updateStatus($id, 'cancelled', 'Nhân viên hủy');
        header("location: index.php?act=nv-dashboard");
    }
}
?>