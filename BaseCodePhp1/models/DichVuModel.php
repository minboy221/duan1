<?php
require_once './commons/function.php';

class DichVuModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả dịch vụ kèm tên danh mục (LEFT JOIN)
    public function allWithCategory()
    {
        $sql = "SELECT d.*, dm.name AS category_name 
                FROM dichvu d
                LEFT JOIN danhmuc dm ON d.danhmuc_id = dm.id
                ORDER BY d.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả dịch vụ (không join) - nếu cần
    public function all()
    {
        $sql = "SELECT * FROM dichvu ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //lấy dịch vụ theo ID
    public function find($id)
    {
        $sql = "SELECT * FROM dichvu WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy 1 dịch vụ (kèm tên danh mục)
    public function findWithCategory($id)
    {
        $sql = "SELECT d.*, dm.name AS category_name 
                FROM dichvu d
                LEFT JOIN danhmuc dm ON d.danhmuc_id = dm.id
                WHERE d.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm dịch vụ (có xử lý ảnh)
    public function insert($data, $file)
    {
        $name = $data['name'] ?? '';
        $desc = $data['description'] ?? null;
        $price = $data['price'] ?? 0;
        $time = $data['time'] ?? null;
        $danhmuc_id = $data['danhmuc_id'] ?? null;

        $imageName = null;
        if (!empty($file['image']['name'])) {
            $imageName = time() . "_" . preg_replace('/\s+/', '_', basename($file['image']['name']));
            move_uploaded_file($file['image']['tmp_name'], "uploads/" . $imageName);
        }

        $sql = "INSERT INTO dichvu (name, description, price, time, danhmuc_id, image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $desc, $price, $time, $danhmuc_id, $imageName]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật dịch vụ
    public function update($id, $data, $file)
    {
        $name = $data['name'] ?? '';
        $desc = $data['description'] ?? null;
        $price = $data['price'] ?? 0;
        $time = $data['time'] ?? null;
        $danhmuc_id = $data['danhmuc_id'] ?? null;

        $params = [$name, $desc, $price, $time, $danhmuc_id];
        $imageSQL = "";
        if (!empty($file['image']['name'])) {
            $imageName = time() . "_" . preg_replace('/\s+/', '_', basename($file['image']['name']));
            move_uploaded_file($file['image']['tmp_name'], "uploads/" . $imageName);
            $imageSQL = ", image = ?";
            $params[] = $imageName;
        }
        $params[] = $id;

        $sql = "UPDATE dichvu SET name = ?, description = ?, price = ?, time = ?, danhmuc_id = ? $imageSQL WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

// Xoá dịch vụ
public function delete($id)
{
    try {
        // Cố gắng xóa dịch vụ
        $sql = "DELETE FROM dichvu WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return true; // Xóa thành công
        
    } catch (PDOException $e) {
        if ($e->getCode() == '23000' || strpos($e->getMessage(), '1451') !== false) {
            return "foreign_key_violation";
        }
        throw $e; 
    }
}

    // Lấy dịch vụ theo danh mục (nếu muốn)
    public function getByCategory($catId)
    {
        $sql = "SELECT * FROM dichvu WHERE danhmuc_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$catId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Tìm kiếm dịch vụ theo từ khoá
    public function search($keyword)
    {
        $sql = "SELECT * FROM dichvu 
            WHERE name LIKE :kw 
               OR price LIKE :kw
               OR time LIKE :kw
            ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['kw' => '%' . $keyword . '%']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Tìm kiếm dịch vụ cho client
    public function searchClient($keyword)
{
    $sql = "SELECT * FROM dichvu 
            WHERE name LIKE :kw 
               OR price LIKE :kw 
               OR time LIKE :kw
            ORDER BY id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['kw' => '%' . $keyword . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function checkDuplicateName($name)
{
    $sql = "SELECT COUNT(id) FROM dichvu WHERE name = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$name]);
    
    return $stmt->fetchColumn() > 0;
}
}
