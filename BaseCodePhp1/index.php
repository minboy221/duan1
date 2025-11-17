<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once file common
require_once('./commons/env.php');
require_once('./commons/function.php');
require_once("./controllers/CattocContronler.php");
require_once("./controllers/CategoryController.php");
require_once("./controllers/DichVuController.php");

require_once("./models/DichVuModel.php");
require_once("./models/CategoryModel.php");

// --- KHỞI TẠO CONTROLLER ---
$clientController = new CattocContronler();
$adminCategoryController = new CategoryController();
$adminDichVuController = new DichVuController();

//route

$act = $_GET['act'] ?? 'home';

match ($act) {
    // phần hiển thị giao diện trang clien
    'home' => $clientController->hienthidanhmuc(),
    'about' => aboutClien(),
    'dichvu' => DichvuClien(),
    'nhanvien' => NhanvienClien(),
    'dangky' => DangkyClien(),
    'dangnhap' => DangnhapClien(),
    'chitietdichvu' => DichvuchitietClien(),
    'datlich' => DatlichClien(),
    'chondichvu' => chondichvuClien(),
    //phần hiển thị dữ liệu ra clien
    'hienthidanhmuc' => (new CategoryController())->hienthidanhmuc(),
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

    // phần hiển thị chức năng của quản lý dịch vụ
    default => notFound(),
}
    ?>