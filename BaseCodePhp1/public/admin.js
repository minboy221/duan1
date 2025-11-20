const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});
// Số user trên mỗi trang
const usersPerPage = 5;

// Lấy bảng
const table = document.getElementById("userTable");
const rows = table.querySelectorAll("tbody tr");
const totalRows = rows.length;

// Tính số trang
const totalPages = Math.ceil(totalRows / usersPerPage);

// Tạo thanh phân trang
const pagination = document.createElement("div");
pagination.classList.add("pagination");
pagination.style.margin = "20px";
pagination.style.textAlign = "center";
document.querySelector(".orders").appendChild(pagination);

function showPage(page) {
    // Ẩn toàn bộ
    rows.forEach(r => r.style.display = "none");

    // Vị trí bắt đầu – kết thúc
    const start = (page - 1) * usersPerPage;
    const end = start + usersPerPage;

    // Hiển thị đúng 5 user
    for (let i = start; i < end && i < totalRows; i++) {
        rows[i].style.display = "";
    }

    // Active nút
    document.querySelectorAll(".page-btn").forEach(btn => btn.classList.remove("active"));
    document.getElementById("page-" + page).classList.add("active");
}

// Render nút phân trang
for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement("button");
    btn.innerText = i;
    btn.id = "page-" + i;
    btn.classList.add("page-btn");
    btn.style.margin = "3px";
    btn.style.padding = "8px 14px";
    btn.style.borderRadius = "5px";
    btn.style.border = "1px solid #ccc";
    btn.style.cursor = "pointer";
    btn.onclick = () => showPage(i);
    pagination.appendChild(btn);
}

// Hiển thị trang đầu tiên
showPage(1);