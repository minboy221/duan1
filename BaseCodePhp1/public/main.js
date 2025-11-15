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

// chọn danh sách
const stylistSelect = document.getElementById("chonstylist");
const stylistCards = document.querySelectorAll(".stylist-card");
const stylistList = document.querySelector(".stylist-list");

if (stylistSelect && stylistList) {
    stylistSelect.addEventListener("change", () => {
        const value = stylistSelect.value;

        if (!value) {
            stylistList.style.display = "none";
            stylistCards.forEach(card => card.classList.remove("active"));
            return;
        }

        stylistList.style.display = "flex";

        stylistCards.forEach(card => {
            card.classList.toggle("active", card.dataset.id === value);
        });
    });

    stylistCards.forEach(card => {
        card.addEventListener("click", () => {
            stylistCards.forEach(c => c.classList.remove("active"));
            card.classList.add("active");
            stylistSelect.value = card.dataset.id;
        });
    });
}

// phần chọn giờ
const timeBtns = document.querySelectorAll(".time-btn");
timeBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        timeBtns.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
    });
});

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
