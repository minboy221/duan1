<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once file common
require_once('./commons/env.php');
require_once('./commons/function.php');


require_once("./controllers/CattocContronler.php");
require_once("./controllers/CategoryController.php");
require_once("./controllers/DichVuController.php");
require_once("./controllers/KhachHangController.php");
require_once("./controllers/NhanVienController.php"); 
require_once("./controllers/NhanVienAdminController.php");

require_once("./models/DichVuModel.php");
require_once("./models/CategoryModel.php");
require_once("./models/KhachHangModel.php");
require_once("./models/NhanVienModel.php");
require_once("./models/NhanVienAdminModel.php");

// --- KHỞI TẠO CONTROLLER ---
$clientController = new CattocContronler();
$adminCategoryController = new CategoryController();
$adminDichVuController = new DichVuController();
$adminNhanVienController = new NhanVienController(); 
$adminNhanVienAdminController = new NhanVienAdminController(); 

//route

$act = $_GET['act'] ?? 'home';

match ($act) {
    // phần hiển thị giao diện trang clien
    'home' => $clientController->hienthidanhmuc(),
    'about' => aboutClien(),
    'dichvu' => $clientController->hienthidanhmuc1(),
    'nhanvien' => NhanvienClien(),
    'dangky' => DangkyClien(),
    'chitietdichvu' => $clientController->hienthichitiet(),
    'datlich' => DatlichClien(),
    'chondichvu' => $clientController ->chondichvu(),
    'lichsudat' => Lichsudon(),
    'lichsudatchitiet' => Lichsudonchitiet(),
    //đăng nhập và đăng ký cho khách hàng
    'dangky_khachhang' => (new KhachHangController())->register(),
    'dangnhap_khachhang' => (new KhachHangController())->login(),
    'logout' => (new KhachHangController())->logout(),
    //phần hiển thị dữ liệu ra clien
    //phần hiển thị giao diện admin
    'homeadmin' => homeAdmin(),
    'qlydanhmuc' => (new CategoryController())->quanlydanhmuc(),
    'create_danhmuc' => (new CategoryController())->createdanhmuc(),
    'store_danhmuc' => (new CategoryController())->store(),
    'show_danhmuc' => (new CategoryController())->show(),
    'edit_danhmuc' => (new CategoryController())->edit(),
    'update_danhmuc' => (new CategoryController())->update(),
    'delete_danhmuc' => (new CategoryController())->delete(),
    // dich vụ
    'qlydichvu' => (new DichVuController())->quanlydichvu(),
    'createdichvu' => (new DichVuController())->createdichvu(),
    'store_dichvu' => (new DichVuController())->store(),
    'show_dichvu' => (new DichVuController())->show(),
    'edit_dichvu' => (new DichVuController())->edit(),
    'update_dichvu' => (new DichVuController())->update(),
    'delete_dichvu' => (new DichVuController())->delete(),
    //phần tài khoản khách hàng ở admin
    'qlytaikhoan' =>(new CattocContronler())->taikhoanuser(),

     // NHÂN VIÊN (Dashboard) 
    'nv-login'=> (new NhanVienController())->loginForm(),
    'nv-login-submit'=> (new NhanVienController())->login(),
    'nv-dashboard'=> (new NhanVienController())->dashboard(),
    'nv-chitiet'=> (new NhanVienController())->chitiet(),
    'nv-xacnhan'=> (new NhanVienController())->xacnhan(),
    'nv-huy'=> (new NhanVienController())->huy(),

    //NHÂN VIÊN (Admin quản lý + phân quyền) 
    'admin-nhanvien' => $adminNhanVienAdminController->index(),
    'admin-nhanvien-create' => $adminNhanVienAdminController->createForm(),
    'admin-nhanvien-create-submit' => $adminNhanVienAdminController->create(),
    'admin-nhanvien-edit' => $adminNhanVienAdminController->editForm(),
    'admin-nhanvien-update' => $adminNhanVienAdminController->update(), 
    'admin-nhanvien-delete' => $adminNhanVienAdminController->delete(),

    // phần hiển thị chức năng của quản lý dịch vụ
    default => notFound(),
}
    ?>