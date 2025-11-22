<?php
//phần chỉ để hiện giao diện
require_once './models/CategoryModel.php';
require_once './models/DichVuModel.php';
require_once './models/Taikhoanuser.php';
require_once './models/ThoModel.php';
require_once './models/LichLamViecModel.php';
function aboutClien()
{
    require_once './views/clien/AboutView.php';
}
function DichvuClien()
{
    require_once './views/clien/DichvuView.php';
}
function NhanvienClien()
{
    require_once './views/clien/NhanvienView.php';
}
function DangkyClien()
{
    require_once './views/clien/DangkyView.php';
}
function DangnhapClien()
{
    require_once './views/clien/DangnhapView.php';
}
function DatlichClien()
{
    require_once './views/clien/DatlichView.php';
}
function chondichvuClien()
{
    require_once './views/clien/ChondichvuClien.php';
}

function Lichsudon()
{
    require_once './views/clien/Lichsudatlich.php';
}

function Lichsudonchitiet()
{
    require_once './views/clien/Lichsudat_chitiet.php';
}
//phần chỉ để hiển thị giao diện admin
function homeAdmin()
{
    require_once './views/admin/HomeAdmin.php';
}
function qlyDanhmuc()
{
    require_once './views/admin/Qlydanhmuc.php';
}

//phần để hiện thị các dữ liệu ra clien
class CattocContronler
{
    public $categoryModel;
    public $dichvuModel;
    public $thongtinuser;
    public $thoModel;
    public $lichModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->dichvuModel = new DichVuModel();
        $this->thongtinuser = new thongtinuser();
        $this->thoModel = new ThoModel();
        $this->lichModel = new LichLamViecModel();
    }

    private function getCategorizedServices($limit = null)
    {
        $categories = $this->categoryModel->all($limit);
        $dataForView = [];
        foreach ($categories as $category) {
            $services = $this->dichvuModel->getByCategory(($category['id']));
            $category['services'] = $services;
            $dataForView[] = $category;
        }
        return $dataForView;
    }

    //phần hiển thị danh mục cho trang home
    public function hienthidanhmuc()
    {
        $categoriesWithServices = $this->getCategorizedServices(2);
        require_once './views/clien/HomeView.php';
    }

    //phần hiển thị dịch vụ cho home
    public function hienthidichvu()
    {
        $categoriesWithServices = $this->getCategorizedServices();
        require_once './views/clien/HomeView.php';
    }

    //phần hiển thị danh mục cho trang dịch vụ
    public function hienthidanhmuc1()
    {
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
    //phần hiển thị dịch vụ cho home
    public function hienthidichvu1()
    {
        $categories = $this->categoryModel->all();
        $services = $this->dichvuModel->all();
        require_once './views/clien/HomeView.php';
    }

    //phần hiển thị dịch vụ chi tiết
    public function hienthichitiet()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID không hợp lệ";
            return;
        }
        $service = $this->dichvuModel->find($id);
        if (!$service) {
            echo "Dịch vụ không có hoặc không tồn tại";
            return;
        }
        $category = $this->categoryModel->find($service['danhmuc_id']);
        require_once './views/clien/DichvuchitietView.php';
    }

    //phần hiển thị dịc vụ cho người dùng chọn
    public function chondichvu()
    {
        //kiểm tra tk
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?act=dangnhap_khachhang");
            exit();
        }
        $categoriesWithServices = $this->getCategorizedServices();
        $preSelectedId = $_GET['id'] ?? null;
        require_once './views/clien/ChondichvuClien.php';
    }

    //phần hiển thị tài khoản của người dùng ở admin
    public function taikhoanuser()
    {
        $taikhoan = $this->thongtinuser->alltaikhoan();
        require_once './views/admin/Qlykhachhang.php';
    }
    // phần tìm kiếm
    public function searchUser()
    {
        $keyword = $_GET['keyword'] ?? '';

        if ($keyword !== '') {
            $taikhoan = $this->thongtinuser->search($keyword);
        } else {
            $taikhoan = $this->thongtinuser->alltaikhoan();
        }

        require_once './views/admin/Qlykhachhang.php';
    }
    // phần tìm kiếm cliên
    // Tìm kiếm dịch vụ theo danh mục, giá và từ khóa
    public function searchClient()
    {
        $categoryId = $_GET['category_id'] ?? '';
        $priceRange = $_GET['price_range'] ?? '';
        $keyword = $_GET['keyword'] ?? '';

        $categories = $this->categoryModel->all();
        $dataForView = [];

        foreach ($categories as $category) {
            $services = $this->dichvuModel->getByCategory($category['id']);

            // Lọc theo danh mục
            if ($categoryId && $category['id'] != $categoryId) {
                $services = [];
            }

            // Lọc theo giá
            if ($priceRange && !empty($services)) {
                [$minPrice, $maxPrice] = explode('-', $priceRange);
                $services = array_filter($services, function ($s) use ($minPrice, $maxPrice) {
                    return $s['price'] >= $minPrice && $s['price'] <= $maxPrice;
                });
            }

            // Lọc theo từ khóa
            if ($keyword && !empty($services)) {
                $services = array_filter($services, function ($s) use ($keyword) {
                    return stripos($s['name'], $keyword) !== false; // không phân biệt hoa thường
                });
            }

            $category['services'] = $services;
            $dataForView[] = $category;
        }

        $categoriesWithServices = $dataForView;
        require_once './views/clien/DichvuView.php';
    }
    // KHÓA TÀI KHOẢN
    public function lockUser()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            return;

        $this->thongtinuser->updateStatus($id, 0);

        $_SESSION['success'] = "Đã khóa tài khoản!";
        header("Location: ?act=qlytaikhoan");
        exit;
    }

    // MỞ KHÓA
    public function unlockUser()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            return;

        $this->thongtinuser->updateStatus($id, 1);

        $_SESSION['success'] = "Đã mở khóa tài khoản!";
        header("Location: ?act=qlytaikhoan");
        exit;
    }

    // phần hiển thị thông tin thợ ra clien
    public function hienthiNhanVien()
    {
        $ListTho = $this->thoModel->all();
        require_once './views/clien/NhanvienView.php';
    }

    //phần hiển thị thông tin của đặt lịch(chọn thợ, ngày,khung giờ) ra trang clien
    public function datlich()
    {
        //kiểm tra đăng nhập
        // if (!isset($_SESSION['usernae'])) {
        //     header("Location:index.php?act=dangnhap_khachhang");
        //     exit();
        // }
        //lấy danh sách ngày để hiển thị
        $listDays = $this->lichModel->getFutureDays();
        require_once './views/clien/DatlichView.php';
    }
    // API lấy danh sách thợ theo ngày
    public function apiGetStylist()
    {
        $ngay_id = $_GET['ngay_id'] ?? 0;
        $stylists = $this->lichModel->getThoByDayId($ngay_id);
        header('Content-Type:application/json');
        echo json_encode($stylists);
    }
    // API lấy danh sách giờ theo phân công
    public function apiGetTime()
    {
        $phan_cong_id = $_GET['phan_cong_id'] ?? 0;
        $slots = $this->lichModel->getAvailableTime($phan_cong_id);
        header('Content-Type: application/json');
        echo json_encode($slots);
    }
    //xử lý lưu lịch đặt
    public function luuDatLich()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //lấy dữ liệu từ from
            $khachhang_id = $_SESSION['user_id'] ?? 0;
            $khunggio_id = $_POST['note'] ?? '';

            // TODO: Gọi Model LichDat để insert vào database
            // $this->lichDatModel->insert(...)

        echo "<script>alert('Đặt lịch thành công!'); window.location.href='index.php';</script>";
        }
    }
    // chọn dịch vụ trong đặt lịch
