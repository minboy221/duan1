<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-gray-800">
            Chi Tiết Lịch Làm Việc:
            <span class="text-primary font-weight-bold">
                <?= date('d/m/Y', strtotime($dayInfo['date'])) ?>
            </span>
        </h3>
        <a href="index.php?act=qlylichlamviec" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nhân sự & Ca làm việc</h6>
        </div>
        <div class="card-body">

            <?php if (!empty($listTho)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th width="5%">STT</th>
                                <th width="20%">Thợ / Stylist</th>
                                <th>Khung Giờ Đăng Ký</th>
                                <th width="15%">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listTho as $index => $tho): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php $img = !empty($tho['image']) ? './anhtho/' . $tho['image'] : './anhmau/default-avatar.png'; ?>
                                            <img src="<?= $img ?>" class="rounded-circle mr-2" width="40" height="40"
                                                style="object-fit: cover;">
                                            <div>
                                                <strong><?= htmlspecialchars($tho['name']) ?></strong>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <?php if (!empty($tho['slots'])): ?>
                                            <?php foreach ($tho['slots'] as $time): ?>
                                                <span class="badge badge-info p-2 mr-1 mb-1" style="font-size: 13px;">
                                                    <i class="fa fa-clock"></i> <?= $time ?>
                                                </span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="text-muted font-italic">Chưa xếp giờ làm</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-center">
                                        <a href="index.php?act=edit_times&id=<?= $tho['phan_cong_id'] ?>"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Sửa Giờ
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <p class="text-muted mb-3">Ngày này chưa có thợ nào được phân công.</p>
                    <a href="index.php?act=assign_tho&id=<?= $dayInfo['id'] ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Phân công thợ ngay
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>