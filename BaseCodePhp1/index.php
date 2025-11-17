<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require_once file common
require_once('./commons/env.php');
require_once('./commons/function.php');
require_once("./controllers/CattocContronler.php");

//route

$act = $_GET['act'] ?? 'home';

match ($act) {
    // phần hiển thị giao diện trang clien
    'home' => homeClient(),
    'about' => aboutClien(),
    'dichvu' => DichvuClien(),
    'nhanvien' => NhanvienClien(),
    'dangky' => DangkyClien(),
    'dangnhap' => DangnhapClien(),
    'chitietdichvu' => DichvuchitietClien(),
    'datlich' => DatlichClien(),
    'chondichvu' => chondichvuClien(),
    //phần hiển thị giao diện admin
    'homeadmin' => homeAdmin(),
    'qlydanhmuc' => qlyDanhmuc(),
    // phần hiển thị chức năng của quản lý dịch vụ
    default => notFound(),
}
    ?>