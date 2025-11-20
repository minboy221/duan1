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
require_once("./controllers/ThoController.php");
require_once("./controllers/BinhLuanUserController.php");

require_once("./models/DanhGiaModel.php");
require_once("./models/DichVuModel.php");
require_once("./models/CategoryModel.php");
require_once("./models/KhachHangModel.php");
require_once("./models/NhanVienModel.php");
require_once("./models/NhanVienAdminModel.php");
require_once("./models/ThoModel.php");
require_once("./models/Taikhoanuser.php");



// --- KHỞI TẠO CONTROLLER ---
$clientController = new CattocContronler();
$adminCategoryController = new CategoryController();
$adminDichVuController = new DichVuController();
$khachHangController = new KhachHangController();
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
    'chondichvu' => $clientController->chondichvu(),
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
    'qlytaikhoan' => (new CattocContronler())->taikhoanuser(),
    // khóa
    'lock_user' => (new CattocContronler())->lockUser(),
    'unlock_user' => (new CattocContronler())->unlockUser(),


    // phần quản lý đánh giá
    'admin-user-comment' => (new BinhLuanUserController())->detail(),
    // tìm kiếm khách hàng
    'search_user' => (new CattocContronler())->searchUser(),
    // tìm kiếm khách hàng clien
    'search_client' => (new CattocContronler())->searchClient(),

    // NHÂN VIÊN (Dashboard) 
    'nv-dashboard' => (new NhanVienController())->dashboard(),
    'nv-chitiet' => (new NhanVienController())->chitiet(),
    'nv-xacnhan' => (new NhanVienController())->xacnhan(),
    'nv-huy' => (new NhanVienController())->huy(),
    // tìm kiếm nhan viên
    'admin-nhanvien-search' => (new NhanVienAdminController())->search(),


    // PHẦN QUẢN LÝ THỢ
    'qlytho' => (new ThoController())->index(),
    'storetho' => (new ThoController())->tho(),
    'qlytho_create' => (new ThoController())->create(),
    'qlytho_edit' => (new ThoController())->edit(),
    'qlytho_delete' => (new ThoController())->delete(),

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