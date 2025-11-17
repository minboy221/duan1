<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn dịch vụ | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/chondichvu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
</head>
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
                    <div class="dangky">
                        <a href="<?= BASE_URL ?>?act=dangnhap">
                            <button>
                                Đăng Nhập / Đăng Ký
                            </button>
                        </a>
                    </div>
                </div>
            </aside>
        </header>
    </div>
    <div class="conten">
        <div class="background">
            <img src="/duan1/BaseCodePhp1/anhmau/31SHINEmoi.png" alt="">
        </div>
        <main>
            <div class="chondichvu">
                <div class="tieude">
                    <a href="<?= BASE_URL ?>?act=datlich">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                    </a>
                    <h2>Chọn dịch vụ</h2>
                </div>
                <div class="search">
                    <input type="text" placeholder="Tìm kiếm dịch vụ">
                    <button><i class="fa fa-arrow-right"></i></button>
                </div>
                <div class="baodichvu">
                    <div class="dichvu">
                        <h3>Cắt - Gội - Xả thư giãn</h3>
                        <div class="cacdichvu">
                            <div class="dichvucon">
                                <div class="baoanh">
                                    <img src="/duan1/BaseCodePhp1/anhmau/anhdichvutoc.png" alt="">
                                    <span class="duration">30p</span>
                                </div>
                                <div class="infor">
                                    <p>Cắt Xả</p>
                                    <div class="infor-gia">
                                        <span>Giá tiêu chuẩn</span>
                                        <p>94.000 VNĐ</p>
                                    </div>
                                    <div class="btn">
                                        <button>Chọn</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dichvucon">
                                <div class="baoanh">
                                    <img src="/duan1/BaseCodePhp1/anhmau/anhdichvutoc.png" alt="">
                                    <span class="duration">30p</span>
                                </div>
                                <div class="infor">
                                    <p>Cắt Xả</p>
                                    <div class="infor-gia">
                                        <span>Giá tiêu chuẩn</span>
                                        <p>94.000 VNĐ</p>
                                    </div>
                                    <div class="btn">
                                        <button>Chọn</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dichvucon">
                                <div class="baoanh">
                                    <img src="/duan1/BaseCodePhp1/anhmau/anhdichvutoc.png" alt="">
                                    <span class="duration">30p</span>
                                </div>
                                <div class="infor">
                                    <p>Cắt Xả</p>
                                    <div class="infor-gia">
                                        <span>Giá tiêu chuẩn</span>
                                        <p>94.000 VNĐ</p>
                                    </div>
                                    <div class="btn">
                                        <button>Chọn</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dachon">
                <div class="danhsach">
                    <p>Đã chọn dịch vụ 0</p>
                    <p>Tổng thanh toán</p>
                    <span>0 VNĐ</span>
                    <button>
                        Xong
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="phanjs.js"></script>

</html>