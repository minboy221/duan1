<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlychat.css">
    <link rel="shortcut icon" href="/duan1/BaseCodePhp1/anhmau/logotron.png">
    <title>Trang Quản Lý Chat | 31Shine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <li><a href="?act=qlybot"><i class="bx bx-bot"></i>Quản Lý AI</a></li>
            <li class="active"><a href="?act=qlychat"><i class='bx bx-brain'></i>Quản Lý Chat</a></li>
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
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>

            <form method="GET" action="">
                <div class="form-input">
                    <input type="hidden" name="act" value="qlydanhmuc">
                    <input type="text" name="keyword" placeholder="Tìm danh mục..."
                        value="<?= $_GET['keyword'] ?? '' ?>">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>

            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>

            <a href="<?= BASE_URL ?>?act=logout" class="profile">
                <img src="/duan1/BaseCodePhp1/anhmau/logochinh.424Z.png">
            </a>
        </nav>
        <main>
            <div class="header">
                <div class="left">
                    <h1>Lịch Sử Chat Khách Hàng</h1>
                </div>
            </div>
            <div class="container-fluid">
                <div class="chat-container shadow">

                    <div class="chat-sidebar">
                        <div class="sidebar-header">
                            <input type="text" placeholder="Tìm khách hàng..." class="form-control form-control-sm"
                                onkeyup="filterCustomers(this.value)">
                        </div>
                        <div class="user-list">
                            <?php if (!empty($listCustomers)): ?>
                                <?php foreach ($listCustomers as $kh): ?>
                                    <div class="user-item"
                                        onclick="loadChat(<?= $kh['khachhang_id'] ?>, '<?= htmlspecialchars($kh['name']) ?>', this)">
                                        <div class="user-avatar">
                                            <?= substr($kh['name'], 0, 1) ?>
                                        </div>
                                        <div class="user-info">
                                            <h6><?= htmlspecialchars($kh['name']) ?></h6>
                                            <small class="text-truncate d-block" style="max-width: 150px;">
                                                <?= htmlspecialchars($kh['last_msg']) ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="p-3 text-center text-muted">Chưa có tin nhắn nào.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="chat-main">
                        <div class="chat-header-bar" id="chat-title">
                            <i class="fa fa-eye"></i> Chọn khách hàng để xem nội dung
                        </div>

                        <div class="chat-messages" id="adminChatBody">
                            <div class="h-100 d-flex align-items-center justify-content-center text-muted">
                                <div class="text-center">
                                    <i class="fa fa-comments fa-3x mb-3"></i><br>
                                    Chọn một cuộc hội thoại để xem chi tiết
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <script>
                let pollingInterval = null;
                let userItems = []; // Biến toàn cục để lưu trữ các user item DOM

                document.addEventListener('DOMContentLoaded', function () {
                    // Khởi tạo danh sách userItems sau khi DOM đã sẵn sàng
                    userItems = document.querySelectorAll('.user-list .user-item');
                });

                // 💡 HÀM TÌM KIẾM THEO TÊN KHÁCH HÀNG (Client-side)
                function filterCustomers(keyword) {
                    const lowerCaseKeyword = keyword.toLowerCase().trim();
                    let found = 0;

                    userItems.forEach(item => {
                        const userName = item.querySelector('h6').textContent.toLowerCase();

                        if (userName.includes(lowerCaseKeyword)) {
                            item.style.display = '';
                            found++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Cập nhật thông báo nếu không tìm thấy
                    const userListContainer = document.querySelector('.user-list');
                    let noResults = userListContainer.querySelector('#no-chat-results');

                    if (found === 0 && lowerCaseKeyword.length > 0) {
                        if (!noResults) {
                            noResults = document.createElement('p');
                            noResults.id = 'no-chat-results';
                            noResults.classList.add('p-3', 'text-center', 'text-muted');
                            userListContainer.appendChild(noResults);
                        }
                        noResults.textContent = 'Không tìm thấy khách hàng nào khớp.';
                    } else if (noResults) {
                        noResults.remove();
                    }
                }


                // 1. Chọn khách -> Load tin nhắn
                function loadChat(clientId, name, element) {
                    // Đổi màu item được chọn
                    document.querySelectorAll('.user-item').forEach(el => el.classList.remove('active'));
                    element.classList.add('active');

                    // Cập nhật UI Header
                    document.getElementById('chat-title').innerText = "Đang xem tin nhắn của: " + name;

                    // Load tin nhắn
                    fetchMessages(clientId);

                    // Tự động cập nhật mỗi 3s (để xem tin mới nếu khách đang chat với Bot)
                    if (pollingInterval) clearInterval(pollingInterval);
                    pollingInterval = setInterval(() => {
                        fetchMessages(clientId);
                    }, 3000);
                }

                // 2. Lấy tin nhắn từ API
                function fetchMessages(clientId) {
                    fetch(`index.php?act=admin_api_get_chat&client_id=${clientId}`)
                        .then(res => res.json())
                        .then(data => {
                            let html = '';
                            if (data.length === 0) {
                                html = '<p class="text-center text-muted mt-5">Chưa có nội dung chat.</p>';
                            } else {
                                data.forEach(msg => {
                                    // Phân loại: Khách hay Bot
                                    let type = msg.sender;

                                    html += `
                            <div class="msg-row ${type}">
                                <div class="msg-bubble">
                                    ${msg.message}
                                    ${type === 'bot' ? '<br><small style="font-size:10px; opacity:0.7">(Bot trả lời)</small>' : ''}
                                </div>
                            </div>
                        `;
                                });
                            }

                            const chatBody = document.getElementById('adminChatBody');
                            // Chỉ cập nhật nếu nội dung mới dài hơn (tránh giật)
                            if (chatBody.innerHTML.length !== html.length) {
                                chatBody.innerHTML = html;
                                chatBody.scrollTop = chatBody.scrollHeight;
                            }
                        });
                }
            </script>
        </main>
    </div>
    <script src="<?= BASE_URL ?>public/admin.js"></script>


</body>

</html>