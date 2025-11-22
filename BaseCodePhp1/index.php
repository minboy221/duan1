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
require_once("./controllers/LichLamViecController.php");


require_once("./models/DanhGiaModel.php");
require_once("./models/DichVuModel.php");
require_once("./models/CategoryModel.php");
require_once("./models/KhachHangModel.php");
require_once("./models/NhanVienModel.php");
require_once("./models/NhanVienAdminModel.php");
require_once("./models/ThoModel.php");
require_once("./models/Taikhoanuser.php");
require_once("./models/LichLamViecModel.php");



// --- KHỞI TẠO CONTROLLER ---
$clientController = new CattocContronler();
$adminCategoryController = new CategoryController();
$adminDichVuController = new DichVuController();
$khachHangController = new KhachHangController();
$adminNhanVienController = new NhanVienController();
$adminNhanVienAdminController = new NhanVienAdminController();
$lich = new LichLamViecController();
$clientController = new CattocContronler();

//route

$act = $_GET['act'] ?? 'home';
// Các route chỉ dành cho admin
$adminRoutes = [
    //trang chủ
    'homeadmin',
    //phần quản lý danh mục
    'qlydanhmuc',
    'create_danhmuc',
    'store_danhmuc',
    'show_danhmuc',
    'edit_danhmuc',
    'update_danhmuc',
    'delete_danhmuc',
    //phần quản lý dịch vụ
    'qlydichvu',
    'createdichvu',
    'store_dichvu',
    'show_dichvu',
    'edit_dichvu',
    'update_dichvu',
    'delete_dichvu',
    //phần xem người dùng
    'qlytaikhoan',
    'admin-user-comment',
    //phần quản lý thợ
    'qlytho',
    'qlytho_create',
    'qlytho_edit',
    //phần quản lý làm việc cho thợ
    'qlylichlamviec',
    'auto_create_days',
    'assign_tho',
    'store_assign',
    'edit_times',
    'update_times',
    'detail_ngay',
    //phần trang cho nhân viên
    'admin-nhanvien',
    'admin-nhanvien-create',
    'admin-nhanvien-edit',
];

// Nếu act thuộc nhóm admin -> kiểm tra đăng nhập
if (in_array($act, $adminRoutes)) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("Location: index.php?act=dangnhap_khachhang");
        exit();
    }
}


match ($act) {
    // phần hiển thị giao diện trang clien
    'home' => $clientController->hienthidanhmuc(),
    'about' => aboutClien(),
    'dichvu' => $clientController->hienthidanhmuc1(),
    'nhanvien' => $clientController->hienthiNhanVien(), 'chitietdichvu' => $clientController->hienthichitiet(),
    'datlich' => $clientController->datlich(),
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
    'updatetho' => (new ThoController())->update(),
    'qlytho_delete' => (new ThoController())->delete(),
    'search_tho' => (new ThoController())->search(),

    //PHẦN QUẢN LÝ LÀM VIỆC CHO THỢ
    'qlylichlamviec' => (new LichLamViecController())->index(),
    'auto_create_days' => (new LichLamViecController())->autoCreate(),
    'assign_tho' => (new LichLamViecController())->assignTho(),
    'store_assign' => (new LichLamViecController())->storeAssign(),
    'edit_times' => (new LichLamViecController())->editTimes(),
    'update_times' => (new LichLamViecController())->updateTimes(),
    'detail_ngay' => (new LichLamViecController())->detail(),

    //NHÂN VIÊN (Admin quản lý + phân quyền) 
    'admin-nhanvien' => $adminNhanVienAdminController->index(),
    'admin-nhanvien-create' => $adminNhanVienAdminController->createForm(),
    'admin-nhanvien-create-submit' => $adminNhanVienAdminController->create(),
    'admin-nhanvien-edit' => $adminNhanVienAdminController->editForm(),
    'admin-nhanvien-update' => $adminNhanVienAdminController->update(),
    'admin-nhanvien-delete' => $adminNhanVienAdminController->delete(),

    // phần API trả về json
    'api_get_stylist' => $clientController->apiGetStylist(),
    'api_get_time' => $clientController->apiGetTime(),
    //xử lý lưu
    'luu_datlich' => $clientController->luuDatLich(),
    // chọn dịch vụ trong đặt lịch
    'add_service' => (new CattocContronler())->addService(),
    // xóa dịch vụ trong đặt lịch
    'remove_service' => (new CattocContronler())->removeService(),

     // trang không tồn tại
    default => notFound(),
}
    ?>