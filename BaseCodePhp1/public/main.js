//phần tìm kiếm 
const searchIcon = document.getElementById("timkiem");
const searchBox = document.getElementById("search-box");

if (searchIcon && searchBox) {
    searchIcon.addEventListener("click", () => {
        searchBox.classList.toggle("active");
    });

    document.addEventListener("click", (e) => {
        if (!searchBox.contains(e.target) && !searchIcon.contains(e.target)) {
            searchBox.classList.remove("active");
        }
    });
}

//phần menu dropdown
const dropdownBtn = document.querySelector(".dropdown-btn");
const dropdownContent = document.querySelector(".dropdown-content");

if (dropdownBtn && dropdownContent) {
    dropdownBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdownContent.classList.toggle("show");
    });

    window.addEventListener("click", (e) => {
        if (!e.target.closest(".dropdown")) {
            dropdownContent.classList.remove("show");
        }
    });
}

//phần hiên thị popup đăng nhập
function openPopup() {
    const popup = document.getElementById("login-popup");
    if (popup) popup.style.display = "flex";
}

function closeLoginPopup() { // Đổi tên để tránh trùng
    const popup = document.getElementById("login-popup");
    if (popup) popup.style.display = "none";
}

// Đóng khi click ra ngoài popup đăng nhập
window.addEventListener('click', function (event) {
    let popup = document.getElementById("login-popup");
    if (popup && event.target == popup) {
        popup.style.display = "none";
    }
});

// ============================================
// HAMBURGER MENU - MOBILE
// ============================================
const hamburger = document.querySelector('.hamburger');
const mobileMenu = document.querySelector('.menu');
const mobileOverlay = document.querySelector('.mobile-menu-overlay');

if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function (e) {
        e.stopPropagation();
        hamburger.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        if (mobileOverlay) mobileOverlay.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Đóng menu khi click overlay
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function () {
            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // Đóng menu khi click vào link
    mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                if (mobileOverlay) mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Reset menu khi resize lên desktop
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
            if (mobileOverlay) mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}
