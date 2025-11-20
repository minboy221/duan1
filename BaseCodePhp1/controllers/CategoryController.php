<?php
// controllers/CategoryController.php
require_once './models/CategoryModel.php';
require_once './models/DichVuModel.php';

class CategoryController
{
    protected $model;
    protected $dichvuModel;

    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->dichvuModel = new DichVuModel();
    }

    // danh sách
    public function quanlydanhmuc()
    {
        $keyword = $_GET['keyword'] ?? null;

        if ($keyword) {
            $categories = $this->model->search($keyword);
        } else {
            $categories = $this->model->all();
        }

        include 'views/admin/danhmuc/list.php';
    }


    // form create
    public function createdanhmuc()
    {
        include 'views/admin/danhmuc/create.php';
    }

    // store
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->insert($_POST);
        }
        header("Location: index.php?act=qlydanhmuc");
        exit();
    }

    // form edit
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID danh mục không hợp lệ";
            exit;
        }
        $category = $this->model->find($id);
        include 'views/admin/danhmuc/edit.php';
    }

    // update
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?act=qlydanhmuc");
            exit();
        }
        $id = $_POST['id'] ?? null;
        if (!$id) {
            echo "ID danh mục không hợp lệ";
            exit;
        }
        $this->model->update($id, $_POST);
        header("Location: index.php?act=qlydanhmuc");
        exit();
    }

    // delete
    public function delete()
    {
        $id = $_GET['id'];

        $result = $this->model->delete($id);

        if (!$result) {
            $_SESSION['error'] = "Không thể xoá danh mục vì vẫn còn dịch vụ thuộc danh mục này!";
            header("Location: ?act=qlydanhmuc");
            exit;
        }

        $_SESSION['success'] = "Xoá danh mục thành công!";
        header("Location: ?act=qlydanhmuc");
    }


    // show (xem chi tiết 1 danh mục + danh sách dịch vụ trong đó)
    // controllers/CategoryController.php
    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID danh mục không hợp lệ";
            exit;
        }
        $category = $this->model->find($id); // đổi từ $danhmuc -> $category
        if (!$category) {
            echo "Danh mục không tồn tại";
            exit;
        }
        $services = $this->dichvuModel->getByCategory($id);
        include 'views/admin/danhmuc/show.php';
    }
}
