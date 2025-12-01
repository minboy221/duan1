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

    public function checkLogin($email)
    {
        $sql = "SELECT nv.*, r.name as role_name 
                FROM nhanvien nv 
                LEFT JOIN user_role ur ON nv.id = ur.user_id 
                LEFT JOIN role r ON ur.role_id = r.id 
                WHERE nv.email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    // --- CÁC HÀM CHO CHỨC NĂNG ĐỔi MẬT KHẨU (FORGOT PASSWORD) ---

    // 1. Kiểm tra Email + SĐT (để xác thực khi quên mật khẩu)
    public function checkStaffReset($email, $phone)
    {
        $sql = "SELECT * FROM nhanvien WHERE email = :email AND phone = :phone LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'phone' => $phone
        ]);
        return $stmt->fetch();
    }

    // 2. Cập nhật mật khẩu mới theo Email (Dùng cho quên mật khẩu)
    public function updatePassword($email, $new_password)
    {
        $sql = "UPDATE nhanvien 
                SET password = :password, last_reset_pass = NOW() 
                WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'password' => $new_password,
            'email' => $email
        ]);
    }

    // --- CÁC HÀM CHO CHỨC NĂNG ĐỔI MẬT KHẨU (CHANGE PASSWORD - KHI ĐÃ LOGIN) ---

    // 3. Tìm nhân viên theo ID (Dùng để lấy mật khẩu cũ ra so sánh)
    public function findById($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // 4. Đổi mật khẩu theo ID (Dùng khi nhân viên chủ động đổi trong trang quản trị)
    public function changePasswordById($id, $new_password)
    {
        $sql = "UPDATE nhanvien 
                SET password = :password, last_reset_pass = NOW() 
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'password' => $new_password,
            'id' => $id
        ]);
    }
}
?>