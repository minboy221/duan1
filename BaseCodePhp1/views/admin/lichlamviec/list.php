<div class="container-fluid">
    <h3 class="text-gray-800 mb-4">Quản lý Lịch Làm Việc</h3>

    <form action="index.php?act=auto_create_days" method="POST" class="mb-4">
        <button type="submit" class="btn btn-success shadow-sm"
            onclick="return confirm('Hệ thống sẽ tạo ngày làm việc cho 7 ngày tới. Bạn chắc chắn chứ?')">
            <i class="fa fa-magic"></i> Tự động tạo 7 ngày tới
        </button>
    </form>

    <div class="row">
        <?php if (!empty($listNgay)): ?>
            <?php foreach ($listNgay as $ngay): ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <?= date('d/m/Y', strtotime($ngay['date'])) ?>
                                <small class="text-muted">(<?= date('l', strtotime($ngay['date'])) ?>)</small>
                            </h6>
                            <div class="card-footer bg-white d-flex justify-content-between">
                                <a href="index.php?act=detail_ngay&id=<?= $ngay['id'] ?>"
                                    class="btn btn-sm btn-info w-100 mr-1">
                                    <i class="fa fa-eye"></i> Chi tiết
                                </a>

                                <a href="index.php?act=assign_tho&id=<?= $ngay['id'] ?>"
                                    class="btn btn-sm btn-primary w-100 ml-1">
                                    <i class="fa fa-user-cog"></i> Gán Thợ
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <?php
                            // Lấy danh sách thợ của ngày này
                            $thoList = (new LichLamViecModel())->getThoInNgay($ngay['id']);
                            ?>

                            <?php if (empty($thoList)): ?>
                                <div class="p-3 text-center text-muted font-italic">
                                    Chưa có thợ nào được phân công.
                                </div>
                            <?php else: ?>
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($thoList as $tho): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <?php $img = !empty($tho['image']) ? './anhtho/' . $tho['image'] : './anhmau/default-avatar.png'; ?>
                                                <img src="<?= $img ?>" width="30" height="30" class="rounded-circle mr-2"
                                                    style="object-fit: cover;">
                                                <span class="font-weight-bold"><?= htmlspecialchars($tho['name']) ?></span>
                                            </div>

                                            <a href="index.php?act=edit_times&id=<?= $tho['phan_cong_id'] ?>"
                                                class="btn btn-sm btn-warning text-white">
                                                <i class="fa fa-clock"></i> Giờ
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">Chưa có ngày làm việc nào. Hãy bấm nút tạo tự động!</div>
            </div>
        <?php endif; ?>
    </div>
</div>