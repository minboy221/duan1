<?php
class LichDatModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all()
    {
        $sql = "
            SELECT l.*, kh.name AS ten_khach, dv.name AS ten_dichvu, 
                   kg.time, kg.ngay_id
            FROM lichdat l
            JOIN khachhang kh ON kh.id = l.khachhang_id
            JOIN dichvu dv ON dv.id = l.dichvu_id
            JOIN khunggio kg ON kg.id = l.khunggio_id
            ORDER BY l.created_at DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "
            SELECT l.*, kh.name AS ten_khach, dv.name AS ten_dichvu, 
                   kg.time, kg.ngay_id
            FROM lichdat l
            JOIN khachhang kh ON kh.id = l.khachhang_id
            JOIN dichvu dv ON dv.id = l.dichvu_id
            JOIN khunggio kg ON kg.id = l.khunggio_id
            WHERE l.id = :id
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE lichdat SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}
