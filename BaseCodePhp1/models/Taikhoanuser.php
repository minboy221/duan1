<?php
require_once './commons/function.php';
class thongtinuser
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function alltaikhoan()
    {
        try {
            $sql = "SELECT * FROM khachhang ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            debug("lỗi" . $e->getMessage());
        }
    }
    //lấy ra id của khách hàng
    public function find($id)
    {
        try {
            $sql = "SELECT * FROM khachhang WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            debug('lỗi' . $e->getMessage());
        }
    }
}

?>