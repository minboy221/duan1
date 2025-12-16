<?php
require_once './models/NhanVienAdminModel.php';

class NhanVienAdminController
{
    protected $model;

    public function __construct()
    {
        $this->model = new NhanVienAdminModel();
    }

    public function index()
    {
        $nhanviens = $this->model->all();
        $roles = $this->model->allRoles();
        require_once './views/admin/nhanvien/list.php';
    }

    public function createForm()
    {
        $roles = $this->model->allRoles();
        require_once './views/admin/nhanvien/role.php';
    }

    public function create()
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'gioitinh' => $_POST['gioitinh'] ?? '',
            'role_id' => $_POST['role_id'] ?? 2
        ];

        $errorMessages = [];

        // 1. Validate thiếu thông tin cơ bản
        if ($data['name'] == '' || $data['email'] == '' || $data['password'] == '' || $data['phone'] == '' || $data['gioitinh'] == '' || $data['role_id'] == '') {
            $errorMessages[] = "Vui lòng nhập đầy đủ các trường có dấu (*).";
        }
        
        // 2. KIỂM TRA TRÙNG LẶP (Email/Phone)
        if (!empty($data['email']) && !empty($data['phone'])) {
            $duplicateErrors = $this->model->checkDuplicates($data['email'], $data['phone']);
            
            if (in_array('email', $duplicateErrors)) {
                $errorMessages[] = "Email **{$data['email']}** đã được sử dụng.";
            }
            if (in_array('phone', $duplicateErrors)) {
                $errorMessages[] = "Số điện thoại **{$data['phone']}** đã được sử dụng.";
            }
        }
        
        if (!empty($errorMessages)) {
            // LƯU LỖI CHO SWEETALERT2
            $_SESSION['error_sa'] = implode('<br>', $errorMessages);
            header("Location: index.php?act=admin-nhanvien-create");
            exit;
        }

        // TIẾN HÀNH TẠO MỚI
        $this->model->create($data);
        $_SESSION['success_sa'] = "Thêm nhân viên thành công!";
        header("Location: index.php?act=admin-nhanvien");
        exit;
    }

    public function editForm()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die("ID nhân viên không hợp lệ");

        $nv = $this->model->find($id);
        $roles = $this->model->allRoles();

        require_once './views/admin/nhanvien/role.php';
    }

    public function update()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die('ID nhân viên không hợp lệ.');

        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'gioitinh' => $_POST['gioitinh'] ?? '',
            'role_id' => $_POST['role_id'] ?? 2
        ];

        $errorMessages = [];
        
        // 1. Validate thiếu thông tin cơ bản
        if ($data['name'] == '' || $data['email'] == '' || $data['phone'] == '' || $data['gioitinh'] == '' || $data['role_id'] == '') {
            $errorMessages[] = "Vui lòng nhập đầy đủ các trường bắt buộc.";
        }
        
        // 2. KIỂM TRA TRÙNG LẶP (Email/Phone), LOẠI TRỪ CHÍNH MÌNH
        if (!empty($data['email']) && !empty($data['phone'])) {
            $duplicateErrors = $this->model->checkDuplicates($data['email'], $data['phone'], $id);
            
            if (in_array('email', $duplicateErrors)) {
                $errorMessages[] = "Email **{$data['email']}** đã được sử dụng bởi người khác.";
            }
            if (in_array('phone', $duplicateErrors)) {
                $errorMessages[] = "Số điện thoại **{$data['phone']}** đã được sử dụng bởi người khác.";
            }
        }
        
        if (!empty($errorMessages)) {
            $_SESSION['error_sa'] = implode('<br>', $errorMessages);
            // Quay lại form edit
            header("Location: index.php?act=admin-nhanvien-edit&id={$id}"); 
            exit;
        }

        // TIẾN HÀNH CẬP NHẬT
        $this->model->update($id, $data);
        $_SESSION['success_sa'] = "Cập nhật nhân viên thành công!";
        header("Location: index.php?act=admin-nhanvien");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id)
            die("ID nhân viên không hợp lệ");

        $this->model->delete($id);

        header("Location: index.php?act=admin-nhanvien");
        exit;
    }
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';

        $nhanviens = $this->model->search($keyword);
        $roles = $this->model->allRoles();

        require_once './views/admin/nhanvien/list.php';
    }
// Trong NhanVienAdminController.php

public function lockStaff()
{
    $id = $_GET['id'] ?? null;
    if (!$id) die("ID nhân viên không hợp lệ");

    $this->model->updateStatus($id, 0); // 0: Khóa
    // LƯU THÔNG BÁO
    $_SESSION['success_sa'] = "Đã khóa tài khoản nhân viên thành công!";
    header("Location: index.php?act=admin-nhanvien");
    exit;
}

public function unlockStaff()
{
    $id = $_GET['id'] ?? null;
    if (!$id) die("ID nhân viên không hợp lệ");

    $this->model->updateStatus($id, 1); // 1: Mở khóa
    //LƯU THÔNG BÁO
    $_SESSION['success_sa'] = "Đã mở khóa tài khoản nhân viên thành công!";
    header("Location: index.php?act=admin-nhanvien");
    exit;
}
}
