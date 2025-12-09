<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Dịch Vụ | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/dichvuchitiet.css">
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
            <div class="banner">
                <img src="/duan1/BaseCodePhp1/anhmau/dichvucatoc.076Z.png" alt="">
                <div class="banner-text">
                    <h1><?= htmlspecialchars($category['name']) ?></h1>
                </div>
            </div>
        </header>
    </div>
    <div class="content">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="baocattoc">
                <h2><?= htmlspecialchars($category['name']) ?></h2>
                <p><?= htmlspecialchars($category['description']) ?></p>
                <div class="cattocbo">
                    <div class="cattoc">
                        <div class="infor">
                            <h3><?= htmlspecialchars($service['name']) ?></h3>
                            <p><?= nl2br(htmlspecialchars($service['description'])) ?></p>
                            <div class="baogia">
                                <p class="thoigian">
                                    <i class="fa-regular fa-clock"></i> <?= htmlspecialchars($service['time']) ?>
                                </p>
                                <p class="gia">
                                    <?= number_format($service['price'] ?? 0) ?> VNĐ
                                </p>
                            </div>
                        </div>
                        <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($service['image']) ?>"
                            alt="<?= htmlspecialchars($service['name']) ?>">
                    </div>
                </div>
            </div>
            <!-- phần check người dùng đã có tài khoản chưa -->
            <?php
            $Dangnhap = BASE_URL . '?act=dangnhap_khachhang';
            $isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
            ?>
            <div class="datlich">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= BASE_URL ?>?act=datlich">
                        <button type="button">
                            ĐẶT LỊCH NGAY
                        </button>
                    </a>
                <?php else: ?>
                    <button type="button" onclick="openPopup()">
                        ĐẶT LỊCH NGAY
                    </button>
                <?php endif; ?>
            </div>

            <?php if (!$isLoggedIn): ?>
                <div id="login-popup" class="popup-overlay">
                    <div class="popup-content">
                        <div class="popup-header">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <h3>Thông Báo</h3>
                        </div>
                        <div class="popup-body">
                            <p>Bạn cần <strong>Đăng nhập</strong> hoặc <strong>Đăng ký</strong> tài khoản để thực hiện đặt
                                lịch.</p>
                            <p>Bạn có muốn đi đến trang đăng nhập không?</p>
                        </div>
                        <div class="popup-footer">
                            <a href="<?= BASE_URL ?>?act=dangnhap_khachhang">
                                <button class="btn-confirm">Đăng nhập ngay</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
    <!-- phần hiển thị thông báo -->
    <?php if (!empty($upcomingBooking)):
        // Xử lý ngày giờ để JS đếm ngược
        $fullDateTime = $upcomingBooking['ngay_lam'] . ' ' . $upcomingBooking['gio_lam'] . ':00';
        ?>
        <div class="baothongbao">
            <div class="thongbaocon">
                <div class="hienthithongbao">

                    <div class="reminder-header">
                        Chỉ còn <strong class="text-danger" id="countdown-timer">Đang tính...</strong> là đến lịch
                        hẹn <?= substr($_SESSION['username'], -4) ?>
                    </div>

                    <div class="noidungthongbao">
                        <div class="info-item">
                            <i class="fa-regular fa-calendar-days text-primary"></i>
                            <span>
                                <?php
                                $date = strtotime($upcomingBooking['ngay_lam']);
                                $days = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
                                echo $days[date('w', $date)] . ', ngày ' . date('d.m', $date) . ', ' . $upcomingBooking['gio_lam'];
                                ?>
                            </span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-location-dot text-primary"></i>
                            <span>113 Trần Hưng Đạo, P. Mỹ Bình, Long Xuyên (Salon mẫu)</span>
                        </div>
                        <div class="info-item">
                            <i class="fa-solid fa-user text-primary"></i>
                            <span>Stylist:
                                <strong><?= htmlspecialchars($upcomingBooking['ten_tho']) ?></strong></span>
                        </div>
                    </div>

                    <div class="reminder-footer">
                        <a href="index.php?act=lichsudatchitiet&ma_lich=<?= $upcomingBooking['ma_lich'] ?>"
                            class="btn btn-light btn-sm border">
                            <i class="fa-solid fa-xmark"></i> Hủy lịch
                        </a>

                        <a href="https://maps.google.com" target="_blank" class="btn btn-primary btn-sm"
                            style="background-color: #1d3557;">
                            <i class="fa-solid fa-diamond-turn-right"></i> Chỉ đường Salon
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <script>
            (function () {
                // Thời gian đích (Lấy từ PHP)
                const targetDate = new Date("<?= $fullDateTime ?>").getTime();

                const timer = setInterval(function () {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    if (distance < 0) {
                        clearInterval(timer);
                        document.getElementById("countdown-timer").innerHTML = "Đã đến giờ hẹn!";
                        return;
                    }

                    // Tính toán
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

                    // Hiển thị chuỗi
                    let text = "";
                    if (days > 0) text += days + " ngày ";
                    text += hours + " giờ " + minutes + " phút";

                    document.getElementById("countdown-timer").innerHTML = text;
                }, 1000);
            })();
        </script>
    <?php endif; ?>
    <!-- phần thông báo lý do mà lịch bị huỷ -->
    <?php if (!empty($unreadCancel)): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error', // Icon dấu X đỏ
                    title: 'LỊCH HẸN ĐÃ BỊ HỦY',
                    html: `
                    <div style="text-align: left;">
                        <p>Rất tiếc, lịch hẹn mã <strong>#<?= $unreadCancel['ma_lich'] ?></strong> của anh đã bị hủy.</p>
                        
                        <div style="background: #fff5f5; border-left: 5px solid #dc3545; padding: 15px; margin: 15px 0; border-radius: 5px;">
                            <strong style="color: #dc3545;">Lý do hủy:</strong> <br>
                            <span style="color: #333; font-style: italic;">"<?= htmlspecialchars($unreadCancel['cancel_reason']) ?>"</span>
                        </div>

                        <p style="font-size: 14px; color: #666;">Vui lòng đặt lại lịch mới hoặc liên hệ Hotline để được hỗ trợ.</p>
                    </div>
                `,
                    confirmButtonText: 'Đã hiểu',
                    confirmButtonColor: '#d33',
                    allowOutsideClick: false, // Bắt buộc bấm nút mới tắt
                    width: '500px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gọi AJAX báo cho server biết khách đã đọc
                        fetch('index.php?act=api_read_notify', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'id=<?= $unreadCancel['id'] ?>'
                        });
                    }
                });
            });
        </script>
    <?php endif; ?>
</body>
<script src="<?= BASE_URL ?>public/main.js"></script>


</html>