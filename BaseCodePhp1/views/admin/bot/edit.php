<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/createdanhmuc.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>anhmau/logotron.png">
    <title>Sửa Danh Mục | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <li><a href="?act=qlydichvu"><i class='bx bx-book-alt'></i>Quản Lý Dịch Vụ</a></li>
            <li><a href="?act=qlylichdat"> <i class='bx bx-receipt'></i>Quản Lý Đặt Lịch</a></li>
            <li><a href="?act=admin-nhanvien"><i class='bx bx-user-voice'></i>Quản Lý Nhân Viên</a></li>
            <li class="active"><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
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

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="<?= BASE_URL ?>anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <main>
            <div class="header">
                <h1>Sửa Cấu Hình</h1>
                <a href="?act=qlybot" class="btnthem" style="background:#ccc;color:#000">← Quay lại</a>
            </div>
            <div class="form-wrapper">
                <h3 class="mb-4">Chỉnh Sửa Câu Trả Lời</h3>

                <form action="index.php?act=updatebot" method="POST" class="form-add" onsubmit="return validateBot()">
                    <input type="hidden" name="id" value="<?= $bot['id'] ?>">

                    <div class="form-group">
                        <label>Từ khóa nhận diện:</label>
                        <input type="text" name="keywords" id="bot_keywords" class="form-control"
                            value="<?= htmlspecialchars($bot['keywords']) ?>">
                    </div>

                    <div class="form-group">
                        <label>Nội dung Bot trả lời:</label>
                        <textarea name="answer" id="bot_answer" rows="4" class="form-control"><?= htmlspecialchars($bot['answer']) ?></textarea>
                    </div>

                    <p id="error-msg" style="color:red; margin-bottom:15px; font-weight: bold;"></p>
                    <button type="submit" class="btnthem">Cập nhật</button>
                </form>
            </div>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js?v=1778077146.72267"></script>
    <script>
        function validateBot() {
            var keywordsInput = document.getElementById('bot_keywords');
            var answerInput = document.getElementById('bot_answer');
            var keywords = keywordsInput.value.trim();
            var answer = answerInput.value.trim();
            var error = document.getElementById("error-msg");

            error.innerText = "";
            [keywordsInput, answerInput].forEach(input => input.style.border = "1px solid #ccc");

            if (keywords === '') {
                error.innerText = 'Vui lòng nhập từ khóa nhận diện!';
                keywordsInput.style.border = '1px solid red';
                keywordsInput.focus();
                return false;
            }
            if (answer === '') {
                error.innerText = 'Vui lòng nhập nội dung Bot trả lời!';
                answerInput.style.border = '1px solid red';
                answerInput.focus();
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
