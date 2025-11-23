<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lịch | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/datlich.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
</head>

<body>
    <div class="container">
        <header>
            <div class="mocua">
                <div class="thongtin">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-telephone" viewBox="0 0 16 16">
                        <path
                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                    </svg>
                    <p><span>Liên Hệ:</span> 0123456789</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    <p><span>Thời Gian Mở Cửa:</span> Thứ Hai - Chủ Nhật, 8 am - 9 pm</p>
                </div>
            </div>
            <aside class="aside">
                <div class="logo">
                    <a href="<?= BASE_URL ?>?act=home">
                        <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z-removebg-preview.png" alt="">
                    </a>
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <a href="<?= BASE_URL ?>?act=home">Trang Chủ</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>?act=about">Về 31Shine</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>?act=dichvu">Dịch Vụ</a>
                        </li>
                        <li>
                            <a href="<?= BASE_URL ?>?act=nhanvien">Nhân Viên</a>
                        </li>
                    </ul>
                    <div class="icon">
                        <i class="fa fa-search" id="timkiem"></i>
                        <div class="search-box" id="search-box">
                            <form action="" method="GET">
                                <input type="hidden" name="act" value="search_client">
                                <input type="text" name="keyword" placeholder="Tìm kiếm dịch vụ, giá dịch vụ..."
                                    value="<?= $_GET['keyword'] ?? '' ?>">
                                <button type="submit"><i class="fa fa-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- phần hiển thị các nút cho người dùng khi đã đăng nhập tài khoản -->
                    <div class="dangky">
                        <div class="dropdown">
                            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                                <button class="dropdown-btn">
                                    Xin Chào,<?= htmlspecialchars($_SESSION['username']) ?><i
                                        class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="<?= BASE_URL ?>?act=lichsudat">Lịch sử toả sáng</a>
                                    <a href="<?= BASE_URL ?>?act=logout">Đăng xuất</a>
                                </div>
                            <?php else: ?>
                                <a href="<?= BASE_URL ?>?act=dangnhap_khachhang">
                                    <button>
                                        Đăng Nhập / Đăng Ký
                                    </button>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </aside>
        </header>
    </div>
    <div class="content">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <form class="baolichdat" action="index.php?act=luu_datlich" method="POST"
                onsubmit="return validateBooking()">

                <div class="lichdat">
                    <h2>Đặt Lịch Giữ Chỗ</h2>
                </div>

                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">1</span>
                        <h3>Địa điểm:</h3>
                    </div>
                    <div class="step-noidung">
                        <button type="button">Số 4 Lê Quang Đạo, Từ Sơn, Bắc Ninh</button>
                    </div>
                </div>

                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">2</span>
                        <h3>Dịch vụ đã chọn</h3>
                    </div>
                    <div class="chondichvu">
                        <?php
                        // Kiểm tra xem có dịch vụ nào trong giỏ hàng (Session) chưa
                        if (isset($_SESSION['booking_cart']['services']) && !empty($_SESSION['booking_cart']['services'])):
                            $totalMoney = 0;
                            ?>
                            <ul style="list-style: none; padding: 0;">
                                <?php foreach ($_SESSION['booking_cart']['services'] as $sv):
                                    $totalMoney += $sv['price'];
                                    ?>
                                    <li
                                        style="display: flex; justify-content: space-between; padding: 5px 0; border-bottom: 1px dashed #ddd;">
                                        <span><?= htmlspecialchars($sv['name']) ?></span>
                                        <span style="font-weight: bold;"><?= number_format($sv['price']) ?>đ</span>
                                        <a href="index.php?act=remove_service&id=<?= $sv['id'] ?>"
                                            style="color:red; margin-left:10px; font-size:14px;">
                                            Xóa
                                        </a>

                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <p style="text-align: right; margin-top: 10px; font-size: 18px; color: #d63031;">
                                Tổng tạm tính: <strong><?= number_format($totalMoney) ?> VNĐ</strong>
                            </p>
                        <?php else: ?>
                            <p>Bạn chưa chọn dịch vụ nào.</p>
                        <?php endif; ?>

                        <a href="index.php?act=chondichvu"
                            style="display: block; margin-top: 10px; text-align: center; color: #007bff;">
                            <i class="fa fa-plus-circle"></i> Chọn thêm dịch vụ khác
                        </a>
                    </div>
                </div>

                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">3</span>
                        <h3>Chọn ngày, giờ & stylist</h3>
                    </div>

                    <div class="chonngay">
                        <label class="fw-bold"><i class="fa-regular fa-calendar"></i> Chọn ngày:</label>
                        <select id="chonngay" name="ngay_id" onchange="loadStylists()" class="form-select" required>
                            <option value="">-- Chọn ngày bạn đến --</option>
                            <?php foreach ($listDays as $day): ?>
                                <option value="<?= $day['id'] ?>">
                                    <?= date('d/m/Y', strtotime($day['date'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="chontho" id="step-stylist" style="display:none; margin-top: 15px;">
                        <label class="fw-bold"><i class="fa-solid fa-user"></i> Chọn Stylist:</label>

                        <div class="stylist-list" id="stylist-container"
                            style="display: flex; gap: 10px; flex-wrap: wrap;">
                        </div>

                        <input type="hidden" name="tho_id" id="selected_tho_id" required>
                    </div>

                    <div class="chonngay" id="step-time" style="display:none; margin-top: 15px;">
                        <label class="fw-bold"><i class="fa-regular fa-clock"></i> Chọn giờ:</label>
                        <div class="chontime" id="time-container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        </div>
                        <input type="hidden" name="khunggio_id" id="selected_time_id" required>
                    </div>
                </div>
                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">4</span>
                        <h3>Ghi Chú (Nếu có):</h3>
                    </div>
                    <div class="step-noidung">
                        <textarea name="note" rows="3"
                            placeholder="Ví dụ: Tôi muốn nhuộm màu khói, xin tư vấn kiểu tóc..."
                            style="width: 100%; padding: 15px; border-radius: 8px; border: 1px solid #ddd; font-family: inherit; resize: vertical;"></textarea>
                    </div>
                </div>
                <div class="chotgio" style="margin-top: 30px; text-align: center;">
                    <button type="submit" class="btn-submit"
                        style="padding: 15px 40px; background: #D6A354; color: white; border: none; border-radius: 5px; font-weight: bold; font-size: 16px; cursor: pointer;">
                        CHỐT GIỜ CẮT
                    </button>
                </div>
            </form>
        </main>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z-removebg-preview.png" alt="31Shine Logo"
                    class="footer-logo">
                <p>31Shine – Hệ thống salon nam hiện đại hàng đầu Việt Nam. Chúng tôi giúp bạn luôn tự tin và phong độ
                    mỗi ngày.</p>
            </div>
            <div class="footer-column">
                <h3>Liên kết nhanh</h3>
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Dịch vụ</a></li>
                    <li><a href="#">Thợ cắt tóc</a></li>
                    <li><a href="#">Đặt lịch</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Liên hệ</h3>
                <p><i class="fa-solid fa-location-dot"></i> 123 Nguyễn Trãi, Hà Nội</p>
                <p><i class="fa-solid fa-phone"></i> 0909 123 456</p>
                <p><i class="fa-solid fa-envelope"></i> support@31shine.vn</p>

                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2025 31Shine. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
</body>
<script src="<?= BASE_URL ?>public/main.js"></script>
<script>
    // HÀM LOAD THỢ
    function loadStylists() {
        // 1. Lấy ID ngày từ thẻ select có id="chonngay"
        let ngayId = document.getElementById('chonngay').value;

        let container = document.getElementById('stylist-container');
        let stepStylist = document.getElementById('step-stylist');
        let stepTime = document.getElementById('step-time');

        // Reset giao diện
        stepTime.style.display = 'none';
        document.getElementById('selected_tho_id').value = '';
        container.innerHTML = 'Loading...';

        if (!ngayId) {
            stepStylist.style.display = 'none';
            return;
        }

        // Hiện khung chọn thợ
        stepStylist.style.display = 'block';

        // 2. Gọi API (Kiểm tra kỹ đường dẫn index.php?act=api_get_stylist)
        fetch(`index.php?act=api_get_stylist&ngay_id=${ngayId}`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = ''; // Xóa chữ loading

                if (data.length > 0) {
                    // Có thợ -> Vẽ ra màn hình
                    data.forEach(tho => {
                        let html = `
                            <div class="stylist-card" onclick="loadTimes(${tho.phan_cong_id}, ${tho.tho_id}, this)" 
                                 style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; cursor: pointer; text-align: center; width: 100px;">
                                <img src="./anhtho/${tho.image}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" onerror="this.src='./anhmau/default-avatar.png'">
                                <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 13px;">${tho.name}</p>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', html);
                    });
                } else {
                    // Không có thợ
                    container.innerHTML = '<p style="color: red;">Ngày này chưa có thợ làm việc.</p>';
                }
            })
            .catch(err => {
                console.error(err);
                container.innerHTML = '<p style="color: red;">Lỗi kết nối API.</p>';
            });
    }

    // HÀM LOAD GIỜ (Giữ nguyên logic cũ)
    function loadTimes(phanCongId, thoId, element) {
        // Highlight thợ
        document.querySelectorAll('.stylist-card').forEach(el => {
            el.style.borderColor = '#ddd';
            el.style.backgroundColor = '#fff';
        });
        element.style.borderColor = '#D6A354';
        element.style.backgroundColor = '#fff8e1';

        document.getElementById('selected_tho_id').value = thoId;

        let container = document.getElementById('time-container');
        let stepTime = document.getElementById('step-time');
        stepTime.style.display = 'block';
        container.innerHTML = 'Loading...';

        fetch(`index.php?act=api_get_time&phan_cong_id=${phanCongId}`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(slot => {
                        let disabled = slot.is_booked ? 'disabled style="background:#ccc; cursor:not-allowed"' : 'onclick="selectTime(' + slot.id + ', this)" style="cursor:pointer; background:#fff; border:1px solid #333"';
                        let btn = `<button type="button" ${disabled} class="time-btn" style="padding: 5px 10px; margin: 5px;">${slot.time}</button>`;
                        container.insertAdjacentHTML('beforeend', btn);
                    });
                } else {
                    container.innerHTML = '<p>Thợ này chưa có lịch giờ.</p>';
                }
            });
    }

    function selectTime(id, btn) {
        document.querySelectorAll('.time-btn').forEach(b => {
            if (!b.disabled) b.style.background = '#fff';
        });
        btn.style.background = '#D6A354'; // Màu đã chọn
        document.getElementById('selected_time_id').value = id;
    }

    function validateBooking() {
        if (!document.getElementById('selected_time_id').value) {
            alert("Vui lòng chọn giờ!");
            return false;
        }
        return true;
    }
</script>

</html>