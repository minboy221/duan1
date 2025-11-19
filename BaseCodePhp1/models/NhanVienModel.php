<?php
require_once './commons/env.php';

class NhanVienModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM nhanvien WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }
}
