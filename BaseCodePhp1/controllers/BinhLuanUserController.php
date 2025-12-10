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
        $this->userModel = new ThongTinUser();
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
        //$comments sẽ chứa danh sách đánh giá lấy từ bảng lichdat
        $comments = $this->commentModel->getByUser($id);

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

    public function submitDanhGia()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo "Phương thức không hợp lệ!";
            return;
        }

        // 1. Lấy dữ liệu
        $ma_lich = $_POST['ma_lich'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? null;

        // Lấy ID khách từ session
        $khachhang_id = $_SESSION['user_id'] ?? null;

        // Kiểm tra dữ liệu đầu vào
        if (!$ma_lich || !$rating || !$khachhang_id) {
            echo "<script>alert('Thiếu dữ liệu hoặc phiên đăng nhập hết hạn!'); window.history.back();</script>";
            return;
        }

        // 2. Gọi Model lấy thông tin đơn hàng
        $lichModel = new LichDatModel();
        $bookingInfo = $lichModel->getBookingByCode($ma_lich);

        // Kiểm tra nếu không có dữ liệu
        if (!$bookingInfo) {
            echo "<script>alert('Không tìm thấy đơn đặt lịch!'); window.history.back();</script>";
            return;
        }

        // Nếu model trả về mảng nhiều dòng (có số 0 ở đầu), ta lấy dòng đầu tiên
        if (isset($bookingInfo[0]) && is_array($bookingInfo[0])) {
            $bookingInfo = $bookingInfo[0];
        }

        //phần kiểm tra xem key 'khachhang_id' có tồn tại không
        if (!isset($bookingInfo['khachhang_id'])) {
            echo "Lỗi dữ liệu: Không tìm thấy thông tin khách hàng trong đơn hàng.";
            return;
        }

        // 3. Kiểm tra quyền sở hữu (ID trong đơn phải trùng ID người đang đăng nhập)
        if ($bookingInfo['khachhang_id'] != $khachhang_id) {
            echo "<script>alert('Bạn không có quyền đánh giá đơn hàng này!'); window.history.back();</script>";
            return;
        }

        // 4. Kiểm tra trạng thái (Chỉ đơn 'done' mới được đánh giá)
        if ($bookingInfo['status'] !== 'done') {
            echo "<script>alert('Đơn hàng chưa hoàn thành nên chưa thể đánh giá.'); window.history.back();</script>";
            return;
        }

        // 5. Kiểm tra xem đã đánh giá chưa (Dựa vào cột rating trong DB)
        if (!empty($bookingInfo['rating'])) {
            echo "<script>alert('Đơn hàng này đã được đánh giá rồi.'); window.history.back();</script>";
            return;
        }

        // Gọi hàm cập nhật rating và review vào bảng lichdat
        $updateSuccess = $lichModel->updateRatingAndReview($ma_lich, $rating, $comment);

        if ($updateSuccess) {
            echo "<script>
                    alert('Cảm ơn bạn đã đánh giá!'); 
                    window.location.href = 'index.php?act=lichsudatchitiet&ma_lich=" . $ma_lich . "';
                  </script>";
            exit;
        } else {
            echo "<script>alert('Lỗi khi lưu đánh giá!'); window.history.back();</script>";
        }
    }
}
