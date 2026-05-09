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

if (menuBar && sideBar) {
    menuBar.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            // Trên mobile: toggle sidebar bằng class mobile-open
            sideBar.classList.toggle('mobile-open');
            // Toggle overlay
            let overlay = document.querySelector('.sidebar-overlay');
            if (!overlay) {
                overlay = document.createElement('div');
                overlay.classList.add('sidebar-overlay');
                document.body.appendChild(overlay);
                overlay.addEventListener('click', () => {
                    sideBar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                });
            }
            overlay.classList.toggle('active');
        } else {
            // Trên desktop: toggle close bình thường
            sideBar.classList.toggle('close');
        }
    });
}

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

if (searchBtn) {
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
}

window.addEventListener('resize', () => {
    if (sideBar) {
        if (window.innerWidth < 768) {
            sideBar.classList.add('close');
            sideBar.classList.remove('mobile-open');
            let overlay = document.querySelector('.sidebar-overlay');
            if (overlay) overlay.classList.remove('active');
        } else {
            sideBar.classList.remove('close');
            sideBar.classList.remove('mobile-open');
            let overlay = document.querySelector('.sidebar-overlay');
            if (overlay) overlay.classList.remove('active');
        }
    }
    if (window.innerWidth > 576 && searchBtnIcon && searchForm) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

// Auto close sidebar trên mobile khi load
if (sideBar && window.innerWidth <= 768) {
    sideBar.classList.add('close');
}

const toggler = document.getElementById('theme-toggle');

if (toggler) {
    // Khôi phục theme từ localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark');
        toggler.checked = true;
    }

    toggler.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    });
}

// Pagination - chỉ chạy nếu tồn tại table
const table = document.getElementById("userTable");
if (table) {
    const usersPerPage = 5;
    const rows = table.querySelectorAll("tbody tr");
    const totalRows = rows.length;
    const totalPages = Math.ceil(totalRows / usersPerPage);
    const ordersDiv = document.querySelector(".orders");

    if (ordersDiv && totalPages > 1) {
        const pagination = document.createElement("div");
        pagination.classList.add("pagination");
        pagination.style.margin = "20px";
        pagination.style.textAlign = "center";
        ordersDiv.appendChild(pagination);

        function showPage(page) {
            rows.forEach(r => r.style.display = "none");
            const start = (page - 1) * usersPerPage;
            const end = start + usersPerPage;
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
            btn.style.margin = "3px";
            btn.style.padding = "8px 14px";
            btn.style.borderRadius = "5px";
            btn.style.border = "1px solid #ccc";
            btn.style.cursor = "pointer";
            btn.onclick = () => showPage(i);
            pagination.appendChild(btn);
        }

        showPage(1);
    }
}