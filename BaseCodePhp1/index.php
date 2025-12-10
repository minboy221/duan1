<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
require_once("./controllers/LichDatController.php");
require_once("./controllers/AdminHomeController.php");
require_once("./controllers/ChatController.php");
require_once("./controllers/BotController.php");
require_once("./controllers/AdminChatController.php");

require_once("./models/StatsModel.php");
require_once("./models/DanhGiaModel.php");
require_once("./models/DichVuModel.php");
require_once("./models/CategoryModel.php");
require_once("./models/KhachHangModel.php");
require_once("./models/NhanVienModel.php");
require_once("./models/NhanVienAdminModel.php");
require_once("./models/ThoModel.php");
require_once("./models/Taikhoanuser.php");
require_once("./models/LichLamViecModel.php");
require_once("./models/LichDatModel.php");
require_once("./models/ChatModel.php");
require_once("./models/BotModel.php");


// --- KHỞI TẠO CONTROLLER ---
$clientController = new CattocContronler();
$adminCategoryController = new CategoryController();
$adminDichVuController = new DichVuController();
$khachHangController = new KhachHangController();
$adminNhanVienController = new NhanVienController();
$adminNhanVienAdminController = new NhanVienAdminController();
$lich = new LichLamViecController();
$clientController = new CattocContronler();
$lichDatController = new LichDatController();
$chatController = new ChatController();
$botController = new BotController();
$adminChat = new AdminChatController();

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
    'admin-nhanvien-detail',
    //phần quản lý làm việc cho thợ
    'qlylichlamviec',
    'auto_create_days',
    'assign_tho',
    'store_assign',
    'edit_times',
    'update_times',
    'detail_ngay',
    //phần trang quản lý lịch đặt
    'qlylichdat',
    'admin-lichdat-detail',
    'update_status_lich', // <--- THÊM DÒNG NÀY ĐỂ BẢO VỆ HÀNH ĐỘNG CẬP NHẬT TRẠNG THÁI

    //phần trang cho nhân viên
    'admin-nhanvien',
    'admin-nhanvien-create',
    'admin-nhanvien-edit',
    'lock_staff',
    'unlock_staff',
];

// Nếu act thuộc nhóm admin -> kiểm tra đăng nhập
// Trong file index.php

// Định nghĩa các Role được phép truy cập Admin/Staff Dashboard
$allowedRoles = ['admin', 'Nhân Viên', 'Staff']; // Thêm tất cả các role hợp lệ

// Nếu act thuộc nhóm admin -> kiểm tra đăng nhập
if (in_array($act, $adminRoutes)) {
    // Thêm điều kiện kiểm tra Session của Nhân viên
    $isLoggedIn = isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true;
    $hasPermission = isset($_SESSION['role']) && in_array($_SESSION['role'], $allowedRoles);

    if (!$isLoggedIn || !$hasPermission) {
        header("Location: index.php?act=dangnhap_khachhang");
        exit();
    }
}

match ($act) {
    // phần hiển thị giao diện trang clien
    'home' => $clientController->hienthidanhmuc(),
    'about' => aboutClien(),
    'dichvu' => $clientController->hienthidanhmuc1(),
    'nhanvien' => $clientController->hienthiNhanVien(),
    'chitietdichvu' => $clientController->hienthichitiet(),
    'datlich' => $clientController->datlich(),
    'chondichvu' => $clientController->chondichvu(),
    'lichsudat' => $clientController->lichSuDatLich(),
    'lichsudatchitiet' => $clientController->lichSuChiTiet(),
    'dangky_khachhang' => (new KhachHangController())->register(),
    'dangnhap_khachhang' => (new KhachHangController())->login(),
    'logout' => (new KhachHangController())->logout(),
    'huylich' => $clientController->huyLich(),
    //phần thông báo huỷ lịch có lý do của admin và nhân viên
    'api_read_notify' => $clientController->apiReadNotify(),
    'quenmatkhau' => (new KhachHangController())->forgotPassword(),//quên mật khẩu
    'doimatkhau_nhanvien' => (new khachHangController)->changePasswordStaff(), //đổi mật khẩu cho nhân viên
    //PHẦN AI CHAT VỚI CLIEN
    'api_load_chat' => $chatController->loadChat(),
    'api_send_chat' => $chatController->sendChat(),
    //phần hiển thị dữ liệu ra clien

    //phần hiển thị giao diện admin
    'homeadmin' => (new AdminHomeController())->index(),
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
    // khóa tài khoản
    'lock_user' => (new CattocContronler())->lockUser(),
    'unlock_user' => (new CattocContronler())->unlockUser(),
    'lock_staff' => (new NhanVienAdminController())->lockStaff(),
    'unlock_staff' => (new NhanVienAdminController())->unlockStaff(),

    // phần quản lý đánh giá
    'admin-user-comment' => (new BinhLuanUserController())->detail(),
    // tìm kiếm khách hàng
    'search_user' => (new CattocContronler())->searchUser(),
    // tìm kiếm khách hàng clien
    'search_client' => (new CattocContronler())->searchClient(),
    // đánh giá khách hàng clien
    'danhgia' => (new BinhLuanUserController())->formDanhGia(),
    'submit_danhgia' => (new BinhLuanUserController())->submitDanhGia(),

    //PHẦN QUẢN LÝ LỊCH ĐẶT
    'qlylichdat' => (new LichDatController())->index(),
    'admin-lichdat-detail' => (new LichDatController())->detail(),
    'update_status_lich' => (new LichDatController())->updateStatus(),
    'update_status_nv' => (new LichDatController())->updateStatusNhanVien(), // Hoặc (new NhanVienController())->updateStatusNhanVien(), tùy nơi bạn đặt hàm

    // NHÂN VIÊN (Dashboard) 
    'nv-dashboard' => (new NhanVienController())->dashboard(),
    'nv-xacnhan' => (new NhanVienController())->xacnhan(),
    'nv-huy' => (new NhanVienController())->huy(),
    'nhanvien-lichdat-detail' =>(new NhanVienController())->chitiet(),
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
    'cam_on' => $clientController->camOn(),
    // chọn dịch vụ trong đặt lịch
    'add_service' => (new CattocContronler())->addService(),
    // xóa dịch vụ trong đặt lịch
    'remove_service' => (new CattocContronler())->removeService(),

    //PHẦN QUẢN LÝ BOT
    'qlybot' => $botController->index(),
    'createbot' => $botController->create(),
    'storebot' => $botController->store(),
    'editbot' => $botController->edit(),
    'updatebot' => $botController->update(),
    'deletebot' => $botController->delete(),

    //giao diện quản lý chat cho admin
    'qlychat' => $adminChat->index(),
    //API cho admin
    'admin_api_get_chat' => $adminChat->getConversation(),
    // trang không tồn tại
    default => notFound(),
}
?>