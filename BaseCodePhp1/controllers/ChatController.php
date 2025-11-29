<?php
require_once './models/ChatModel.php';
class ChatController
{
    public $model;

    public function __construct()
    {
        $this->model = new ChatModel();
    }
    //API load tin nhắn cũ
    public function loadChat()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([]);
            return;
        }
        $history = $this->model->getHistory($_SESSION['user_id']);
        echo json_encode($history);
    }
    //API: gửi tin nhắn và nhận phản hổi từ AI
    public function sendChat()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'status' => 'error',
                'reply' => 'Bạn cần đăng nhập để nhắn tin với hỗ trợ.'
            ]);
            return;
        }
        $msg = $_POST['message'] ?? '';
        $user_id = $_SESSION['user_id'];
        if (trim($msg) !== '') {
            //lưu tin nhắn của khách
            $this->model->saveMessage($user_id, $msg, 'client');
            //bot suy nghĩ câu trả lời
            $botReply = $this->model->getBotReply($msg);
            //lưu tin nhắn của bot
            $this->model->saveMessage($user_id, $botReply, 'bot');
            echo json_encode(['status' => 'success', 'reply' => $botReply]);
        } else {
            echo json_encode(['status' => 'empty']);
        }
    }
}

?>