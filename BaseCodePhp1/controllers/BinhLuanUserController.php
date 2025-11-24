<?php
require_once './models/DanhGiaModel.php';
require_once './models/Taikhoanuser.php';
require_once './models/LichDatModel.php';

class BinhLuanUserController
{
    private $commentModel;
    private $userModel;

    public function __construct()
    {
        $this->commentModel = new DanhGiaModel();
        $this->userModel = new ThongTinUser(); // nhớ sửa đúng tên class
    }

    // Xem danh sách đánh giá của 1 khách hàng
public function detail()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        echo "ID không hợp lệ";
        return;
    }

    $user = $this->userModel->find($id);
    // 💡 $comments sẽ chứa danh sách đánh giá lấy từ bảng lichdat
    $comments = $this->commentModel->getByUser($id); 

    // Truyền $user và $comments sang view
    require_once './views/admin/binhluan_user.php';
}

    // Hiện form đánh giá sau khi đơn hoàn thành
    public function formDanhGia()
    {
        $ma_lich = $_GET['ma_lich'] ?? null;
        if (!$ma_lich) {
            echo "Không tìm thấy mã lịch!";
            return;
        }

        $model = new LichDatModel();
        $booking = $model->getById($ma_lich);

        if (!$booking) {
            echo "Không tìm thấy lịch đặt!";
            return;
        }

        require_once './views/clien/FormDanhGia.php';
    }
    // Trong BinhLuanUserController.php

public function submitDanhGia()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo "Phương thức không hợp lệ!";
        return;
    }

    $ma_lich = $_POST['ma_lich'] ?? null;
    $rating  = $_POST['rating'] ?? null;
    $comment = $_POST['comment'] ?? null;
    
    // Đã sửa: Lấy ID khách hàng từ khóa 'user_id' được đặt trong KhachHangController
    $khachhang_id = $_SESSION['user_id'] ?? null; 

    // Kiểm tra dữ liệu cần thiết
    if (!$ma_lich || !$rating || !$khachhang_id) {
        // Có thể thay bằng cảnh báo JavaScript đẹp hơn
        echo "Thiếu dữ liệu cần thiết (Mã lịch, Số sao, hoặc bạn chưa đăng nhập).";
        return;
    }

    $lichModel = new LichDatModel();
    
    // Kiểm tra và lấy thông tin booking
    $booking = $lichModel->getBookingByCode($ma_lich);

    if (!$booking) {
        echo "Lỗi: Không tìm thấy lịch đặt với mã này.";
        return;
    }
    
    // 💡 Thêm kiểm tra: Đảm bảo khách hàng chỉ đánh giá đơn của chính họ
    if ($booking['khachhang_id'] != $khachhang_id) {
        echo "Bạn không có quyền đánh giá đơn hàng này.";
        return;
    }
    
    // 💡 Thêm kiểm tra: Đơn hàng phải ở trạng thái 'done' và chưa được đánh giá
    if ($booking['status'] !== 'done' || !is_null($booking['rating'])) {
        echo "Đơn hàng chưa hoàn thành hoặc đã được đánh giá rồi.";
        return;
    }


    // ----------------------------------------------------
    // LƯU ĐÁNH GIÁ (CẬP NHẬT VÀO BẢNG LICH DAT)
    // ----------------------------------------------------
    $updateSuccess = $lichModel->updateRatingAndReview($ma_lich, $rating, $comment);

    if ($updateSuccess) {
        header("Location: index.php?act=lichsudatchitiet&ma_lich=" . $ma_lich);
        exit;
    } else {
        echo "Lỗi khi lưu đánh giá vào cơ sở dữ liệu.";
        // Tùy chọn: Ghi log lỗi PDO để debug
    }
}
}
