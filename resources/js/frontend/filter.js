console.log("js")
const minPrice = document.getElementById("min_price");
const maxPrice = document.getElementById("max_price");
const filterForm = document.getElementById("price-filter-form");

function filterProducts() {

    const params = new URLSearchParams(window.location.search);

    params.set("min_price", minPrice.value);
    params.set("max_price", maxPrice.value);

    fetch(`${window.location.pathname}?${params.toString()}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest"
        }
    })
    .then(res => res.text())
    .then(html => {
        document.getElementById("pagination").innerHTML = html;
    });
}

filterForm.addEventListener("submit", function(e) {
    e.preventDefault();
    filterProducts();
});