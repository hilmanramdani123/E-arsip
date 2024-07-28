document.addEventListener("DOMContentLoaded", function () {
    var fileInput = document.getElementById("unggah");
    var fileLabel = fileInput.nextElementSibling;

    fileInput.addEventListener("change", function (e) {
        var fileName = e.target.files[0].name;
        fileLabel.textContent = fileName;
    });

    // Add some interactivity for form submission
    var uploadForm = document.getElementById("uploadForm");
    uploadForm.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to upload this document?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, upload it!",
        }).then((result) => {
            if (result.isConfirmed) {
                uploadForm.submit();
            }
        });
    });
});
