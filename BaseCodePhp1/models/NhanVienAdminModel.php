<?php
require_once './commons/env.php';

class NhanVienAdminModel
{
    protected $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả nhân viên
    public function all()
    {
        $sql = "
            SELECT nv.*, r.id AS role_id, r.name AS role_name
            FROM nhanvien nv
            LEFT JOIN user_role ur ON ur.user_id = nv.id
            LEFT JOIN role r ON r.id = ur.role_id
            ORDER BY nv.id DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 nhân viên
    public function find($id)
    {
        $sql = "SELECT * FROM nhanvien WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $nv = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql2 = "SELECT role_id FROM user_role WHERE user_id = :id";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute(['id' => $id]);
        $role = $stmt2->fetch(PDO::FETCH_ASSOC);
        $nv['role_id'] = $role ? $role['role_id'] : null;

        return $nv;
    }

    // Lấy tất cả role
    public function allRoles()
    {
        $sql = "SELECT * FROM role";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm nhân viên
    public function create($data)
    {
        $sql = "INSERT INTO nhanvien (name, email, password, phone, gioitinh) VALUES (:name, :email, :password, :phone, :gioitinh)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'phone' => $data['phone'] ?? '',
            'gioitinh' => $data['gioitinh'] ?? ''
        ]);

        $id = $this->conn->lastInsertId();

        if (!empty($data['role_id'])) {
            $sql2 = "INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute([
                'user_id' => $id,
                'role_id' => $data['role_id']
            ]);
        }

        return $id;
    }

    // Cập nhật nhân viên
    public function update($id, $data)
    {
        $sql = "UPDATE nhanvien SET name=:name, email=:email, phone=:phone, gioitinh=:gioitinh WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? '',
            'gioitinh' => $data['gioitinh'] ?? '',
            'id' => $id
        ]);

        // Cập nhật role
        $sqlCheck = "SELECT * FROM user_role WHERE user_id=:id";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute(['id' => $id]);
        $exists = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($exists) {
            $sqlRole = "UPDATE user_role SET role_id=:role_id WHERE user_id=:id";
        } else {
            $sqlRole = "INSERT INTO user_role (user_id, role_id) VALUES (:id, :role_id)";
        }

        $stmtRole = $this->conn->prepare($sqlRole);
        $stmtRole->execute([
            'role_id' => $data['role_id'],
            'id' => $id
        ]);

        return true;
    }

    // Xóa nhân viên
    public function delete($id)
    {
        $sql1 = "DELETE FROM user_role WHERE user_id=:id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute(['id' => $id]);

        $sql2 = "DELETE FROM nhanvien WHERE id=:id";
        $stmt2 = $this->conn->prepare($sql2);
        return $stmt2->execute(['id' => $id]);
    }
    // Tìm kiếm nhân viên theo tên hoặc email
    // Tìm kiếm nhân viên theo tên, email hoặc số điện thoại
public function search($keyword)
{
    $keyword = "%$keyword%";

    $sql = "
        SELECT nv.*, r.id AS role_id, r.name AS role_name
        FROM nhanvien nv
        LEFT JOIN user_role ur ON ur.user_id = nv.id
        LEFT JOIN role r ON r.id = ur.role_id
        WHERE nv.name LIKE :kw
           OR nv.email LIKE :kw
           OR nv.phone LIKE :kw
        ORDER BY nv.id DESC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['kw' => $keyword]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    
}
?>
