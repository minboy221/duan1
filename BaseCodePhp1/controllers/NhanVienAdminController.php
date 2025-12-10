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

        if ($data['name'] == '' || $data['email'] == '' || $data['password'] == '') {
            die("Vui lòng nhập đầy đủ thông tin.");
        }

        $this->model->create($data);

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

        $this->model->update($id, $data);

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
