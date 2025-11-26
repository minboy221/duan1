<?php
// session_start();
require_once './models/CategoryModel.php';
require_once './models/DichVuModel.php';
require_once './models/Taikhoanuser.php';
require_once './models/ThoModel.php';
require_once './models/LichLamViecModel.php';
require_once './models/LichDatModel.php';

// Các function chỉ hiển thị view
function aboutClien() { require_once './views/clien/AboutView.php'; }
function DichvuClien() { require_once './views/clien/DichvuView.php'; }
function NhanvienClien() { require_once './views/clien/NhanvienView.php'; }
function DangkyClien() { require_once './views/clien/DangkyView.php'; }
function DangnhapClien() { require_once './views/clien/DangnhapView.php'; }
function DatlichClien() { require_once './views/clien/DatlichView.php'; }
function chondichvuClien() { require_once './views/clien/ChondichvuClien.php'; }
function Lichsudonchitiet() { require_once './views/clien/Lichsudat_chitiet.php'; }

class CattocContronler
{
    public $categoryModel;
    public $dichvuModel;
    public $thongtinuser;
    public $thoModel;
    public $lichModel;
    public $lichDatModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->dichvuModel = new DichVuModel();
        $this->thongtinuser = new ThongTinUser();
        $this->thoModel = new ThoModel();
        $this->lichModel = new LichLamViecModel();
        $this->lichDatModel = new LichDatModel();
    }

    // Lấy danh mục và dịch vụ kèm nhau
    private function getCategorizedServices($limit = null)
    {
        $categories = $this->categoryModel->all($limit);
        $dataForView = [];
        foreach ($categories as $category) {
            $services = $this->dichvuModel->getByCategory($category['id']);
            $category['services'] = $services;
            $dataForView[] = $category;
        }
        return $dataForView;
    }

    // Trang Home hiển thị danh mục & dịch vụ
    public function hienthidanhmuc() {
        $categoriesWithServices = $this->getCategorizedServices(2);
        require_once './views/clien/HomeView.php';
    }

    public function hienthidanhmuc1() {
        $categories = $this->categoryModel->all();
        $dataForView = [];
        foreach ($categories as $category) {
            $services = $this->dichvuModel->getByCategory($category['id']);
            $category['services'] = $services;
            $dataForView[] = $category;
        }
        $categoriesWithServices = $dataForView;
        require_once './views/clien/DichvuView.php';
    }

    public function hienthichitiet() {
        $id = $_GET['id'] ?? null;
        if (!$id) { echo "ID không hợp lệ"; return; }
        $service = $this->dichvuModel->find($id);
        if (!$service) { echo "Dịch vụ không tồn tại"; return; }
        $category = $this->categoryModel->find($service['danhmuc_id']);
        require_once './views/clien/DichvuchitietView.php';
    }

    public function hienthiNhanVien() {
        $ListTho = $this->thoModel->all();
        require_once './views/clien/NhanvienView.php';
    }

    public function chondichvu() {
        if (!isset($_SESSION['username'])) { header("Location: index.php?act=dangnhap_khachhang"); exit(); }
        $categoriesWithServices = $this->getCategorizedServices();
        $preSelectedId = $_GET['id'] ?? null;
        require_once './views/clien/ChondichvuClien.php';
    }

    public function datlich() {
        $listDays = $this->lichModel->getFutureDays();
        require_once './views/clien/DatlichView.php';
    }

    public function apiGetStylist() {
        $ngay_id = $_GET['ngay_id'] ?? 0;
        $stylists = $this->lichModel->getThoByDayId($ngay_id);
        header('Content-Type: application/json');
        echo json_encode($stylists);
    }

    public function apiGetTime() {
        $phan_cong_id = $_GET['phan_cong_id'] ?? 0;
        $slots = $this->lichModel->getAvailableTime($phan_cong_id);
        header('Content-Type: application/json');
        echo json_encode($slots);
    }

    public function addService() {
        $id = $_GET['id'] ?? 0;
        if (!$id) return;
        $service = $this->dichvuModel->find($id);
        if (!$service) return;
        if (!isset($_SESSION['booking_cart']['services'])) $_SESSION['booking_cart']['services'] = [];
        foreach ($_SESSION['booking_cart']['services'] as $sv) {
            if ($sv['id'] == $id) {
                $_SESSION['success'] = "Dịch vụ đã tồn tại trong giỏ!";
                header("Location: index.php?act=chondichvu");
                return;
            }
        }
        $_SESSION['booking_cart']['services'][] = [
            'id' => $service['id'],
            'name' => $service['name'],
            'price' => $service['price']
        ];
        $_SESSION['success'] = "Đã thêm dịch vụ!";
        header("Location: index.php?act=chondichvu");
        exit;
    }

    public function removeService() {
        $id = $_GET['id'] ?? 0;
        if (!$id) return;
        if (isset($_SESSION['booking_cart']['services'])) {
            $_SESSION['booking_cart']['services'] =
                array_filter($_SESSION['booking_cart']['services'], fn($sv) => $sv['id'] != $id);
        }
        $_SESSION['success'] = "Đã xóa dịch vụ khỏi giỏ!";
        header("Location: index.php?act=datlich");
        exit;
    }

    public function luuDatLich() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $khachhang_id = $_SESSION['user_id'] ?? 1;
            $khunggio_id = $_POST['khunggio_id'];
            $note = $_POST['note'] ?? '';

            if (isset($_SESSION['booking_cart']['services'])) {
                foreach ($_SESSION['booking_cart']['services'] as $sv) {
                    $ma_code = $this->lichDatModel->insertBooking($khachhang_id, $sv['id'], $khunggio_id, $note);
                }
                unset($_SESSION['booking_cart']);
                echo "<script>window.location.href = 'index.php?act=cam_on&ma_lich=$ma_code';</script>";
                exit();
            } else {
                echo "<script>alert('Giỏ hàng trống!'); window.history.back();</script>";
            }
        }
    }

    public function camOn() {
        $ma_lich = $_GET['ma_lich'] ?? '';
        if (!$ma_lich) { header("Location:index.php"); exit; }
        $booking = $this->lichDatModel->getBookingByCode($ma_lich);
        if (!$booking) { echo "Không tìm thấy đơn đặt lịch!"; exit; }
        require_once './views/clien/CamOnView.php';
    }

    // === LỊCH SỬ ĐẶT LỊCH CLIENT với phân trang JS ===
   public function lichSuDatLich() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?act=dangnhap_khachhang"); 
        exit; 
    }

    $user_id = $_SESSION['user_id'];
    $limit = 5;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $offset = ($page - 1) * $limit;

    $historyList = $this->lichDatModel->getHistoryByCustomerPaginate($user_id, $limit, $offset);
    $totalHistory = $this->lichDatModel->countHistoryByCustomer($user_id);
    $totalPages = ceil($totalHistory / $limit);

    require_once './views/clien/Lichsudatlich.php';
}


    public function lichsuChiTiet() {
        $ma_lich = $_GET['ma_lich'] ?? '';
        if (!$ma_lich) { header("Location: index.php?act=lichsudat"); exit; }
        $booking = $this->lichDatModel->getBookingByCode($ma_lich);
        if (!$booking) { echo 'Không tìm thấy lịch đặt!'; exit; }
        require_once './views/clien/Lichsudat_chitiet.php';
    }

    public function huyLich() {
        if (!isset($_SESSION['username'], $_SESSION['user_id'])) {
            echo "<script>alert('Vui lòng đăng nhập lại!'); window.location.href='index.php?act=dangnhap_khachhang';</script>";
            exit;
        }
        $id = $_GET['id'] ?? 0;
        $user_id = $_SESSION['user_id'];
        $reason = $_POST['cancel_reason'] ?? '';
        $result = $this->lichDatModel->cancelBooking($id, $user_id, $reason);
        if ($result) {
            echo "<script>alert('Đã hủy lịch thành công!'); window.location.href = 'index.php?act=lichsudat';</script>";
        } else {
            echo "<script>alert('Hủy thất bại! Lịch đã hoàn thành hoặc không tồn tại.'); window.history.back();</script>";
        }
    }

    // === Các chức năng khác giữ nguyên ===
    public function taikhoanuser() {
        $taikhoan = $this->thongtinuser->alltaikhoan();
        require_once './views/admin/Qlykhachhang.php';
    }

    public function searchUser() {
        $keyword = $_GET['keyword'] ?? '';
        $taikhoan = $keyword ? $this->thongtinuser->search($keyword) : $this->thongtinuser->alltaikhoan();
        require_once './views/admin/Qlykhachhang.php';
    }

    public function searchClient() {
        $categoryId = $_GET['category_id'] ?? '';
        $priceRange = $_GET['price_range'] ?? '';
        $keyword = $_GET['keyword'] ?? '';

        $categories = $this->categoryModel->all();
        $dataForView = [];

        foreach ($categories as $category) {
            $services = $this->dichvuModel->getByCategory($category['id']);

            if ($categoryId && $category['id'] != $categoryId) $services = [];
            if ($priceRange && !empty($services)) {
                [$minPrice, $maxPrice] = explode('-', $priceRange);
                $services = array_filter($services, fn($s) => $s['price'] >= $minPrice && $s['price'] <= $maxPrice);
            }
            if ($keyword && !empty($services)) {
                $services = array_filter($services, fn($s) => stripos($s['name'], $keyword) !== false);
            }

            $category['services'] = $services;
            $dataForView[] = $category;
        }

        $categoriesWithServices = $dataForView;
        require_once './views/clien/DichvuView.php';
    }

    public function lockUser() {
        $id = $_GET['id'] ?? null;
        if (!$id) return;
        $this->thongtinuser->updateStatus($id, 0);
        $_SESSION['success'] = "Đã khóa tài khoản!";
        header("Location: ?act=qlytaikhoan"); exit;
    }

    public function unlockUser() {
        $id = $_GET['id'] ?? null;
        if (!$id) return;
        $this->thongtinuser->updateStatus($id, 1);
        $_SESSION['success'] = "Đã mở khóa tài khoản!";
        header("Location: ?act=qlytaikhoan"); exit;
    }
}
?>
