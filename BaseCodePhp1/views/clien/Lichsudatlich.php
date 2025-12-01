<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch Sử Cắt | 31Shine</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/lichsudatlich.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">

    <style>
        /* --- CSS GỐC CỦA BẠN (GIỮ NGUYÊN) --- */
        .badge {
            padding: 6px 12px;
            /* Tăng khoảng cách đệm lên một chút cho thoáng */
            border-radius: 15px;
            font-size: 12px;
            color: white;
            font-weight: 500;

            /* --- CÁC DÒNG MỚI ĐỂ FIX LỖI --- */
            white-space: nowrap;
            /* Quan trọng: Cấm chữ bị xuống dòng */
            display: inline-block;
            /* Giúp khung bao ôm trọn chữ */
            min-width: 100px;
            /* Đặt độ rộng tối thiểu để các nút đều nhau */
            text-align: center;
            /* Căn giữa chữ trong khung */
        }

        .status-pending {
            background-color: #f6c23e;
            color: #fff;
        }

        .status-confirmed {
            background-color: #36b9cc;
        }

        .status-done {
            background-color: #1cc88a;
        }

        .status-cancelled {
            background-color: #e74a3b;
        }

        .btn-view {
            padding: 5px 10px;
            background: #222;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            /* Fix lỗi nút bị trắng */
            display: inline-block;
            text-decoration: none;
        }

        .btn-view:hover {
            background: #D6A354;
            color: white;
        }

        .pagination button {
            margin: 3px;
            padding: 8px 14px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #f5f5f5;
            cursor: pointer;
            transition: 0.2s;
        }

        .pagination button:hover {
            background: #e0e0e0;
        }

        .pagination .active {
            background: #f6c23e !important;
            color: white !important;
            border-color: #0a58ca !important;
        }

        /* --- CSS CHO MODAL TỰ CODE (KHÔNG CẦN BOOTSTRAP) --- */
        .custom-modal {
            display: none;
            /* Mặc định ẩn */
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Màu nền mờ */
            animation: fadeIn 0.3s;
        }

        .custom-modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            /* Cách trên 10% và giữa màn hình */
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            position: relative;
            animation: slideIn 0.3s;
        }

        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header h3 {
            margin-top: 0;
            color: #333;
            font-size: 18px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        /* CSS CHO NÚT LÝ DO */
        .btn-reason {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 12px 15px;
            border-radius: 5px;
            cursor: pointer;
            color: #333;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-reason:hover {
            background-color: #f1f1f1;
        }

        .btn-reason.active {
            background-color: #fff3cd;
            border-color: #D6A354;
            color: #856404;
            font-weight: bold;
        }

        .btn-reason i {
            margin-right: 10px;
            color: #D6A354;
            width: 20px;
            text-align: center;
        }

        .txt-reason-other {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: none;
            /* Ẩn mặc định */
            resize: vertical;
        }

        .btn-confirm-cancel {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            font-size: 16px;
            opacity: 0.6;
            pointer-events: none;
            /* Khóa nút khi chưa chọn */
        }

        .btn-confirm-cancel.enabled {
            opacity: 1;
            pointer-events: auto;
        }

        .btn-confirm-cancel:hover {
            background-color: #c82333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
            }

            to {
                transform: translateY(0);
            }
        }
    </style>
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
                    <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z-removebg-preview.png" alt="">
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="<?= BASE_URL ?>?act=home">Trang Chủ</a></li>
                        <li><a href="<?= BASE_URL ?>?act=about">Về 31Shine</a></li>
                        <li><a href="<?= BASE_URL ?>?act=dichvu">Dịch Vụ</a></li>
                        <li><a href="<?= BASE_URL ?>?act=nhanvien">Nhân Viên</a></li>
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
                    <div class="dangky">
                        <div class="dropdown">
                            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])): ?>
                                <button class="dropdown-btn">
                                    Xin Chào, <?= htmlspecialchars($_SESSION['username']) ?> <i
                                        class="fa-solid fa-chevron-down"></i>
                                </button>
                                <div class="dropdown-content">
                                    <a href="<?= BASE_URL ?>?act=lichsudat">Lịch sử toả sáng</a>
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
            <div class="lichsu">
                <h2>LỊCH SỬ CẮT TÓC</h2>
                <p>Xem lại các lần bạn đã cắt tóc tại 31Shine</p>

                <div class="bang-lichsu">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Ngày</th>
                                <th>Giờ hẹn</th>
                                <th>Dịch vụ</th>
                                <th>Thợ cắt</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Lý Do Hủy</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($historyList)): ?>
                                <?php foreach ($historyList as $item): ?>
                                    <?php
                                    $statusClass = '';
                                    $statusText = '';
                                    switch ($item['status']) {
                                        case 'pending':
                                            $statusClass = 'status-pending';
                                            $statusText = 'Chờ xác nhận';
                                            break;
                                        case 'confirmed':
                                            $statusClass = 'status-confirmed';
                                            $statusText = 'Đã duyệt';
                                            break;
                                        case 'done':
                                            $statusClass = 'status-done';
                                            $statusText = 'Hoàn thành';
                                            break;
                                        case 'cancelled':
                                            $statusClass = 'status-cancelled';
                                            $statusText = 'Đã hủy';
                                            break;
                                    }
                                    ?>
                                    <tr>
                                        <td>#<?= htmlspecialchars($item['ma_lich']) ?></td>
                                        <td><?= !empty($item['ngay_lam']) ? date('d/m/Y', strtotime($item['ngay_lam'])) : '---' ?>
                                        </td>
                                        <td><?= htmlspecialchars($item['gio_lam'] ?? '---') ?></td>
                                        <td><?= htmlspecialchars($item['ten_dichvu']) ?></td>
                                        <td><?= htmlspecialchars($item['ten_tho']) ?></td>
                                        <td style="color: #d63031; font-weight: bold;">
                                            <?= number_format($item['total_price'], 0, ',', '.') ?>đ
                                        </td>
                                        <td><span class="badge <?= $statusClass ?>"><?= $statusText ?></span></td>
                                        <td><?= !empty($item['cancel_reason']) ? nl2br(htmlspecialchars($item['cancel_reason'])) : '-' ?>
                                        </td>

                                        <td class="chitiet" style="white-space: nowrap;">
                                            <a href="<?= BASE_URL ?>?act=lichsudatchitiet&ma_lich=<?= $item['ma_lich'] ?>">
                                                <button class="btn-view">Chi Tiết</button>
                                            </a>

                                            <?php if ($item['status'] === 'pending' || $item['status'] === 'confirmed'): ?>
                                                <button type="button" class="btn-view"
                                                    style="background: #dc3545; margin-left: 5px; color: white;"
                                                    onclick="openModal('<?= $item['id'] ?>', '<?= $item['ma_lich'] ?>')">
                                                    <i class="fa-solid fa-xmark"></i> Hủy
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($item['status'] === 'done'): ?>
                                                <?php if (!empty($item['rating'])): ?>
                                                    <button class="btn-view" style="background:#6c757d; margin-left:5px;"
                                                        onclick="alert('Đơn hàng đã được đánh giá!');">
                                                        Đã Đánh Giá
                                                    </button>
                                                <?php else: ?>
                                                    <a href="<?= BASE_URL ?>?act=danhgia&ma_lich=<?= $item['ma_lich'] ?>">
                                                        <button class="btn-view" style="background:#28a745; margin-left:5px;">Đánh
                                                            Giá</button>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" style="text-align:center;padding:20px;color:#888;">Không có lịch nào
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php if (isset($_SESSION['popup_notify'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        Swal.fire({
                            icon: '<?= $_SESSION['popup_notify']['type'] ?>',
                            title: 'Thông báo',
                            text: '<?= $_SESSION['popup_notify']['message'] ?>',
                            confirmButtonColor: '#D6A354',
                            confirmButtonText: 'Đồng ý'
                        });
                    });
                </script>
                <?php unset($_SESSION['popup_notify']); ?>
            <?php endif; ?>
        </main>
    </div>
    <!-- hủy lịch -->
    <div id="myHuyLichModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                <h3>Xác nhận hủy lịch hẹn</h3>
            </div>

            <form action="index.php?act=huylich" method="POST" onsubmit="return validateForm()">
                <p style="margin: 15px 0; color: #555;">Bạn đang hủy lịch: <strong id="displayMaLich"
                        style="color:#000;"></strong></p>

                <input type="hidden" name="id" id="inputLichId" value="">
                <input type="hidden" name="ly_do_chon" id="inputLyDoChon" value="">

                <div class="reason-list">
                    <div class="btn-reason" onclick="selectReason(this, 'Bận việc đột xuất')">
                        <i class="fa-regular fa-clock"></i> Bận việc đột xuất
                    </div>
                    <div class="btn-reason" onclick="selectReason(this, 'Muốn đổi ngày/giờ khác')">
                        <i class="fa-solid fa-calendar-days"></i> Muốn đổi ngày/giờ khác
                    </div>
                    <div class="btn-reason" onclick="selectReason(this, 'Tìm được chỗ khác')">
                        <i class="fa-solid fa-location-dot"></i> Tìm được chỗ khác
                    </div>
                    <div class="btn-reason" onclick="selectReason(this, 'Khác')">
                        <i class="fa-solid fa-pen"></i> Lý do khác...
                    </div>
                </div>

                <textarea name="ly_do_khac" id="txtLyDoKhac" class="txt-reason-other" rows="3"
                    placeholder="Nhập lý do cụ thể..."></textarea>

                <button type="submit" name="huy_lich_submit" id="btnSubmitHuy" class="btn-confirm-cancel">XÁC NHẬN
                    HỦY</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-column">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z-removebg-preview.png" alt="31Shine Logo"
                    class="footer-logo">
                <p>31Shine – Hệ thống salon nam hiện đại hàng đầu Việt Nam.</p>
            </div>
            <div class="footer-column">
                <h3>Liên kết nhanh</h3>
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    <li><a href="#">Dịch vụ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Liên hệ</h3>
                <p><i class="fa-solid fa-location-dot"></i> 123 Nguyễn Trãi, Hà Nội</p>
                <p><i class="fa-solid fa-phone"></i> 0909 123 456</p>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 31Shine. Tất cả quyền được bảo lưu.</p>
        </div>
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>public/main.js"></script>

<script>
    // Mở Modal
    function openModal(id, maLich) {
        document.getElementById('myHuyLichModal').style.display = "block";
        document.getElementById('inputLichId').value = id;
        document.getElementById('displayMaLich').innerText = maLich;

        // Reset form
        document.getElementById('inputLyDoChon').value = '';
        document.getElementById('txtLyDoKhac').value = '';
        document.getElementById('txtLyDoKhac').style.display = 'none';

        document.getElementById('btnSubmitHuy').classList.remove('enabled');

        let reasons = document.querySelectorAll('.btn-reason');
        reasons.forEach(r => r.classList.remove('active'));
    }

    // Đóng Modal
    function closeModal() {
        document.getElementById('myHuyLichModal').style.display = "none";
    }

    // Đóng khi click ra ngoài
    window.onclick = function (event) {
        let modal = document.getElementById('myHuyLichModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Chọn lý do
    function selectReason(div, value) {
        let reasons = document.querySelectorAll('.btn-reason');
        reasons.forEach(r => r.classList.remove('active'));

        div.classList.add('active');
        document.getElementById('inputLyDoChon').value = value;

        // Bật nút submit
        document.getElementById('btnSubmitHuy').classList.add('enabled');

        let txtOther = document.getElementById('txtLyDoKhac');
        if (value === 'Khác') {
            txtOther.style.display = 'block';
            txtOther.focus();
        } else {
            txtOther.style.display = 'none';
        }
    }

    // Validate
    function validateForm() {
        let lyDoChon = document.getElementById('inputLyDoChon').value;
        let lyDoKhac = document.getElementById('txtLyDoKhac').value.trim();

        if (lyDoChon === 'Khác' && lyDoKhac === '') {
            alert('Vui lòng nhập lý do cụ thể!');
            document.getElementById('txtLyDoKhac').focus();
            return false;
        }
        return true;
    }

    // PHÂN TRANG (GIỮ NGUYÊN)
    const rowsPerPage = 5;
    const table = document.querySelector(".bang-lichsu table");
    const rows = table.querySelectorAll("tbody tr");
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    const pagination = document.createElement("div");
    pagination.classList.add("pagination");
    pagination.style.margin = "20px 0";
    pagination.style.textAlign = "center";
    document.querySelector(".bang-lichsu").appendChild(pagination);

    function showPage(page) {
        rows.forEach(r => r.style.display = "none");
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        for (let i = start; i < end && i < totalRows; i++) {
            rows[i].style.display = "";
        }
        document.querySelectorAll(".page-btn").forEach(btn => btn.classList.remove("active"));
        const activeBtn = document.getElementById("page-" + page);
        if (activeBtn) activeBtn.classList.add("active");
    }

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.id = "page-" + i;
        btn.classList.add("page-btn");
        btn.onclick = () => showPage(i);
        pagination.appendChild(btn);
    }
    if (totalRows > 0) showPage(1);
</script>

</html>