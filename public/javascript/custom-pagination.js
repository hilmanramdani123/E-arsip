document.addEventListener("DOMContentLoaded", function () {
    const pageLinks = document.querySelectorAll(
        ".custom-pagination .page-link"
    );
    pageLinks.forEach((link) => {
        link.addEventListener("mouseenter", function () {
            link.setAttribute("data-hover", "Page " + link.textContent);
        });
    });
});
