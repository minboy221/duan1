<?php
require_once './models/LichLamViecModel.php';

class LichLamViecController
{
    public $model;
    public function __construct()
    {
        $this->model = new LichLamViecModel();
    }
    //hiển thị phần ngày làm việc
    public function index()
    {
        $listNgay = $this->model->getAllNgay();
        require_once './views/admin/lichlamviec/list.php';
    }
    public function autoCreate()
    {
        $count = $this->model->taoNgayTuDong();
        if ($count !== false) {
            echo "<script>alert('Thàn công! đã tạo thêm $count ngày làm việc mới.');
                window.location.href='index.php?act=qlylichlamviec';
                </script>";
            exit();
        } else {
            header("Location: index.php?act=qlylichlamviec");
            exit();
        }
    }
    //PHẦN CHỌN THỢ CHO NGÀY
    public function assignTho()
    {
        $ngay_id = $_GET['id']; //id của ngày làm việc
        //lấy thợ đã chọn trước đó
        $assignedData = $this->model->getThoInNgay($ngay_id);
        $assignedIds = array_column($assignedData, 'tho_id');
        //lấy tất cả thợ hệ thống
        $allTho = $this->model->getAllThoSystem();
        require_once './views/admin/lichlamviec/assign_tho.php';
    }
    //Phần xử lý thợ
    public function storeAssign()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ngay_lv_id = $_POST['ngay_lv_id'];
            $tho_ids = $_POST['tho_ids'] ?? [];
            //giới hạn thợ làm trong ngày
            if (count($tho_ids) > 4) {
                echo "<script>alert('Chỉ được chọn tối đa 4 thợ!'); windown.history.back();</script>";
                exit;
            }
            $this->model->savePhanCong($ngay_lv_id, $tho_ids);
            header("Location: index.php?act=qlylichlamviec");
        }
    }
    //PHẦN CHỌN THỢ CHO TỪNG GIỜ
    public function editTimes()
    {
        $phan_cong_id = $_GET['id'] ?? null;
        if (!$phan_cong_id) {
            header("Location: index.php?act=qlylichlamviec");
            exit;
        }

        // Lấy thông tin để hiện tiêu đề
        $info = $this->model->getDetailPhanCong($phan_cong_id);

        // Lấy giờ hiện tại của thợ đó
        $currentTimes = $this->model->getKhungGio($phan_cong_id);

        require_once './views/admin/lichlamviec/edit_times.php';
    }
    //PHẦN XỬ LÝ LƯU GIỜ
    public function updateTimes()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phan_cong_id = $_POST['phan_cong_id'];
            $times = $_POST['times'] ?? [];
            //KIỂM TRA XUNG ĐỘT ---
            $conflicts = $this->model->checkTimeConflicts($phan_cong_id, $times);

            if (!empty($conflicts)) {
                // Nếu có xung đột (bỏ giờ đã có khách đặt)
                $conflict_times = implode(', ', $conflicts);
                // Lưu thông báo lỗi vào Session (để hiện Popup SweetAlert2)
                $_SESSION['error_sa'] = "Không thể xóa các khung giờ: <b>{$conflict_times}</b> vì đã có khách đặt lịch!";

                // Quay lại trang Sửa Giờ
                header("Location: index.php?act=edit_times&id=" . $phan_cong_id);
                exit();
            }
            $result = $this->model->saveKhungGio($phan_cong_id, $times); // Lưu thông báo thành công
            if ($result) {
                $_SESSION['success_sa'] = "Cập nhật khung giờ thành công!";
            }else{
                $_SESSION['error_sa'] = 'lỗi không thể cập nhật!';
            }
            header("Location: index.php?act=edit_times&id=" . $phan_cong_id);
            exit();
        } else {
            header("Location: index.php?act=qlylichlamviec");
            exit();
        }
    }
    //CHỨC NĂNG XEM CHI TIẾT NGÀY ĐÃ TẠO CHO ADMIN
    public function detail()
    {
        //lấy id ngày
        $ngay_id = $_GET['id'] ?? null;
        if (!$ngay_id) {
            header("Location:index.php?act=qlyLichlamviec");
            exit;
        }
        //lấy thông tin ngày
        $dayInfo = $this->model->getNgayById($ngay_id);
        //lấy danh sách thợ
        $listTho = $this->model->getThoInNgay($ngay_id);
        //lặp qua để lấy thêm khung giờ
        foreach ($listTho as &$tho) {
            $tho['slots'] = $this->model->getKhungGio($tho['phan_cong_id']);
        }
        unset($tho); //huỷ tham chiếu
        require_once './views/admin/lichlamviec/detail.php';
    }
}

?>