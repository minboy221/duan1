<form action="<?= BASE_URL ?>?act=submit_danhgia" method="POST" class="rating-box">
    <input type="hidden" name="ma_lich" value="<?= $ma_lich ?>">

    <h2>Đánh Giá Lịch Hẹn</h2>

    <label>Số sao:</label>
    <select name="rating" required>
        <option value="5">⭐⭐⭐⭐⭐</option>
        <option value="4">⭐⭐⭐⭐</option>
        <option value="3">⭐⭐⭐</option>
        <option value="2">⭐⭐</option>
        <option value="1">⭐</option>
    </select>

    <label>Bình luận:</label>
    <textarea name="comment" placeholder="Cảm nghĩ của bạn..." required></textarea>

    <button type="submit">Gửi đánh giá</button>
</form>
