<?php
require_once './models/NhanVienModel.php';
require_once './models/LichDatModel.php';
require_once './models/ThoModel.php';
class NhanVienController
{
    protected $nvModel;
    protected $lichModel;
    protected $thoModel;

    public function __construct()
    {
        $this->nvModel = new NhanVienModel();
        $this->lichModel = new LichDatModel();
        // 💡 Khởi tạo ThoModel
        $this->thoModel = new ThoModel(); 
    }

    // --- GIAO DIỆN DASHBOARD (CÓ LỌC & PHÂN TRANG) ---
    public function dashboard()
    {
        //LẤY ID CỦA THỢ (NHÂN VIÊN ĐANG ĐĂNG NHẬP)
        $thoId = $_SESSION['user_id'] ?? null; 
        
        if (!$thoId) {
            header("Location: index.php?act=dangnhap_khachhang");
            exit;
        }

        // 1. Lấy tham số lọc từ URL
        $keyword = $_GET['keyword'] ?? null;
        $date = $_GET['date'] ?? null;
        $time = $_GET['time'] ?? null;
        $status = $_GET['status'] ?? null; 
        
        $limit = 999999;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        // 2. Xử lý AJAX (Nếu JS gọi để phân trang/lọc không tải lại)
        if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
            
            // LẤY DỮ LIỆU CÓ LỌC/TÌM KIẾM VÀ GIỚI HẠN BỞI ID THỢ
            $rawList = $this->lichModel->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time, $status, null, $thoId); 

            // TÍNH TỔNG SỐ TRANG
            $total = $this->lichModel->countAllLichDat($keyword, $date, $time, $status, null, $thoId);
            $totalPages = ceil($total / $limit);

            $listLich = $this->processMergeBooking($rawList);
            
            echo json_encode([
                'listLich' => array_values($listLich),
                'page' => $page,
                'totalPages' => $totalPages,
                'filter' => ['keyword' => $keyword, 'date' => $date, 'time' => $time, 'status' => $status]
            ]);
            exit();
        }

        // 3. Xử lý hiển thị trang thường (Lần đầu vào trang)
        
        // LẤY DỮ LIỆU CÓ LỌC/TÌM KIẾM VÀ GIỚI HẠN BỞI ID THỢ
        $rawList = $this->lichModel->getAllLichDatPaginate($limit, $offset, $keyword, $date, $time, $status, null, $thoId);

        $listLich = $this->processMergeBooking($rawList);

        // Tính tổng số trang
        $total = $this->lichModel->countAllLichDat($keyword, $date, $time, $status, null, $thoId);
        $totalPages = ceil($total / $limit);
        $currentPage = 1;
        
        //LẤY DANH SÁCH TẤT CẢ THỢ CHO DROPDOWN LỌC
        // Giả định ThoModel có hàm all() để lấy tất cả thợ
        $allTho = $this->thoModel->all(); 
        
        // Gửi sang View
        require_once './views/nhanvien/dashboard.php';
    }

    // --- HÀM HỖ TRỢ: GỘP MẢNG DỊCH VỤ ---
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
        $ma_lich = $_GET['ma_lich'] ?? null;
        if (!$ma_lich) {
            header("location: index.php?act=nv-dashboard");
            exit;
        }

        $bookingList = $this->lichModel->getBookingByCode($ma_lich);
        if (empty($bookingList)) {
            echo "Không tìm thấy đơn hàng";
            exit;
        }

        // 1. Lấy thông tin chung (Khách, Thợ, Ngày...) từ dòng đầu tiên
        $booking = $bookingList[0];

        // 2. Chuẩn bị danh sách dịch vụ và tính tổng tiền
        $services = [];
        $totalPrice = 0;

        foreach ($bookingList as $item) {
            $totalPrice += $item['price'];
            // Thêm từng dịch vụ vào mảng
            $services[] = [
                'ten_dichvu' => $item['ten_dichvu'],
                'price' => $item['price']
            ];
        }

        // 3. Gán tổng tiền
        $booking['price'] = $totalPrice;

        // 4. Gọi View
        require_once 'views/nhanvien/chitiet.php';
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