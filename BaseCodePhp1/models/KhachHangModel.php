<?php
class Khachhang
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB(); 
    }
    public function register($name, $email, $phone, $password)
    {
        try {
           
            $sql = "INSERT INTO khachhang(name, email, phone, password) 
                    VALUES(:name, :email, :phone, :password)";
            $stmt = $this->conn->prepare($sql);
            
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':password'=> $password
            ]);
        } catch (Exception $e) {
            echo 'Lỗi đăng ký: ' . $e->getMessage();
            return false;
        }
    }

    public function login($email)
    {
        try {
            // Sửa tên bảng từ 'users' thành 'khachhang' và tìm kiếm theo 'email'
            $sql = "SELECT * FROM khachhang WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Chỉ trả về thông tin người dùng nếu email tồn tại.
            if ($user) {
                return $user; // trả về thông tin người dùng nếu tìm thấy
            } else {
                return false; // không tìm thấy
            }
        } catch (PDOException $e) {
            echo "Lỗi truy vấn đăng nhập: " . $e->getMessage();
            return false;
        }
    }
    //check thông tin khách hàng để reset mk
    public function checkUserReset($email, $phone)
    {
        try {
            $sql = "SELECT * FROM khachhang WHERE email = :email AND phone = :phone";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email,
                ':phone' => $phone
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về thông tin user nếu đúng, false nếu sai
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    // THÊM HÀM NÀY: Cập nhật mật khẩu mới
    public function updatePassword($email, $newPassword)
    {
        try {
            $sql = "UPDATE khachhang SET password = :password WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':password' => $newPassword,
                ':email' => $email
            ]);
        } catch (Exception $e) {
            echo 'Lỗi update: ' . $e->getMessage();
            return false;
        }
    }
}
?>