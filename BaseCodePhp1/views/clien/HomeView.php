<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">
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
                <img src="/duan1/BaseCodePhp1/anhmau/banner.png" alt="">
                <div class="banner-text">
                    <h1>BARBERS & HAIR CUTTING</h1>
                    <p>Dịch vụ tạo kiểu tóc chuyên nghiệp 31SHINE, phong cách hiện đại, mang lại sự tự tin và cá tính
                        cho bạn.</p>
                    <a href="<?= BASE_URL ?>?act=dichvu">
                        <button class="btn">DỊCH VỤ CỦA CHÚNG TÔI</button>
                    </a>
                </div>
            </div>
        </header>
    </div>
    <div class="content">
        <main>
            <div class="background"></div>
            <div class="cacdichvu">
                <div class="bentrai">
                    <img src="/duan1/BaseCodePhp1/anhmau/anh2.539Z.png" alt="">
                </div>
                <div class="benphai">
                    <div class="noidung">
                        <h3>Chúng Tôi Làm Những Gì?</h3>
                        <p>Dịch vụ tạo kiểu tóc chuyên nghiệp 31SHINE, phong cách hiện đại, mang lại sự tự tin và cá
                            tính cho bạn.</p>
                    </div>
                    <div class="baodichvu">
                        <div class="dichvu">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="512.000000pt"
                                    height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                                    preserveAspectRatio="xMidYMid meet">

                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                        stroke="none">
                                        <path
                                            d="M3412 4077 l-813 -1042 -112 -67 c-104 -62 -1173 -568 -1200 -568 -7 0 -18 9 -24 19 -18 29 -121 105 -190 140 -84 42 -169 61 -278 61 -174 0 -312 -57 -435 -179 -132 -130 -198 -301 -187 -482 17 -273 202 -496 472 -570 67 -18 97 -21 185 -16 195 10 354 92 466 240 128 169 165 386 100 581 -14 39 -23 71 -23 71 1 1 70 33 153 72 147 69 162 73 513 158 199 49 364 85 367 82 6 -6 -12 -85 -111 -487 -58 -235 -68 -267 -133 -401 l-70 -146 -70 23 c-294 99 -626 -42 -758 -321 -46 -97 -64 -174 -64 -275 0 -280 177 -516 451 -603 14 -5 12 -26 -24 -182 -22 -96 -38 -177 -36 -179 2 -2 45 3 96 12 106 18 96 2 113 172 16 158 11 148 78 155 257 28 451 179 542 420 16 44 24 90 27 170 6 124 -7 197 -57 303 -31 67 -110 175 -141 195 -10 6 -19 18 -19 24 0 28 505 1095 568 1200 l66 113 1041 812 c572 446 1041 812 1043 814 2 1 -2 14 -10 28 l-13 26 -815 -495 c-447 -272 -815 -493 -817 -491 -2 1 219 369 491 817 480 790 494 814 473 826 -12 7 -24 12 -27 12 -3 0 -371 -469 -818 -1042z m-596 -1093 c28 -29 34 -43 34 -79 0 -37 -6 -50 -35 -80 -30 -29 -43 -35 -80 -35 -36 0 -50 6 -79 34 -31 29 -36 39 -36 81 0 40 5 52 34 81 29 29 41 34 81 34 42 0 52 -5 81 -36z m-1946 -524 c169 -27 316 -149 371 -309 84 -242 -38 -499 -281 -595 -61 -24 -206 -33 -267 -16 -99 28 -155 60 -222 128 -151 153 -182 352 -85 549 67 138 228 239 399 251 11 1 49 -3 85 -8z m1118 -1050 c256 -99 378 -391 264 -633 -123 -261 -436 -355 -677 -202 -73 46 -149 136 -181 214 -36 87 -44 221 -19 307 45 157 172 283 335 330 64 19 210 11 278 -16z" />
                                        <path
                                            d="M1070 4659 c-30 -12 -875 -852 -896 -891 -8 -15 -14 -42 -14 -61 0 -62 56 -85 123 -51 18 9 170 154 339 322 l307 305 53 4 c37 3 59 -1 73 -12 18 -15 3 -32 -343 -378 -233 -234 -362 -370 -362 -383 0 -26 19 -44 44 -44 14 0 144 123 386 365 l366 365 34 -35 34 -35 -367 -368 c-202 -202 -367 -374 -367 -383 0 -21 20 -39 45 -39 13 0 140 120 380 360 198 198 365 360 371 360 5 0 23 -14 39 -30 l29 -30 -367 -368 c-202 -202 -367 -374 -367 -383 0 -21 20 -39 45 -39 13 0 140 120 380 360 198 198 365 360 371 360 5 0 23 -14 39 -30 l29 -30 -367 -368 c-202 -202 -367 -373 -367 -380 0 -21 38 -52 57 -45 10 3 181 168 380 367 l363 361 32 -33 33 -32 -361 -363 c-199 -199 -364 -370 -367 -380 -7 -19 24 -57 45 -57 7 0 178 165 380 367 l368 368 32 -33 33 -32 -363 -363 c-296 -296 -362 -368 -362 -389 0 -25 23 -48 47 -48 4 0 173 165 375 367 l368 367 30 -29 c16 -16 30 -34 30 -39 0 -6 -162 -173 -360 -371 -240 -240 -360 -367 -360 -380 0 -25 18 -45 39 -45 9 0 181 165 383 367 l367 367 31 -29 c16 -16 30 -34 30 -39 0 -6 -162 -173 -360 -371 -240 -240 -360 -367 -360 -380 0 -25 18 -45 39 -45 9 0 181 165 383 367 l368 367 35 -34 35 -34 -307 -309 -308 -308 80 37 c44 20 98 45 120 55 25 11 120 99 260 238 l219 221 33 -32 33 -32 -127 -129 c-139 -140 -140 -138 27 -59 52 24 100 56 124 81 35 36 42 39 55 27 14 -12 28 -7 109 42 70 41 104 70 137 112 l44 57 -717 716 c-401 400 -729 721 -745 727 -34 12 -64 12 -97 -1z" />
                                        <path
                                            d="M2989 2755 c-44 -34 -71 -68 -120 -152 -65 -109 -243 -482 -235 -490 2 -3 37 6 78 20 40 13 100 27 133 31 54 6 67 4 124 -24 232 -111 455 -394 688 -870 256 -525 301 -610 375 -707 76 -100 199 -133 369 -99 254 51 559 261 559 385 0 34 -42 78 -957 993 l-958 957 -56 -44z" />
                                        <path
                                            d="M2185 2440 l-70 -19 -162 -164 c-159 -160 -178 -188 -151 -215 29 -29 55 -10 268 203 118 118 208 215 200 214 -8 0 -46 -9 -85 -19z" />
                                        <path
                                            d="M1850 2358 c-65 -17 -82 -26 -128 -71 -57 -56 -72 -88 -52 -112 27 -32 54 -16 165 95 60 61 105 110 100 109 -6 0 -44 -10 -85 -21z" />
                                        <path
                                            d="M2108 2092 c-130 -134 -155 -180 -127 -230 31 -56 145 -52 168 6 15 38 82 324 78 335 -1 5 -55 -45 -119 -111z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="thongtindichvu">
                                <h2>Cắt Tóc</h2>
                                <p>Trải nghiệm cắt tóc phong cách dành riêng cho phái mạnh, vừa tiện lợi vừa thư
                                    giãn
                                    tại
                                    đây
                                </p>
                            </div>
                        </div>
                        <div class="dichvu">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" version="1.0" width="512.000000pt"
                                    height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                                    preserveAspectRatio="xMidYMid meet">

                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                        stroke="none">
                                        <path
                                            d="M4055 5101 c-43 -21 -602 -529 -623 -567 -16 -30 -6 -70 21 -89 51 -36 60 -29 367 253 161 147 300 267 309 267 51 0 -3 -64 -694 -815 -390 -424 -720 -786 -732 -803 -41 -57 -32 -91 54 -196 103 -126 120 -311 42 -463 -12 -23 -66 -87 -120 -142 l-98 -101 -476 475 -475 475 93 93 c69 70 110 102 163 128 158 79 324 58 468 -59 77 -62 99 -71 142 -57 37 12 820 725 842 766 16 30 6 70 -21 89 -51 36 -55 33 -461 -340 l-387 -355 -42 34 c-96 78 -213 117 -352 117 -199 0 -319 -64 -533 -285 -100 -103 -110 -127 -72 -176 l19 -25 -264 -265 -265 -266 0 -47 c0 -27 6 -60 14 -75 8 -15 98 -110 200 -212 l186 -185 0 -281 c0 -280 0 -281 23 -302 29 -27 67 -28 98 -3 24 19 24 22 27 227 l3 207 158 -156 c143 -143 161 -157 193 -157 43 0 71 28 71 71 0 27 -48 79 -411 442 l-412 412 243 243 242 242 55 -55 54 -55 -87 -89 c-91 -93 -102 -116 -72 -158 19 -26 59 -37 88 -22 12 6 57 46 100 87 l77 77 67 -68 68 -67 -77 -77 c-42 -43 -82 -90 -87 -105 -20 -52 15 -98 74 -98 19 0 49 23 113 85 l88 84 67 -67 66 -66 -84 -87 c-70 -71 -85 -92 -85 -118 0 -41 31 -71 72 -71 27 0 46 14 118 85 l86 85 54 -55 54 -55 -176 -177 c-96 -98 -179 -188 -182 -200 -8 -26 16 -78 39 -87 44 -16 62 -3 241 175 180 179 182 181 205 165 13 -9 37 -16 54 -16 27 0 51 20 176 147 115 117 151 162 177 214 104 215 76 437 -82 644 -6 9 205 245 689 771 383 417 711 777 727 799 27 36 29 46 26 105 -4 79 -31 123 -92 151 -52 24 -100 24 -151 0z" />
                                        <path
                                            d="M2294 1939 c-18 -20 -19 -43 -22 -332 -3 -302 -4 -313 -24 -334 -26 -28 -68 -30 -99 -4 -22 18 -24 28 -30 143 -6 134 -15 162 -71 218 -87 87 -235 84 -319 -7 -60 -64 -64 -80 -67 -308 -1 -115 -5 -220 -8 -233 -11 -50 -109 -59 -134 -12 -6 10 -10 97 -10 193 0 97 -5 187 -11 205 -13 37 -54 57 -90 43 -50 -18 -51 -24 -47 -260 l3 -219 30 -44 c38 -54 82 -84 143 -97 92 -19 180 17 237 97 l30 44 5 234 c5 224 6 234 27 255 31 32 80 30 110 -5 21 -24 23 -37 23 -124 0 -121 11 -162 58 -214 73 -81 174 -100 270 -52 70 35 110 93 123 178 6 35 9 187 7 339 -3 254 -4 277 -22 296 -26 29 -86 29 -112 0z" />
                                        <path
                                            d="M841 781 c-11 -11 -23 -36 -27 -57 -8 -44 3 -221 18 -284 37 -158 158 -306 308 -378 47 -22 112 -45 144 -51 38 -7 274 -11 650 -11 650 0 669 2 793 61 94 44 216 167 262 263 38 81 61 176 61 264 l0 62 84 0 c92 0 141 13 156 40 17 31 11 65 -13 88 l-23 22 -1197 0 c-1172 0 -1197 0 -1216 -19z m2056 -208 c-4 -43 -13 -101 -21 -128 -33 -108 -140 -221 -253 -266 l-58 -24 -600 -3 c-683 -3 -694 -2 -802 68 -129 85 -202 228 -203 403 l0 27 971 0 972 0 -6 -77z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="thongtindichvu">
                                <h2>Thay đổi màu tóc</h2>
                                <p>Màu tóc giúp định hình phong cách và thay đổi diện mạo một cách đột phá mà bất cứ
                                    ai
                                    cũng
                                    nên thử.
                                </p>
                            </div>
                        </div>
                        <div class="dichvu">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" version="1.0" width="512.000000pt"
                                    height="512.000000pt" viewBox="0 0 512.000000 512.000000"
                                    preserveAspectRatio="xMidYMid meet" class="__web-inspector-hide-shortcut__">

                                    <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)"
                                        stroke="none">
                                        <path
                                            d="M1950 5114 c-205 -40 -433 -142 -687 -306 -167 -108 -278 -257 -323 -434 -25 -95 -27 -254 -5 -338 14 -55 14 -60 -2 -80 -10 -12 -19 -23 -21 -25 -1 -3 -55 48 -120 111 -70 70 -129 119 -146 124 -41 10 -80 -22 -84 -71 -3 -37 0 -41 376 -419 360 -362 381 -385 416 -458 20 -42 43 -107 51 -145 7 -37 23 -254 35 -481 l22 -413 -27 -54 c-28 -58 -78 -96 -142 -110 -28 -6 -33 -4 -37 17 -3 13 -16 218 -30 456 -19 335 -28 439 -40 457 -27 41 -91 38 -120 -7 -13 -21 -12 -73 13 -488 22 -369 31 -471 44 -495 8 -16 92 -106 186 -199 147 -147 174 -169 201 -169 41 0 73 32 73 73 0 26 -16 47 -96 128 l-96 97 51 30 c86 51 148 145 163 245 6 40 -27 759 -40 870 -5 43 -2 50 59 135 254 353 534 588 858 720 l81 33 80 -29 c311 -115 579 -339 837 -699 77 -108 81 -116 76 -155 -3 -22 -8 -99 -12 -171 -6 -125 -6 -132 15 -153 30 -30 84 -28 109 4 16 21 21 48 27 157 9 170 25 250 71 346 35 75 54 95 695 738 579 580 659 664 659 690 0 43 -32 74 -78 74 -35 0 -55 -18 -434 -397 -218 -218 -399 -395 -400 -392 -2 2 -11 13 -21 25 -16 20 -16 25 -2 80 22 84 20 243 -5 338 -27 106 -92 227 -165 305 -59 63 -246 196 -293 208 -31 8 -70 -11 -83 -41 -23 -49 -5 -71 114 -149 128 -84 191 -149 241 -248 44 -88 58 -154 54 -263 l-3 -87 -213 161 c-145 109 -220 160 -237 160 -49 0 -87 -58 -69 -104 4 -9 116 -100 251 -202 173 -132 256 -202 285 -240 l41 -54 -199 -203 c-142 -144 -209 -220 -234 -265 -19 -34 -39 -69 -45 -77 -8 -12 -26 7 -85 87 -104 140 -303 344 -428 438 -115 86 -251 165 -357 206 -38 15 -74 30 -78 34 -4 4 7 49 24 101 25 72 33 116 37 191 5 116 -5 153 -82 292 -61 110 -71 157 -53 236 l12 55 80 17 c230 49 436 48 584 -1 115 -39 143 -39 170 -5 28 36 26 60 -6 93 -31 30 -155 73 -268 92 -119 20 -382 0 -565 -44 -35 -8 -66 -10 -85 -5 -129 36 -489 69 -575 52z m400 -170 c52 -9 98 -19 102 -23 4 -3 2 -37 -4 -74 -15 -93 5 -172 80 -302 54 -94 57 -104 61 -177 2 -58 -2 -95 -18 -146 -31 -103 -60 -162 -84 -172 -207 -84 -337 -156 -484 -268 -150 -114 -324 -292 -453 -465 -49 -66 -42 -69 -100 35 -25 44 -94 122 -234 265 l-198 203 40 53 c29 38 112 109 285 240 135 103 247 194 251 202 18 47 -20 105 -69 105 -17 0 -92 -51 -238 -161 l-212 -161 -3 88 c-2 48 2 111 8 141 16 74 72 182 128 244 114 127 523 344 733 389 61 13 295 4 409 -16z" />
                                        <path
                                            d="M20 4698 c-11 -12 -20 -35 -20 -52 0 -25 27 -56 173 -203 170 -171 174 -174 212 -171 49 4 81 42 71 85 -5 18 -67 88 -174 196 -156 156 -170 167 -204 167 -25 0 -44 -7 -58 -22z" />
                                        <path
                                            d="M21 3394 c-43 -55 -39 -60 228 -329 137 -137 256 -264 265 -282 10 -19 33 -165 61 -380 48 -373 62 -443 102 -513 34 -59 805 -835 857 -862 56 -29 141 -35 204 -14 58 20 126 80 148 132 8 19 17 34 19 34 3 0 28 -17 55 -37 l50 -37 0 -172 c0 -160 -2 -174 -23 -215 -13 -24 -42 -57 -64 -72 -37 -27 -69 -33 -435 -93 -268 -43 -417 -71 -461 -88 -130 -49 -246 -141 -321 -255 -61 -93 -75 -134 -55 -169 19 -34 60 -49 93 -34 14 6 38 37 58 74 47 89 139 178 229 222 81 38 88 40 564 116 264 43 319 55 371 80 73 36 126 91 163 169 23 50 26 70 29 194 2 76 7 137 10 135 4 -2 34 -17 67 -34 33 -17 94 -44 135 -60 66 -25 88 -28 190 -28 102 0 124 3 190 28 41 16 102 43 135 60 33 17 63 32 67 34 3 2 8 -59 10 -135 3 -133 4 -141 36 -205 18 -36 51 -83 73 -103 77 -69 116 -80 519 -145 445 -72 407 -64 499 -107 90 -43 182 -131 229 -221 20 -37 44 -68 58 -74 33 -15 74 0 93 34 13 23 14 32 2 65 -36 99 -135 218 -242 288 -114 76 -166 90 -597 160 -365 59 -399 66 -435 92 -22 15 -51 48 -64 72 -21 41 -23 55 -23 215 l0 172 50 37 c27 20 52 37 55 37 2 0 11 -15 19 -34 22 -52 90 -112 148 -132 60 -20 147 -15 199 11 48 24 803 777 849 847 21 32 45 86 54 120 9 35 36 218 61 408 24 190 49 359 55 375 6 17 126 145 266 286 272 274 276 279 233 333 -14 18 -30 26 -53 26 -28 0 -60 -28 -298 -267 -239 -242 -267 -274 -286 -324 -14 -38 -35 -166 -62 -375 -50 -391 -56 -428 -82 -478 -22 -45 -754 -788 -800 -812 -46 -24 -86 -18 -124 20 -38 38 -44 78 -20 124 8 15 148 160 311 322 163 162 304 309 312 325 13 24 22 126 44 495 25 415 26 467 13 488 -29 45 -93 48 -120 7 -12 -18 -21 -122 -40 -457 -14 -238 -27 -443 -30 -456 -4 -21 -9 -23 -37 -17 -57 12 -108 48 -135 95 -26 44 -27 49 -25 186 2 129 1 142 -18 162 -26 29 -81 29 -108 1 -16 -17 -20 -42 -26 -147 -11 -212 28 -309 157 -392 l57 -37 -252 -250 c-259 -256 -356 -340 -511 -445 -170 -114 -301 -168 -408 -168 -150 0 -385 130 -654 362 -62 54 -124 100 -138 104 -20 5 -32 -1 -57 -25 -36 -36 -34 -68 5 -111 58 -62 62 -116 12 -166 -38 -38 -78 -44 -124 -20 -46 24 -778 767 -800 812 -26 50 -32 87 -82 478 -27 209 -48 337 -62 375 -19 50 -47 82 -286 324 -238 239 -270 267 -298 267 -23 0 -39 -8 -53 -26z" />
                                        <path
                                            d="M1925 3059 c-98 -19 -200 -53 -222 -72 -31 -28 -30 -77 1 -106 28 -27 37 -26 166 10 124 35 260 33 351 -4 36 -15 74 -27 85 -27 44 1 79 56 62 99 -12 35 -33 48 -123 77 -90 29 -236 40 -320 23z" />
                                        <path
                                            d="M2945 3056 c-115 -27 -176 -55 -190 -89 -21 -49 11 -106 59 -107 11 0 49 12 85 27 91 37 227 39 351 4 129 -36 138 -37 166 -10 31 29 32 78 2 107 -59 55 -349 97 -473 68z" />
                                        <path
                                            d="M1753 2580 c-46 -19 -56 -74 -20 -114 29 -34 154 -66 257 -66 103 0 228 32 258 66 36 41 28 85 -19 109 -26 14 -36 13 -101 -5 -86 -24 -183 -26 -258 -5 -90 24 -94 25 -117 15z" />
                                        <path
                                            d="M2895 2578 c-50 -27 -58 -72 -22 -112 29 -34 154 -66 257 -66 103 0 228 32 258 66 37 42 26 92 -25 113 -23 9 -37 8 -73 -5 -77 -27 -203 -30 -293 -5 -42 11 -78 21 -80 21 -1 0 -11 -6 -22 -12z" />
                                        <path
                                            d="M2327 2088 c-38 -30 -38 -95 1 -124 27 -21 145 -44 219 -44 87 0 191 25 220 52 30 28 31 80 1 108 -26 24 -46 25 -112 5 -27 -8 -77 -15 -111 -15 -34 0 -84 7 -111 15 -60 18 -85 19 -107 3z" />
                                        <path
                                            d="M2203 1689 c-24 -9 -53 -46 -53 -70 0 -30 40 -67 90 -84 62 -21 175 -21 246 0 49 14 59 14 110 -1 108 -31 265 -13 309 37 22 23 24 71 5 95 -25 29 -58 35 -98 18 -51 -21 -116 -21 -200 1 -62 16 -78 17 -124 6 -125 -31 -146 -31 -233 -3 -17 5 -40 6 -52 1z" />
                                    </g>
                                </svg>
                            </div>
                            <div class="thongtindichvu">
                                <h2>Thư giãn và chăm sóc da</h2>
                                <p>Nơi đàn ông không chỉ cắt tóc mà còn tận hưởng gội đầu & thư giãn đầy sảng khoái
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- phần gới thiệu -->
        <div class="baogioithieu">
            <div class="noidunggiua">
                <h3>31Shine - Điểm Tựa Cho Việc Lớn</h3>
                <p>"Hãy cho tôi một điểm tựa, tôi sẽ nâng cả thế giới." - Archimedes
                    Mỗi người đàn ông đều có một hành trình riêng, một thế giới muốn chinh phục
                    Có người đang tiến về đích, có người vẫn đang tìm hướng đi
                    Có người biết chính xác điều mình muốn, có người đang từng bước khám phá</p>
                <div class="chuky">
                    <img src="/duan1/BaseCodePhp1/anhmau/chuky.png" alt="">
                </div>
            </div>
            <div class="benphai">
                <img src="/duan1/BaseCodePhp1/anhmau/anhgioithieu2.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="gioithieu2">
        <div class="background2">
            <img src="/duan1/BaseCodePhp1/anhmau/background2.png" alt="">
        </div>
        <div class="baothongtin">
            <div class="tieude">
                <h2>BẠN ĐÃ SẴN SÀNG NHẬN DỊCH VỤ CỦA CHÚNG TÔI ?</h2>
            </div>
            <a href="<?= BASE_URL ?>?act=dichvu">
                <button>Đặt Lịch</button>
            </a>
        </div>
    </div>
    <!-- phần báo giá và dịch vụ -->
    <div class="phanbaogia">
        <div class="background3">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <div class="titlenoidung">
            <h2>DỊCH VỤ CHÚNG TÔI CUNG CẤP</h2>
            <p>31Shine không tạo ra chúng. Chúng tôi là điểm tựa, giúp anh thể hiện trọn vẹn phong thái, khí chất và
                sẵn
                sàng cho những điều quan trọng phía trước.
            </p>
        </div>
        <?php
        if (!empty($categoriesWithServices)):
            foreach ($categoriesWithServices as $category):
                // if (!empty($category['services'])): 
                ?>
                <div class="baodichvubaogia">
                    <div class="baocattoc">
                        <h2><?= htmlspecialchars($category['name']) ?></h2>
                        <div class="cattocbo">
                            <?php foreach ($category['services'] as $p): ?>
                                <div class="cattoccon">
                                    <a href="index.php?act=chitietdichvu&id=<?= $p['id'] ?>">
                                        <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($p['image']) ?>"
                                            alt="<?= htmlspecialchars($p['name']) ?>">
                                    </a>
                                    <div class="infor">
                                        <h4><?= htmlspecialchars($p['name']) ?></h4>
                                        <div class="baogia">
                                            <p class="gia">
                                                Giá Chỉ Từ <span><?= number_format($p['price'] ?? 0) ?></span>
                                            </p>
                                            <a href="index.php?act=chitietdichvu&id=<?= $p['id'] ?>">Tìm Hiểu Thêm </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
        endif;
        ?>
    </div>
    <!-- top những thợ cắt tóc -->
    <div class="baotoptho">
        <div class="titlenoidung1">
            <h2>GẶP GỠ NHỮNG THỢ CẮT TÓC ƯNG Ý <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                    fill="#f5c542" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                </svg></h2>
            <p>Đội ngũ dày dặn kinh nghiệm trong việc chăm sóc tóc của bạn.</p>
        </div>
        <div class="baothocattoc">
            <div class="tho">
                <img src="/duan1/BaseCodePhp1/anhmau/tho1.png" alt="">
                <div class="infotho">
                    <div class="ten">
                        <p>Việt Hùng</p>
                    </div>
                </div>
            </div>
            <div class="tho">
                <img src="/duan1/BaseCodePhp1/anhmau/tho2.png" alt="">
                <div class="ten">
                    <p>Mạnh Dũng</p>
                </div>
            </div>
            <div class="tho">
                <img src="/duan1/BaseCodePhp1/anhmau/tho3.png" alt="">
                <div class="ten">
                    <p>Công Huy</p>
                </div>
            </div>
            <div class="tho">
                <img src="/duan1/BaseCodePhp1/anhmau/tho4.png" alt="">
                <div class="ten">
                    <p>Nhật Minh</p>
                </div>
            </div>
        </div>
        <div class="xemthem">
            <a href="<?= BASE_URL ?>?act=nhanvien">
                <button>Xem Thêm</button>
            </a>
        </div>
    </div>
    <!-- PHẦN CHAT AI -->
    <div class="chat-launcher" onclick="toggleChat()">
        <div class="launcher-icon">
            <i class="fa-solid fa-comment-dots"></i>
        </div>
        <span class="chat-tooltip">Hỗ trợ trực tuyến</span>
    </div>

    <div class="chat-window" id="chatBox">

        <div class="chat-header">
            <div class="header-info">
                <div class="avatar-bot">
                    <img src="./anhmau/thonu2.493Z.png" alt="Bot"
                        onerror="this.src='https://cdn-icons-png.flaticon.com/512/4712/4712027.png'">
                    <span class="status-dot"></span>
                </div>
                <div class="header-text">
                    <h3>Trợ lý 31Shine</h3>
                    <p>Luôn sẵn sàng hỗ trợ</p>
                </div>
            </div>
            <div class="header-actions">
                <i class="fa-solid fa-xmark close-btn" onclick="toggleChat()"></i>
            </div>
        </div>

        <div class="chat-content" id="chatContent">
            <div class="msg-row bot-row">
                <img class="msg-avatar" src="./anhmau/thonu2.493Z.png"
                    onerror="this.src='https://cdn-icons-png.flaticon.com/512/4712/4712027.png'">
                <div class="msg-bubble bot">
                    Xin chào anh! Em là trợ lý ảo. Em có thể giúp anh đặt lịch, tra cứu giá hoặc tìm địa chỉ salon ạ?
                </div>
            </div>
        </div>

        <div class="chat-footer">
            <div class="input-group">
                <input type="text" id="msgInput" placeholder="Nhập tin nhắn..." onkeypress="handleEnter(event)">
                <button onclick="sendMsg()" id="sendBtn">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
            <div class="footer-note">Được phát triển bởi 31Shine AI</div>
        </div>
    </div>
    <script>
        // 1. Bật tắt Chat
        function toggleChat() {
            const box = document.getElementById('chatBox');

            if (box.classList.contains('active')) {
                box.classList.remove('active');
                setTimeout(() => { box.style.display = 'none'; }, 300); // Đợi animation xong mới ẩn
            } else {
                box.style.display = 'flex';
                // Dùng setTimeout nhỏ để animation chạy mượt
                setTimeout(() => { box.classList.add('active'); }, 10);
                loadHistory();
            }
        }

        // 2. Hiển thị tin nhắn
        function renderMessage(msg, type) {
            const container = document.getElementById('chatContent');

            // Chọn avatar tương ứng
            let avatar = type === 'bot' ? './anhmau/logotron.png' : 'https://cdn-icons-png.flaticon.com/512/1077/1077114.png';

            // Nếu là client thì không cần hiện avatar (hoặc hiện bên phải)
            let html = '';
            if (type === 'bot') {
                html = `
                <div class="msg-row bot-row">
                    <img class="msg-avatar" src="${avatar}" onerror="this.src='./anhmau/default-avatar.png'">
                    <div class="msg-bubble bot">${msg}</div>
                </div>`;
            } else {
                html = `
                <div class="msg-row client-row">
                    <div class="msg-bubble client">${msg}</div>
                </div>`;
            }

            container.insertAdjacentHTML('beforeend', html);
            scrollToBottom();
        }

        // 3. Load lịch sử
        function loadHistory() {
            fetch('index.php?act=api_load_chat')
                .then(res => res.json())
                .then(data => {
                    const container = document.getElementById('chatContent');
                    // Giữ lại câu chào mặc định, xóa các tin cũ để tránh duplicate
                    container.innerHTML = `
                    <div class="msg-row bot-row">
                        <img class="msg-avatar" src="./anhmau/logotron.png">
                        <div class="msg-bubble bot">Xin chào! Em có thể giúp gì cho anh ạ?</div>
                    </div>`;

                    data.forEach(item => {
                        // Chuyển đổi 'admin' hoặc 'bot' thành 'bot' để hiển thị giống nhau
                        let type = (item.sender === 'client') ? 'client' : 'bot';
                        renderMessage(item.message, type);
                    });
                });
        }

        // 4. Gửi tin nhắn
        function sendMsg() {
            let input = document.getElementById('msgInput');
            let msg = input.value.trim();
            if (!msg) return;

            // Hiện tin nhắn client ngay
            renderMessage(msg, 'client');
            input.value = '';

            let formData = new FormData();
            formData.append('message', msg);

            fetch('index.php?act=api_send_chat', { method: 'POST', body: formData })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success' && data.reply) {
                        setTimeout(() => {
                            renderMessage(data.reply, 'bot');
                        }, 600); // Delay 600ms cho tự nhiên
                    }
                });
        }

        function handleEnter(e) {
            if (e.key === 'Enter') sendMsg();
        }

        function scrollToBottom() {
            let div = document.getElementById('chatContent');
            div.scrollTop = div.scrollHeight;
        }
    </script>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z-removebg-preview.png" alt="31Shine Logo"
                    class="footer-logo">
                <p>31Shine – Hệ thống salon nam hiện đại hàng đầu Việt Nam. Chúng tôi giúp bạn luôn tự tin và
                    phong độ
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
                        <a href="index.php?act=lichsudat" class="btn btn-light btn-sm border">
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

        <!-- phần thông báo lý do huỷ của admin & nhân viên -->
        <script>
            // Hàm xử lý gửi AJAX đánh dấu đã đọc và chuyển hướng
            function markReadAndRedirect(redirectUrl) {
                // Gọi API đánh dấu đã đọc
                fetch('index.php?act=api_read_notify', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=<?= $unreadCancel['id'] ?>'
                }).then(() => {
                    // Nếu có link chuyển hướng thì chạy, không thì reload hoặc ở lại
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        // Tắt popup nếu chọn "Đã hiểu"
                        // (SweetAlert tự đóng, không cần làm gì thêm)
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    // Không dùng title mặc định, ta tự design trong html
                    title: '',
                    html: `
                <div class="cancel-popup-content">
                    <div class="cancel-icon-box">
                        <i class="fa-regular fa-calendar-xmark"></i>
                    </div>
                    
                    <h3 style="margin-bottom: 10px; color: #dc3545;">LỊCH HẸN ĐÃ BỊ HỦY</h3>
                    
                    <p class="cancel-message">
                        Rất tiếc, lịch hẹn mã lịch <span class="booking-highlight"><?= $unreadCancel['ma_lich'] ?></span> của anh đã bị hủy.
                    </p>

                    <div class="reason-box">
                        <span class="reason-label">Lý do từ Salon:</span>
                        <div class="reason-text">
                            "<?= htmlspecialchars($unreadCancel['cancel_reason']) ?>"
                        </div>
                    </div>

                    <p class="support-text">
                        Anh vui lòng đặt lại lịch khác hoặc liên hệ <strong>1900.1234</strong> để được hỗ trợ ngay.
                    </p>
                </div>
            `,

                    // Cấu hình nút bấm
                    showDenyButton: true,
                    showConfirmButton: true,

                    confirmButtonText: '<i class="fa-solid fa-calendar-plus"></i> Đặt Lịch Lại Ngay',
                    confirmButtonColor: '#D6A354', // Màu vàng nổi bật để kêu gọi hành động

                    denyButtonText: 'Đã hiểu',
                    denyButtonColor: '#6c757d', // Màu xám cho nút phụ

                    width: 500,
                    padding: '2em',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    background: '#fff url("path/to/pattern.png")', // Có thể thêm hình nền mờ nếu thích

                }).then((result) => {
                    if (result.isConfirmed) {
                        // Bấm Đặt Lại -> Chuyển sang trang đặt lịch
                        markReadAndRedirect('<?= BASE_URL ?>?act=datlich');
                    } else if (result.isDenied) {
                        // Bấm Đã hiểu -> Chỉ đánh dấu đã đọc
                        markReadAndRedirect(null);
                    }
                });
            });

            // 💡 HÀM HỖ TRỢ: Đánh dấu đã đọc và chuyển hướng
            function markReadAndRedirect(redirectUrl) {
                fetch('index.php?act=api_read_notify', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'id=<?= $unreadCancel['id'] ?>'
                })
                    .then(() => {
                        // Sau khi server báo đã đọc, chuyển hướng (nếu có URL)
                        if (redirectUrl) {
                            window.location.href = redirectUrl;
                        } else {
                            // Nếu không có URL, reload trang để thông báo biến mất
                            window.location.reload();
                        }
                    });
            }
        </script>
    <?php endif; ?>
</body>
<script src="<?= BASE_URL ?>public/main.js"></script>

</html>