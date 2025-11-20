<?php
class ThoModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function all()
    {
        $sql = "SELECT * FROM tho ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //lấy ra id của thợ
    public function find($id)
    {
        $sql = "SELECT * FROM tho WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function insert($data, $file)
    {
        $name = $data['name'] ?? '';
        $lylich = $data['lylich'] ?? '';
        $imageName = null;
        //sủ lý upload ảnh
        if (!empty($file['image']['name'])) {
            $imageName = time() . "_" . preg_replace('/\s+/', '_', basename($file['image']['name']));
            move_uploaded_file($file['image']['tmp_name'], "anhtho/" . $imageName);
        }
        $sql = "INSERT INTO tho(name,lylich,image) VALUE (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $lylich, $imageName]);
    }
    // phần sửa
    public function update($id, $data, $file)
    {
        $name = $data['name'] ?? '';
        $lylich = $data['lylich'] ?? '';
        $params = [$name, $lylich];
        $imageSQL = "";
        //kiểm tra xem có ảnh mới không
        if (!empty($file['image']['name'])) {
            $iamgeName = time() . "_" . preg_replace('/\s+/', '_', basename($file['image']['name']));
            move_uploaded_file($file['image']['tmp_name'], "anhtho/" .$iamgeName);
            $imageSQL = ",image = ?";
            $params[] = $iamgeName;
        }
        $params[] = $id;
        $sql = "UPDATE tho SET name = ?,lylich = ? $imageSQL WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }
    //phần xoá
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM tho WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$id]);
        } catch (Exception $e) {
            echo 'Không thể xoá thợ này vì đang có dữ liệu liên quan';
            return false;
        }
    }
    // tìm kiếm thợ theo tên
    public function search($keyword)
{
    $sql = "SELECT * FROM tho WHERE name LIKE :keyword";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
?>