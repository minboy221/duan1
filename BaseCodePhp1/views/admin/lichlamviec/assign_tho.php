<div class="form-wrapper">
    <h4 class="mb-3">Phân công thợ cho ngày ID: <?= $ngay_id ?></h4>

    <form action="index.php?act=store_assign" method="POST" class="form-add">

        <input type="hidden" name="ngay_lv_id" value="<?= $ngay_id ?>">

        <div class="form-group">
            <label>Danh sách nhân viên:</label>
            <div class="row">
                <?php if (!empty($allTho)): ?>
                    <?php foreach ($allTho as $tho): ?>
                        <?php
                        // Kiểm tra đã chọn chưa
                        $checked = in_array($tho['id'], $assignedIds) ? 'checked' : '';
                        ?>
                        <div class="col-md-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input tho-checkbox" type="checkbox" name="tho_ids[]"
                                    value="<?= $tho['id'] ?>" <?= $checked ?>>
                                <label class="form-check-label">
                                    <?= htmlspecialchars($tho['name']) ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Không có dữ liệu thợ.</p>
                <?php endif; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Lưu Phân Công</button>
    </form>
</div>