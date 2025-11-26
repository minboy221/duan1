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
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? null;

        // Lấy ID khách hàng từ Session
        $khachhang_id = $_SESSION['user_id'] ?? null;

        // Kiểm tra dữ liệu cần thiết
        if (!$ma_lich || !$rating || !$khachhang_id) {
            echo "Thiếu dữ liệu cần thiết (Mã lịch, Số sao, hoặc bạn chưa đăng nhập).";
            return;
        }

        $lichModel = new LichDatModel();

        // --- SỬA LỖI TẠI ĐÂY ---
        // 1. Xóa dòng $booking = getById($ma_lich); đi vì nó sai.
        // 2. Gán kết quả vào biến $bookingList để khớp với logic bên dưới
        $bookingList = $lichModel->getBookingByCode($ma_lich);

        if (empty($bookingList)) {
            echo "Không tìm thấy đơn đặt lịch!";
            return;
        }

        // Lấy dòng đầu tiên để kiểm tra thông tin chung (Khách hàng, Trạng thái)
        $bookingInfo = $bookingList[0];

        // Kiểm tra quyền sở hữu
        if ($bookingInfo['khachhang_id'] != $khachhang_id) {
            echo "Bạn không có quyền đánh giá đơn hàng này.";
            return;
        }

        // Kiểm tra trạng thái (Chỉ đơn 'done' mới được đánh giá)
        if ($bookingInfo['status'] !== 'done') {
            echo "Đơn hàng chưa hoàn thành nên chưa thể đánh giá.";
            return;
        }

        // Kiểm tra xem đã đánh giá chưa
        if (!is_null($bookingInfo['rating'])) {
            echo "Đơn hàng này đã được đánh giá rồi.";
            return;
        }

        // ----------------------------------------------------
        // LƯU ĐÁNH GIÁ
        // ----------------------------------------------------
        $updateSuccess = $lichModel->updateRatingAndReview($ma_lich, $rating, $comment);

        if ($updateSuccess) {
            // Chuyển hướng về trang chi tiết để xem kết quả
            header("Location: index.php?act=lichsudatchitiet&ma_lich=" . $ma_lich);
            exit;
        } else {
            echo "Lỗi khi lưu đánh giá vào cơ sở dữ liệu.";
        }
    }
}
