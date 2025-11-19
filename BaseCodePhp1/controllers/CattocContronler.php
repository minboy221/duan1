<?php
//phần chỉ để hiện giao diện
require_once './models/CategoryModel.php';
require_once './models/DichVuModel.php';
require_once './models/Taikhoanuser.php';
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

function Lichsudon(){
    require_once './views/clien/Lichsudatlich.php';
}

function Lichsudonchitiet(){
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

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->dichvuModel = new DichVuModel();
        $this->thongtinuser = new thongtinuser();
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
        $dataForView = [];
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
    public function hienthichitiet(){
        $id = $_GET['id'] ?? null;
        if(!$id){
            echo "ID không hợp lệ";
            return;
        }
        $service = $this->dichvuModel->find($id);
        if(!$service){
            echo "Dịch vụ không có hoặc không tồn tại";
            return;
        }
        $category = $this -> categoryModel->find($service['danhmuc_id']);
        require_once './views/clien/DichvuchitietView.php';
    }

    //phần hiển thị dịc vụ cho người dùng chọn
    public function chondichvu(){
        //kiểm tra tk
        if(!isset($_SESSION['username'])){
            header("Location: index.php?act=dangnhap_khachhang");
            exit();
        }
        $categoriesWithServices= $this->getCategorizedServices();
        $preSelectedId = $_GET['id'] ?? null;
        require_once './views/clien/ChondichvuClien.php';
    }
    
    //phần hiển thị tài khoản của người dùng ở admin
    public function taikhoanuser(){
        $taikhoan = $this->thongtinuser->alltaikhoan();
        require_once './views/admin/Qlykhachhang.php';
    }
}

?>