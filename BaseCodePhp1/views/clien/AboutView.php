<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
            <div class="banner">
                <img src="/duan1/BaseCodePhp1/anhmau/bannerabout.461Z.png" alt="">
                <div class="banner-text">
                    <h1>Về 31SHINE</h1>
                </div>
            </div>
        </header>
    </div>
    <div class="content">
        <main>
            <div class="noidung">
                <h2>31SHINE - ĐIỂM TỰA CHO VIỆC LỚN</h2><br>
                <p><span>"Hãy cho tôi một điểm tựa, tôi sẽ nâng cả thế giới." - Archimedes</span><br>
                    Mỗi người đàn ông đều có một hành trình riêng, một thế giới muốn chinh phục <br>
                    Có người đang tiến về đích, có người vẫn đang tìm hướng đi <br>
                    Có người biết chính xác điều mình muốn, có người đang từng bước khám phá <br>
                    Dù anh đang ở đâu trên hành trình ấy – bản lĩnh và sự tự tin luôn có trong chính anh <br>
                    31Shine không tạo ra chúng. Chúng tôi là điểm tựa, giúp anh thể hiện trọn vẹn phong thái, khí chất
                    và sẵn sàng cho những điều quan trọng phía trước</p> <br>
                <img src="/duan1/BaseCodePhp1/anhmau/anhabout.383Z.png" alt="ảnh giới thiệu">
                <h2>KIỂU TÓC ĐẸP KHÔNG PHẢI LÀ ĐÍCH ĐẾN - MÀ LÀ ĐIỂM KHỞI ĐẦU</h2><br>
                <p>Một kiểu tóc đẹp không chỉ để ngắm nhìn – mà còn để cảm nhận:<br>
                    Cảm nhận sự thoải mái, tự tin, sẵn sàng<br>
                    Cảm nhận một phiên bản tốt hơn của chính mình<br>
                    ,công nghệ hiện đại và đội ngũ thợ tận tâm, 31Shine không chỉ mang<br>
                    đến một diện mạo mới. Chúng tôi giúp anh luôn trong trạng thái tốt nhất – để đón nhận bất kỳ điều gì
                    đang chờ phía trước</p><br>
                <h2>Ý NGHĨA LOGO VÀ THƯƠNG HIỆU</h2><br>
                <p>31Shine đại diện cho tuổi 30 toả sáng của mỗi người đàn ông - độ tuổi mang ý nghĩa biểu tượng mạnh mẽ
                    nhất đại diện cho ngọn lửa thành công, khát vọng chiến thắng và ý chí vươn lên của bất kỳ người đàn
                    ông hiện đại nào. Tên gọi được thể hiện qua Logo nam nhân tỏa sáng cùng font chữ hiện đại và công
                    nghệ như một sự khẳng định mạnh mẽ cho tinh thần chiến thắng, khát vọng thành công.</p><br>
                <div class="thuonghieu">
                    <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png" alt="">
                </div><br>
                <p>Nhận diện mới của 31Shine nổi bật với màu vàng đen sang trọng hình mẫu người khởi tạo với ý chí
                    không ngừng đổi mới, luôn nhìn ra cơ hội để thay đổi cuộc chơi, phá bỏ quan niệm cũ.
                    Sự lựa chọn của 31Shine là một định vị không hào nhoáng, nhưng chứa đựng mơ ước lớn của doanh nghiệp
                    31Shine là hiện đại hoá ngành tóc ở Việt Nam.</p><br>
                <h2>WILLS - VĂN HOÁ TINH THẦN CỦA NHỮNG NGƯỜI DÁM TIẾN LÊN</h2><br>
                <p>Ở 31Shine, chúng tôi không chỉ tạo ra diện mạo tuyệt vời – chúng tôi phục vụ những người đàn ông muốn
                    tốt hơn mỗi ngày<br>
                    Dù anh đang bắt đầu, bứt phá hay khẳng định chính mình, tinh thần WILLS luôn đồng hành:<br>
                <ul class="noidung2">
                    <li> W - Warrior (Chiến binh) – Kiên cường, không lùi bước trước thử thách</li>
                    <li>I - Intervention (Can thiệp) – Không đợi thời điểm hoàn hảo, mà tạo ra nó</li>
                    <li>L - Learning (Ham học hỏi) – Phát triển không giới hạn, không ngừng nâng cấp bản thân</li>
                    <li>L - Leadership (Đổi mới) – Luôn sáng tạo, chủ động dẫn đầu sự thay đổi</li>
                    <li>S - Sincerity (Chân thành) – Minh bạch, đáng tin cậy, tạo dựng giá trị bền vững</li>
                </ul>
                Không có đúng hay sai – chỉ có phiên bản tốt nhất của chính mình, và 30Shine ở đây để giúp anh tự
                tin thể hiện điều đó</p><br>
                <h2>SỨ MỆNH - TÔN VINH ĐÔI BÀN TAY TÀI HOA NGƯỜI THỢ VIỆT</h2><br>
                <p>31Shine không chỉ là điểm tựa giúp đàn ông thể hiện phong độ, mà còn mang trong mình một sứ mệnh lớn
                    hơn:<br>
                    Tôn vinh và nâng tầm đôi bàn tay tài hoa của người thợ Việt trên bản đồ thế giới<br>
                    Tay nghề con người Việt Nam không chỉ giỏi – mà có thể vươn xa<br>
                    Bằng việc không ngừng đổi mới, nâng cao chất lượng dịch vụ và xây dựng môi trường phát triển chuyên
                    nghiệp, 31Shine giúp người thợ Việt phát triển bản thân, nghề nghiệp và vị thế trong ngành tóc toàn
                    cầu<br>
                    Từ bàn tay Việt – vươn tới những tầm cao mới</p>
            </div>
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