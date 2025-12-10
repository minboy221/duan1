<?php
// controllers/DichVuController.php
require_once './models/DichVuModel.php';
require_once './models/CategoryModel.php';

class DichVuController
{
    protected $model;
    protected $categoryModel;

    public function __construct()
    {
        $this->model = new DichVuModel();
        $this->categoryModel = new CategoryModel(); // để load danh mục
    }

    // danh sách dịch vụ
    public function quanlydichvu()
    {
        $keyword = $_GET['keyword'] ?? '';

        if ($keyword !== '') {
            $services = $this->model->search($keyword);
        } else {
            $services = $this->model->all();
        }

        include 'views/admin/dichvu/list.php';
    }


    // form tạo
    public function createdichvu()
    {
        $categories = $this->categoryModel->all();
        include 'views/admin/dichvu/create.php';
    }


public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $name = $_POST['name'] ?? '';
        $errors = [];

        //KIỂM TRA TRÙNG TÊN DỊCH VỤ
        if ($this->model->checkDuplicateName($name)) {
            // Nếu trùng tên -> Báo lỗi và dừng
            $errors[] = "Tên dịch vụ '$name' đã tồn tại. Vui lòng chọn tên khác!";
        }
        
        // Validate các trường khác (Giữ nguyên logic cũ)
        if (empty($_POST['name'])) {
            $errors[] = "Tên dịch vụ không được để trống";
        }
        if (empty($_POST['price'])) {
            $errors[] = "Giá không được để trống";
        }

        if (!empty($errors)) {
            $_SESSION['error_sa'] = implode('<br>', $errors); // Gộp các lỗi thành 1 chuỗi
            header("Location: index.php?act=createdichvu");
            exit();
        }

        // Nếu không có lỗi, tiến hành Insert
        $this->model->insert($_POST, $_FILES);

        //Dùng $_SESSION['success_sa'] cho popup thành công
        $_SESSION['success_sa'] = "Thêm dịch vụ thành công!";
    }

    header("Location: index.php?act=qlydichvu");
    exit();
}

    // form sửa
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID dịch vụ không hợp lệ";
            exit();
        }

        $service = $this->model->findWithCategory($id);
        $categories = $this->categoryModel->all();

        include 'views/admin/dichvu/edit.php';
    }

    // xử lý cập nhật
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?act=qlydichvu");
            exit();
        }

        $id = $_POST['id'] ?? null;

        if (!$id) {
            echo "ID dịch vụ không hợp lệ";
            exit();
        }

        $this->model->update($id, $_POST, $_FILES);
        $_SESSION['success'] = "Cập nhật dịch vụ thành công!";

        header("Location: index.php?act=qlydichvu");
        exit();
    }

    // xóa dịch vụ
public function delete()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: index.php?act=qlydichvu");
        exit;
    }

    //SỬA LỖI: Gọi đúng Model DichVu
    $result = $this->model->delete($id); 

    if ($result === "foreign_key_violation") {
        $_SESSION['error_sa'] = "Không thể xóa dịch vụ này vì đã có lịch đặt hoặc dữ liệu liên quan sử dụng nó.";
    } elseif ($result) {
        $_SESSION['success_sa'] = "Đã xóa dịch vụ thành công!";
    } else {
        $_SESSION['error_sa'] = "Xóa dịch vụ thất bại do lỗi hệ thống!";
    }

    header("Location: index.php?act=qlydichvu");
    exit();
}

    // xem chi tiết 1 dịch vụ + danh mục
    public function show()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "ID dịch vụ không hợp lệ";
            exit();
        }

        $service = $this->model->findWithCategory($id);

        if (!$service) {
            echo "Dịch vụ không tồn tại";
            exit();
        }

        include 'views/admin/dichvu/show.php';
    }
}
