<?php
// models/CategoryModel.php
require_once './commons/function.php';

class CategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB(); // PDO
    }

    // Lấy tất cả danh mục
    public function all() {
        $sql = "SELECT * FROM danhmuc ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 danh mục theo id
    public function find($id) {
        $sql = "SELECT * FROM danhmuc WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm mới
    public function insert($data) {
        $sql = "INSERT INTO danhmuc (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$data['name'] ?? '', $data['description'] ?? null]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật
    public function update($id, $data) {
        $sql = "UPDATE danhmuc SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$data['name'] ?? '', $data['description'] ?? null, $id]);
    }

    // Xoá
    public function delete($id) {
        $sql = "DELETE FROM danhmuc WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Lấy dịch vụ theo danh mục (nếu cần cho trang chi tiết)
    public function getServices($categoryId) {
        $sql = "SELECT d.* FROM dichvu d WHERE d.danhmuc_id = ? ORDER BY d.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
