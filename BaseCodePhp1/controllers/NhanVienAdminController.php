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
        include __DIR__ . '/../views/admin/nhanvien/list.php';
    }

    public function createForm()
    {
        // $nv không tồn tại → thêm mới
        $roles = $this->model->allRoles();
        include __DIR__ . '/../views/admin/nhanvien/role.php';
    }

    public function create()
    {
        $data = [
            'name'      => $_POST['name'] ?? '',
            'email'     => $_POST['email'] ?? '',
            'password'  => $_POST['password'] ?? '',
            'phone'     => $_POST['phone'] ?? '',
            'gioitinh'  => $_POST['gioitinh'] ?? '',
            'role_id'   => $_POST['role_id'] ?? 2
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
        if (!$id) die("ID nhân viên không hợp lệ");

        $nv = $this->model->find($id);
        $roles = $this->model->allRoles();

        include __DIR__ . '/../views/admin/nhanvien/role.php';
    }

    public function update()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die('ID nhân viên không hợp lệ.');

        $data = [
            'name'      => $_POST['name'] ?? '',
            'email'     => $_POST['email'] ?? '',
            'phone'     => $_POST['phone'] ?? '',
            'gioitinh'  => $_POST['gioitinh'] ?? '',
            'role_id'   => $_POST['role_id'] ?? 2
        ];

        $this->model->update($id, $data);

        header("Location: index.php?act=admin-nhanvien");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die("ID nhân viên không hợp lệ");

        $this->model->delete($id);

        header("Location: index.php?act=admin-nhanvien");
        exit;
    }
}
?>
