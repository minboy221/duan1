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
window.onclick = function (event) {
    let popup = document.getElementById("login-popup");
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
