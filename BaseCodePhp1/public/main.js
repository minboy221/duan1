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


//phần hiên thị popup đăng nhập
function openPopup() {
        document.getElementById("login-popup").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("login-popup").style.display = "none";
    }

    // Đóng khi click ra ngoài
    window.onclick = function(event) {
        let popup = document.getElementById("login-popup");
        if (event.target == popup) {
            popup.style.display = "none";
        }
}