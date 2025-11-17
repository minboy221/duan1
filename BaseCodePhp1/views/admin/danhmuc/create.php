<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/qlydanhmuc.css">
    <title>Thêm Danh Mục</title>
</head>

<body>

    <div class="sidebar">
        <a href="#" class="logo">
            <i class="bi bi-scissors"></i>
            <div class="logo-name"><span>31</span>Shine</div>
        </a>

        <ul class="side-menu">
            <li><a href="?act=homeadmin">Thống Kê</a></li>
            <li class="active"><a href="?act=qlydanhmuc">Quản Lý Danh Mục</a></li>
            <li><a href="?act=qlydichvu">Quản Lý Dịch Vụ</a></li>
        </ul>
    </div>

    <div class="content">
        <nav>
            <i class='bx bx-menu'></i>
        </nav>

        <main>
            <div class="header">
                <h1>Thêm Danh Mục</h1>
                <a href="?act=qlydanhmuc" class="btnthem btn-back">← Quay lại</a>
            </div>

            <div class="form-wrapper">
                <form action="?act=store_danhmuc" method="POST" class="form-add">

                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" name="name" required placeholder="Nhập tên danh mục...">
                    </div>

                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" rows="4" placeholder="Nhập mô tả..."></textarea>
                    </div>

                    <button class="btnthem btn-submit">Thêm</button>
                </form>
            </div>
        </main>


    </div>

</body>

</html>