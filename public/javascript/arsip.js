// Delete document function
function deleteDocument(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/dokumen/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {

                    $('#dokumen-' + id).remove();
                    if ($('#documentTableBody tr').length === 0) {
                        $('#noResultRow').show();
                    }

                    Swal.fire(
                        'Terhapus!',
                        'Dokumen telah dihapus.',
                        'success'
                    );
                },
                error: function(xhr) {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan saat menghapus dokumen.',
                        'error'
                    );
                }
            });
        }
    });
}

function confirmLogout() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari halaman!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}

// Event listeners for search functionality and document modal
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const documentTableBody = document.getElementById('documentTableBody');
    const noResultRow = document.getElementById('noResultRow');

    let debounceTimeout;

    // Debounce function to limit the rate at which the search function is called
    function debounce(func, delay) {
        return function(...args) {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase();
        let hasResult = false;

        documentTableBody.querySelectorAll('tr').forEach(row => {
            const cells = row.getElementsByTagName('td');
            let match = false;

            for (let i = 1; i < cells.length - 2; i++) { // Skip first and last two columns
                if (cells[i].textContent.toLowerCase().includes(searchTerm)) {
                    match = true;
                    break;
                }
            }

            if (match) {
                row.style.display = '';
                hasResult = true;
            } else {
                row.style.display = 'none';
            }
        });

        noResultRow.style.display = hasResult ? 'none' : 'block';
        documentTableBody.style.display = hasResult ? 'table-row-group' : 'none';
    }

    // Attach the debounced search function to the input event
    searchInput.addEventListener('input', debounce(performSearch, 300));

    // Event for viewing document in modal
    $(document).on('click', '.btn-view', function(event) {
        event.preventDefault();
        var documentUrl = $(this).attr('href');
        $('#documentIframe').attr('src', documentUrl);
        $('#documentModal').modal('show');
    });

    $('#documentModal').on('hide.bs.modal', function(event) {
        $('#documentIframe').attr('src', '');
    });

    $('#documentModal').on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
});
