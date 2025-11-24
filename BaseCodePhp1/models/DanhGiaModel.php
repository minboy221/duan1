<?php
require_once './commons/function.php';

class DanhGiaModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy bình luận theo id khách hàng
// Trong DanhGiaModel.php

// Lấy bình luận theo id khách hàng
public function getByUser($client_id)
{
    $sql = "SELECT 
                ld.id, ld.ma_lich, ld.rating, ld.review AS comment, ld.created_at,
                dv.name AS ten_dichvu,
                kh.name AS ten_khach
            FROM lichdat ld
            JOIN dichvu dv ON ld.dichvu_id = dv.id
            JOIN khachhang kh ON ld.khachhang_id = kh.id
            WHERE ld.khachhang_id = ? 
            AND ld.rating IS NOT NULL  /* 💡 CHỈ LẤY CÁC BẢN GHI ĐÃ ĐƯỢC ĐÁNH GIÁ */
            ORDER BY ld.created_at DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$client_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lưu ý: Các hàm khác (checkExist, insert, getByLich) không cần dùng nữa hoặc cần được 
// điều chỉnh lại nếu bạn đã chuyển hoàn toàn logic đánh giá sang bảng lichdat.

    // ⭐ Kiểm tra xem 1 lịch đã được đánh giá chưa
    public function checkExist($ma_lich)
    {
        $sql = "SELECT * FROM danhgia WHERE ma_lich = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_lich]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ⭐ Lấy chi tiết đánh giá theo mã lịch (để hiển thị lại khi xem chi tiết)
    public function getByLich($ma_lich)
    {
        $sql = "SELECT dg.*, dv.name AS ten_dichvu
                FROM danhgia dg
                JOIN dichvu dv ON dg.dichvu_id = dv.id
                WHERE dg.ma_lich = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$ma_lich]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
