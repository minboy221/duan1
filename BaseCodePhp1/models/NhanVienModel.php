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

    // --- SỬA LẠI HÀM NÀY ---
    public function checkLogin($email)
    {
        $sql = "SELECT nv.*, r.name as role_name 
                FROM nhanvien nv 
                LEFT JOIN user_role ur ON nv.id = ur.user_id 
                LEFT JOIN role r ON ur.role_id = r.id 
                WHERE nv.email = :email"; // Dùng :email để bảo mật hơn
        
        $stmt = $this->conn->prepare($sql);
        
        $stmt->execute(['email' => $email]);
        
        return $stmt->fetch(); 
    }
}
?>