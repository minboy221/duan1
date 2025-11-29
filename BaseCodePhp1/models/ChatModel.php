<?php
class ChatModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    //phần lưu tin nhắn
    public function saveMessage($user_id, $msg, $sender)
    {
        $sql = "INSERT INTO tin_nhan(khachhang_id,message,sender,created_at) VALUE (?,?,?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$user_id, $msg, $sender]);
    }
    //phần lấy lịch sử chat
    public function getHistory($user_id)
    {
        $sql = "SELECT * FROM tin_nhan WHERE khachhang_id = ? ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //phần BOT tự tạo sẽ tìm câu trả lời
    public function getBotReply($userMessage)
    {
        //lấy những kiến thức đã dạy
        $sql = "SELECT * FROM bot_answers";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rules = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $userMessage = mb_strtolower($userMessage); //chuyển về chữ thường

        foreach ($rules as $rule) {
            //tác các từ khoá khi clien hỏi
            $keywords = explode(',', mb_strtolower($rule['keywords']));
            foreach ($keywords as $word) {
                if (strpos($userMessage, trim($word)) !== false) {
                    return $rule['answer']; //tìm thấy từ khoá -> trả về mẫu
                }
            }
        }
        //nếu không hiểu
        return "Em chưa hiểu ý của anh lắm. Anh có thể hỏi về 'giá', 'đặt lịch' hoặc liên hệ với nhân viên bên em ạ!";
    }
    //PHẦN DÀNH CHO ADMIN
    public function getChatCustomers()
    {
        $sql = "SELECT DISTINCT t.khachhang_id, k.name,k.email,k.phone,
        (SELECT message FROM tin_nhan WHERE khachhang_id = t.khachhang_id ORDER BY id DESC LIMIT 1) as last_msg,
        (SELECT created_at FROM tin_nhan WHERE khachhang_id = t.khachhang_id ORDER BY id DESC LIMIT 1) as last_time
        FROM tin_nhan t
        JOIN khachhang k ON t.khachhang_id = k.id
        ORDER BY last_time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //admin gửi tin nhắn nếu bot không trả lời được
    public function sendAdminMsg($client_id, $msg)
    {
        $sql = "INSERT INTO tin_nhan(khachhang_id,message,sender,created_at) VALUES (?,?,'admin',NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$client_id, $msg]);
    }
}

?>