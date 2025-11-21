<div class="form-wrapper">
    <div class="text-center mb-4">
        <h4 class="text-gray-800">Xếp Giờ Làm Việc</h4>
        <h5 class="text-primary font-weight-bold">
            <?= htmlspecialchars($info['name']) ?>
            <small class="text-muted"> | Ngày <?= date('d/m/Y', strtotime($info['date'])) ?></small>
        </h5>
    </div>

    <form action="index.php?act=update_times" method="POST">
        <input type="hidden" name="phan_cong_id" value="<?= $info['id'] ?>">

        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <strong>Tích chọn các khung giờ làm việc:</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    // Tạo giờ từ 08:00 đến 21:00
                    for ($i = 8; $i <= 21; $i++):
                        $timeStr = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";

                        // Kiểm tra xem giờ này có trong DB chưa
                        // Lưu ý: $currentTimes phải là mảng phẳng ['08:00', '09:00']
                        // Nếu model trả về mảng lồng, bạn cần dùng array_column hoặc sửa model fetchColumn như bài trước
                        $isChecked = in_array($timeStr, $currentTimes) ? 'checked' : '';
                        ?>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="form-check p-2 border rounded d-flex align-items-center" style="cursor: pointer;">
                                <input class="form-check-input ml-2" type="checkbox" name="times[]" value="<?= $timeStr ?>"
                                    id="time_<?= $i ?>" <?= $isChecked ?> style="transform: scale(1.3); cursor: pointer;">

                                <label class="form-check-label ml-4 w-100 font-weight-bold" for="time_<?= $i ?>"
                                    style="cursor: pointer; margin-left: 10px;">
                                    <?= $timeStr ?>
                                </label>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-success btn-lg px-5">
                <i class="fa fa-save"></i> Lưu Thay Đổi
            </button>
            <br><br>
            <a href="index.php?act=qlylichlamviec" class="text-secondary">Quay lại danh sách</a>
        </div>
    </form>
</div>