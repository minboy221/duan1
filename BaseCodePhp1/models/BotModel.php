<?php
class BotModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    //lấy danh sách tất cả câu hỏi và trả lời
    public function all()
    {
        $sql = "SELECT * FROM bot_answers ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //lấy theo id
    public function find($id){
        $sql = "SELECT * FROM bot_answers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //phần thêm mới
    public function insert($keywords, $answer){
        $sql = "INSERT INTO bot_answers (keywords, answer) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$keywords,$answer]);
    }
    //phần xửa
    public function update($id,$keywords,$answer){
        $sql = "UPDATE bot_answers SET keywords = ?,  answer = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$keywords,$answer,$id]);
    }
    //phần xoá
    public function delete($id){
        $sql = "DELETE FROM bot_answers WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

public function search($keyword)
{
    $sql = "SELECT * FROM bot_answers 
            WHERE keywords LIKE :keyword OR answer LIKE :keyword
            ORDER BY id DESC";
    
    $stmt = $this->conn->prepare($sql);
    $searchParam = '%' . $keyword . '%';
    
    $stmt->bindParam(':keyword', $searchParam, PDO::PARAM_STR);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>