<div class="form-wrapper">
    <form action="index.php?act=updatetho" method="POST" enctype="multipart/form-data" class="form-add">

        <input type="hidden" name="id" value="<?= isset($tho['id']) ? $tho['id'] : '' ?>">

        <div class="form-group">
            <label>Tên thợ</label>
            <input type="text" name="name" value="<?= isset($tho['name']) ? htmlspecialchars($tho['name']) : '' ?>"
                required class="form-control">
            <span class="error-msg"></span>
        </div>

        <div class="form-group">
            <label>Ảnh đại diện</label>
            <input type="file" name="image" class="form-control" style="padding: 5px;">

            <?php if (!empty($tho['image'])): ?>
                <div style="margin-top: 10px;">
                    <img src="./anhtho/<?= $tho['image'] ?>" width="100"
                        style="border-radius: 5px; border: 1px solid #ddd;">
                    <br>
                    <small style="color: #666;">Ảnh hiện tại</small>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Lý lịch / Kinh nghiệm</label>
            <textarea name="lylich"
                rows="4"><?= isset($tho['lylich']) ? htmlspecialchars($tho['lylich']) : '' ?></textarea>
            <span class="error-msg"></span>
        </div>

        <button class="btnthem btn-submit" type="submit">Cập nhật</button>
    </form>
</div>