<?php
require_once './models/ThoModel.php';

class ThoController
{
    public $model;

    public function __construct()
    {
        $this->model = new ThoModel();
    }
    //Danh sách thợ
    public function index()
    {
        $thoList = $this->model->all();
        require_once './views/admin/tho/List.php';
    }
    //Form thêm mới
    public function create()
    {
        require_once './views/admin/tho/create.php';
    }
    //lưu thợ mới
    public function tho()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->insert($_POST, $_FILES);
            header('Location: index.php?act=qlytho');
            exit();
        }
    }
    //phần xửa
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        $tho = $this->model->find($id);
        require_once './views/admin/tho/edit.php';
    }
    //phần hàm update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->model->update($id, $_POST, $_FILES);
            header("Location: index.php?act=qlytho");
            exit();
        }
    }
    //phần xoá
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->model->delete($id);
        }
        header("Location:index.php?act=qlytho");
        exit();
    }
}

?>