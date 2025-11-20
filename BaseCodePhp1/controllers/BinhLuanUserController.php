<?php
require_once './models/DanhGiaModel.php';
require_once './models/Taikhoanuser.php';

class BinhLuanUserController
{
    private $commentModel;
    private $userModel;

    public function __construct()
    {
        $this->commentModel = new DanhGiaModel();
        $this->userModel = new thongtinuser();
    }

    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID không hợp lệ";
            return;
        }

        $user = $this->userModel->find($id);
        $comments = $this->commentModel->getByUser($id);

        require_once './views/admin/binhluan_user.php';
    }
}