public function addService() {
    $id = $_GET['id'] ?? 0;
    if (!$id) return;

    // Lấy thông tin dịch vụ từ DB
    $service = $this->dichvuModel->find($id);
    if (!$service) return;

    // Kiểm tra giỏ
    if (!isset($_SESSION['booking_cart']['services'])) {
        $_SESSION['booking_cart']['services'] = [];
    }

    // Kiểm tra trùng
    foreach ($_SESSION['booking_cart']['services'] as $sv) {
        if ($sv['id'] == $id) {
            $_SESSION['success'] = "Dịch vụ đã tồn tại trong giỏ!";
            header("Location: index.php?act=chondichvu");
            return;
        }
    }

    // Thêm dịch vụ vào giỏ
    $_SESSION['booking_cart']['services'][] = [
        'id' => $service['id'],
        'name' => $service['name'],
        'price' => $service['price']
    ];

    $_SESSION['success'] = "Đã thêm dịch vụ!";
    header("Location: index.php?act=chondichvu");
    exit;
}

// xóa dịch vụ khỏi giỏ
public function removeService() {
    $id = $_GET['id'] ?? 0;
    if (!$id) return;

    if (isset($_SESSION['booking_cart']['services'])) {
        $_SESSION['booking_cart']['services'] = 
            array_filter($_SESSION['booking_cart']['services'], function ($sv) use ($id) {
                return $sv['id'] != $id;
            });
    }

    $_SESSION['success'] = "Đã xóa dịch vụ khỏi giỏ!";
    header("Location: index.php?act=datlich");
    exit;
}


}
