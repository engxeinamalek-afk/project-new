console.log("pagination.js loaded");

document.addEventListener("click", function (e) {

    const link = e.target.closest('a[href*="?page="]');

    if (!link) return;

    e.preventDefault();

    fetch(link.href, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "text/html"
        }
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById("pagination").innerHTML = html;
    });
});