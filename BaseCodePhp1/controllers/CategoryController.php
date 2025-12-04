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
    // Trong CategoryController.php::store()

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            // 💡 KIỂM TRA TRÙNG TÊN
            if ($this->model->checkDuplicateName($name)) {
                // Dùng Session Flash cho SweetAlert2
                $_SESSION['error_sa'] = "Lỗi: Tên danh mục đã tồn tại!";
                header("Location: index.php?act=create_danhmuc");
                exit();
            }

            $this->model->insert($_POST);
            $_SESSION['success_sa'] = "Thêm danh mục thành công!"; // Dùng success_sa
        }

        header("Location: index.php?act=qlydanhmuc");
        exit();
    }

    // --- Hàm update() (Cập nhật) ---
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?act=qlydanhmuc");
            exit();
        }
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';

        if (!$id) {
            // Tùy chọn: Dùng Swal nếu không muốn die()
            die("ID danh mục không hợp lệ");
        }

        // 💡 KIỂM TRA TRÙNG TÊN
        if ($this->model->checkDuplicateName($name, $id)) {
            // Dùng Session Flash cho SweetAlert2
            $_SESSION['error_sa'] = "Lỗi: Tên danh mục đã tồn tại (trùng với danh mục khác)!";
            // Quay lại form chỉnh sửa
            header("Location: index.php?act=edit_danhmuc&id=" . $id);
            exit();
        }

        $this->model->update($id, $_POST);
        $_SESSION['success_sa'] = "Cập nhật danh mục thành công!"; // Dùng success_sa
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


    // delete
    // Trong CategoryController.php::delete()

    public function delete()
    {
        $id = $_GET['id'];

        $result = $this->model->delete($id);

        if (!$result) {
            // 💡 SỬA: Dùng $_SESSION['error_sa'] để kích hoạt SweetAlert2
            $_SESSION['error_sa'] = "Không thể xoá danh mục vì vẫn còn dịch vụ thuộc danh mục này!";
        } else {
            // Nếu xóa thành công, dùng $_SESSION['success_sa']
            $_SESSION['success_sa'] = "Xoá danh mục thành công!";
        }

        header("Location: ?act=qlydanhmuc");
        exit();
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
