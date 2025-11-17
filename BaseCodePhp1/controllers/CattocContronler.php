<?php
//phần chỉ để hiện giao diện
function homeClient(){
    require_once './views/clien/HomeView.php';
}
function aboutClien(){
    require_once './views/clien/AboutView.php';
}
function DichvuClien(){
    require_once './views/clien/DichvuView.php';
}
function NhanvienClien(){
    require_once './views/clien/NhanvienView.php';
}
function DangkyClien(){
    require_once './views/clien/DangkyView.php';
}
function DangnhapClien(){
    require_once './views/clien/DangnhapView.php';
}
function DichvuchitietClien(){
    require_once './views/clien/DichvuchitietView.php';
}
function DatlichClien(){
    require_once './views/clien/DatlichView.php';
}
function chondichvuClien(){
    require_once './views/clien/ChondichvuClien.php';
}
//phần chỉ để hiển thị giao diện admin
function homeAdmin(){
    require_once './views/admin/HomeAdmin.php';
}
function qlyDanhmuc(){
    require_once './views/admin/Qlydanhmuc.php';
}
?>