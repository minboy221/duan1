<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/editdichvu.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Sửa Dịch Vụ | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>public/responsive.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bx-cut'></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>
        <ul class="side-menu">
            <li><a href="?act=homeadmin"><i class='bx bxs-dashboard'></i>Thống Kê</a></li>
            <li><a href="?act=qlydanhmuc"><i class='bx bx-store-alt'></i>Quản Lý Danh Mục</a></li>
            <li class="active"><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
            <li><a href="?act=qlylichlamviec"><i class='bx bx-cog'></i>Quản Lý Làm Việc</a></li>
            <li><a href="?act=qlytho"><i class='bx bx-cut'></i>Quản Lý Thợ</a></li>
            <li><a href="?act=qlytaikhoan"><i class='bx bx-group'></i>Quản Lý Người Dùng</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="<?= BASE_URL ?>?act=logout" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Đăng Xuất
                </a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>?act=home" class="logout">
                    <i class='bx bx-home-alt-2'></i>Xem Website
                </a>
            </li>
        </ul>
    </div>
    <!-- End Sidebar -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="#" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <!-- End Navbar -->
        <main>
            <div class="header">
                <h1>Sửa Dịch Vụ</h1>
                <a href="?act=qlydichvu" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>

            <div class="bottom-data" style="padding:20px;">
                <?php if (!empty($service)): ?>
                    <form action="?act=update_dichvu" method="POST" enctype="multipart/form-data" class="form-add" onsubmit="return validateDichVu()">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($service['id']) ?>">

                        <div class="form-group">
                            <label>Tên dịch vụ</label>
                            <input type="text" name="name" id="dichvu_name" value="<?= htmlspecialchars($service['name'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description"
                                rows="4"><?= htmlspecialchars($service['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Giá</label>
                            <input type="number" name="price" id="dichvu_price" value="<?= htmlspecialchars($service['price'] ?? '') ?>"
                                min="0">
                        </div>

                        <div class="form-group">
                            <label>Thời gian (phút)</label>
                            <input type="number" name="time" value="<?= htmlspecialchars($service['time'] ?? '') ?>"
                                min="0">
                        </div>

                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="danhmuc_id" id="dichvu_danhmuc">
                                <option value="">--Chọn danh mục--</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == ($service['danhmuc_id'] ?? '')) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ảnh hiện tại</label>
                            <?php if (!empty($service['image'])): ?>
                                <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($service['image']) ?>" width="100"
                                    style="display:block;margin-bottom:10px;">
                            <?php else: ?>
                                <p>Chưa có ảnh</p>
                            <?php endif; ?>
                            <label>Đổi ảnh</label>
                            <input type="file" name="image" accept="image/*">
                        </div>

                        <p id="error-msg" style="color:red; margin-bottom:15px; font-weight: bold;"></p>
                        <button class="btnthem" style="padding:10px 25px;">Lưu Thay Đổi</button>
                    </form>
                <?php else: ?>
                    <p style="color:red;">Dịch vụ không tồn tại.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js?v=1778077146.76292"></script>
    <script>
        function validateDichVu() {
            var nameInput = document.getElementById('dichvu_name');
            var priceInput = document.getElementById('dichvu_price');
            var danhmucInput = document.getElementById('dichvu_danhmuc');
            var error = document.getElementById("error-msg");

            var name = nameInput.value.trim();
            var price = priceInput.value.trim();
            var danhmuc = danhmucInput.value;

            error.innerText = "";
            [nameInput, priceInput, danhmucInput].forEach(input => input.style.border = "1px solid #ccc");

            if (name === '') {
                error.innerText = 'Vui lòng nhập tên dịch vụ!';
                nameInput.style.border = '1px solid red';
                nameInput.focus();
                return false;
            }
            if (price === '') {
                error.innerText = 'Vui lòng nhập giá dịch vụ!';
                priceInput.style.border = '1px solid red';
                priceInput.focus();
                return false;
            }
            if (danhmuc === '') {
                error.innerText = 'Vui lòng chọn danh mục!';
                danhmucInput.style.border = '1px solid red';
                danhmucInput.focus();
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
