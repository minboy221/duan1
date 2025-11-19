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
                            <input type="text" placeholder="Tìm kiếm dịch vụ,giá dịch vụ...">
                            <button type="submit"><i class="fa fa-arrow-right"></i></button>
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
                                    <a href="#">Lịch sử toả sáng</a>
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
            <form class="baolichdat" action="">
                <div class="lichdat">
                    <h2>Đặt Lịch Giữ Chỗ</h2>
                </div>
                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">1</span>
                        <h3>Địa điểm:</h3>
                    </div>
                    <div class="step-noidung">
                        <button>Số 4 Lê Quang Đạ, Từ Sơn, Bắc Ninh</button>
                    </div>
                </div>
                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">2</span>
                        <h3>Chọn dịch vụ</h3>
                    </div>
                    <div class="chondichvu">
                        <a href="<?= BASE_URL ?>?act=chondichvu">
                            Xem tất cả dịch vụ hấp dẫn
                        </a>
                    </div>
                </div>
                <div class="buoc">
                    <div class="step-header">
                        <span class="step-number">3</span>
                        <h3>Chọn ngày,giờ & stylist</h3>
                    </div>
                    <div class="chontho">
                        <label for=""><i class="fa-solid fa-user"></i>Stylist:</label>
                        <select id="chonstylist">
                            <option value="">--Chọn stylist--</option>
                            <option value="1">Việt Hùng</option>
                            <option value="2">Công Huy</option>
                            <option value="4">31Shine chọn giúp</option>
                        </select>
                        <div class="stylist-list">
                            <div class="baotho">
                                <div class="stylist-card" data-id="1">
                                    <img src="/duan1/BaseCodePhp1/anhmau/tho1.png" alt="fstylist-card">
                                    <p>Việt Hùng</p>
                                </div>
                                <div class="stylist-card" data-id="2">
                                    <img src="/duan1/BaseCodePhp1/anhmau/tho2.png" alt="">
                                    <p>Công Huy</p>
                                </div>
                                <div class="stylist-card" data-id="3">
                                    <img src="/duan1/BaseCodePhp1/anhmau/tho3.png" alt="">
                                    <p>31Shine chọn giúp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chonngay">
                    <div class="step-header">
                        <p><i class="fa-regular fa-calendar"></i>Hôm nay, T3(11/11)</p>
                        <span class="day-type">Ngày thường</span>
                        <div class="select-day">
                            <label for="">Chọn ngày:</label>
                            <select id="chonngay">
                                <option value="">--Chọn Lịch--</option>
                                <option value="">--Chọn Lịch--</option>
                            </select>
                        </div>
                    </div>
                    <!-- khung giờ -->
                    <div class="chontime">
                        <button class="time-btn">8h00</button>
                        <button class="time-btn">8h40</button>
                        <button class="time-btn">9h00</button>
                        <button class="time-btn">8h40</button>
                        <button class="time-btn">10h00</button>
                        <button class="time-btn">10h40</button>
                        <button class="time-btn">11h00</button>
                    </div>
                    <div class="chotgio">
                        <button class="btn-submit">
                            CHỐT GIỜ CẮT
                        </button>
                    </div>
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

</html>