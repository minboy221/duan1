<?php
require_once './commons/function.php';

class DanhGiaModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy bình luận theo id khách hàng
    public function getByUser($client_id)
    {
        $sql = "SELECT dg.*, dv.name AS ten_dichvu
                FROM danhgia dg
                JOIN dichvu dv ON dg.dichvu_id = dv.id
                WHERE dg.client_id = ?
                ORDER BY dg.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$client_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
