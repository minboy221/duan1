<?php
require_once './models/ChatModel.php';

class AdminChatController
{
    public $model;

    public function __construct()
    {
        $this->model = new ChatModel();
    }
    //phần hiển thị giao diện chat
    public function index()
    {
        //danh sách khách hàng
        $listCustomers = $this->model->getChatCustomers();
        require_once './views/admin/chat/index.php';
    }
    //API lấy nội dung hội thoại của khách và hiển thị ở admin
    public function getConversation()
    {
        $client_id = $_GET['client_id'] ?? 0;
        $messages = $this->model->getHistory($client_id);
        header('Content-Type: application/json');
        echo json_encode($messages);
        exit;
    }
}
?>