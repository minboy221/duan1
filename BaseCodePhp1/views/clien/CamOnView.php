<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lịch Thành Công | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/datlichthanhcong.css">
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
                                    <a href="<?= BASE_URL ?>?act=doimatkhau_khachhang">Đổi mật khẩu</a>
                                    <a href="<?= BASE_URL ?>?act=logout">Đăng xuất</a>
                                </div>
                            <?php else: ?>
                                <a href="<?= BASE_URL ?>?act=dangnhap_khachhang">
                                    <button>Đăng Nhập / Đăng Ký</button>
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
            <div class="booking-success-wrapper">
                <div class="booking-container">

                    <div class="success-header">
                        <div class="icon-success">🎉</div>
                        <h2 class="success-title">ĐẶT LỊCH THÀNH CÔNG</h2>
                        <p style="color: #666;">Mã đơn: <strong><?= htmlspecialchars($booking['ma_lich']) ?></strong>
                        </p>
                    </div>

                    <div class="banner-section">
                        <img src="<?= BASE_URL ?>anhmau/240425_banner_success.png" alt="Banner 31Shine"
                            class="promo-banner">
                    </div>

                    <div class="info-card">
                        <div class="salon-address">
                            <i class="fa-solid fa-location-dot" style="color: #D6A354; margin-right: 5px;"></i>
                            113 Trần Hưng Đạo, P. Mỹ Bình, Long Xuyên, An Giang
                        </div>
                        <div class="salon-note">
                            Đối diện khách sạn Hòa Bình và sân vận động
                        </div>

                        <div class="action-group">
                            <button class="btn-gold-action btn-outline">
                                <i class="fa-solid fa-diamond-turn-right"></i> Chỉ đường
                            </button>

                            <a href="tel:0123456789" style="flex: 1; text-decoration: none;">
                                <button class="btn-gold-action btn-fill">
                                    <i class="fa-solid fa-phone"></i> Gọi Salon
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="booking-detail-wrapper">
                        <div class="detail-card">
                            <h3 class="card-title">Chi tiết lịch đặt</h3>

                            <div class="info-section">
                                <p class="label">Dịch vụ</p>
                                <p class="value" style="font-weight: bold;">
                                    <?= htmlspecialchars($booking['ten_dichvu']) ?>

                                </p>
                            </div>

                            <div class="info-section">
                                <p class="label">Thời gian</p>
                                <p class="value">
                                    <?= $booking['gio_lam'] ?> - <?= date('d/m/Y', strtotime($booking['ngay_lam'])) ?>
                                </p>
                            </div>

                            <div class="info-section">
                                <p class="label">Stylist</p>
                                <p class="value">
                                    <?= htmlspecialchars($booking['ten_tho']) ?>
                                </p>
                            </div>

                            <div class="info-section">
                                <p class="label">Tổng tiền cần thanh toán:</p>
                                <p class="price-value" style="color: #d63031; font-weight: bold; font-size: 18px;">
                                    <?= number_format($booking['price'], 0, ',', '.') ?> VNĐ
                                </p>
                            </div>

                            <div class="divider"></div>

                            <div class="parking-info">
                                <p class="label">Thông tin gửi xe</p>
                                <div class="parking-content">
                                    <i class="fa-solid fa-motorcycle"></i>
                                    <span>Gửi xe máy miễn phí tại salon</span>
                                </div>
                            </div>
                        </div>

                        <div class="menu-options">
                            <p class="guide-text"
                                style="font-style: italic; font-size: 13px; color: #666; text-align: center; margin-bottom: 15px;">
                                "Nếu đến muộn quá 10 phút, chúng em xin phép dời lịch để đảm bảo trải nghiệm tốt nhất
                                cho anh."
                            </p>

                            <div class="menu-item"
                                onclick="window.location.href='<?= BASE_URL ?>?act=lichsudatchitiet&ma_lich=<?= $item['ma_lich'] ?>'">

                                <div class="menu-left">
                                    <div class="icon-box">
                                        <i class="fa-solid fa-align-justify"></i>
                                    </div>
                                    <span>Xem Chi Tiết</span>
                                </div>
                                <i class="fa-solid fa-chevron-right menu-arrow"></i>
                            </div>

                            <?php if (in_array($booking['status'], ['pending', 'confirmed'])): ?>
                                <div class="menu-item"
                                    onclick="if(confirm('Anh có chắc muốn hủy lịch không?')) window.location.href='<?= BASE_URL ?>?act=huylich&id=<?= $booking['id'] ?>'">
                                    <div class="menu-left">
                                        <div class="icon-box" style="color: #ff4d4d;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                        <span>Hủy lịch</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-right menu-arrow"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <img src="anhmau/logochinh.424Z-removebg-preview.png" alt="31Shine Logo" class="footer-logo">
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

</html>