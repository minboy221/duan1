<?php 
require_once './models/BotModel.php';

class BotController{
    public $model;
    public function __construct(){
        $this->model = new BotModel();
    }
    //phần hiển thị danh sách trang
    public function index(){
    $keyword = $_GET['keyword'] ?? null;
    
    if ($keyword) {
        $listBot = $this->model->search($keyword);
    } else {
        $listBot = $this->model->all();
    }
    
    // 💡 Lưu keyword hiện tại vào session để có thể sử dụng lại trong form nếu cần
    // $_SESSION['last_search_bot'] = $keyword; // Không cần thiết nếu dùng $_GET trực tiếp
    
    require_once './views/admin/bot/list.php'; // Gửi $listBot sang View
}
    //phần thêm
    public function create(){
        require_once './views/admin/bot/create.php';
    }
    //phần lưu dữ liệu
    public function store(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $keywords = $_POST['keywords'];
            $answer = $_POST['answer'];

            $this->model->insert($keywords,$answer);
            header("Location: index.php?act=qlybot");
        }
    }
    //phần xửa
    public function edit(){
        $id = $_GET['id'] ?? null;
        $bot = $this->model->find($id);
        require_once './views/admin/bot/edit.php';
    }
    //phần lưu cập nhật
    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $keywords = $_POST['keywords'];
            $answer = $_POST['answer'];
            $this->model->update($id,$keywords,$answer);
            header("Location: index.php?act=qlybot");
        }
    }
    //phần xoá
    public function delete(){
        $id = $_GET['id'] ?? null;
        if($id){
            $this->model->delete($id);
        }
        header("Location: index.php?act=qlybot");
    }
}
?>