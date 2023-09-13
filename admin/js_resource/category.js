// Inisialisasi
const btnAddData = document.getElementById('btn-add-category');
const formCategory = document.getElementById('form-category');
const tableCategory = document.getElementById('table-category');

// Event
btnAddData.addEventListener('click', function () {
    // Toggle
    formCategory.classList.toggle('d-none');
    formCategory.id.value = '';
});

// formCategory Submit
formCategory.addEventListener('submit', function (e) {
    e.preventDefault();

    // Ambil data
    const data = new FormData(formCategory);

    // Kirim data
    fetch('?page=save-category', {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(response => {
            // Cek response
            if (response.status === true) {
                // Reload halaman
                window.location.reload();
            } else {
                // Tampilkan pesan error
                alert(response.message);
            }
        })
        .catch(error => console.log(error));
});

// tableCategory Click button edit
tableCategory.addEventListener('click', function (e) {
    const btnEdit = e.target.classList.contains('btn-edit');
    const id = e.target.getAttribute('data-id');
    const btnDelete = e.target.classList.contains('btn-delete');
    // Cek target
    if (btnEdit) {
        // Ambil data dari database
        fetch(`?page=edit-category&id=${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(response => {
                // Cek response
                if (response.status === true) {
                    // Tampilkan form
                    formCategory.classList.remove('d-none');

                    // Isi form
                    formCategory.id.value = response.data.id;
                    formCategory.nama_kategory.value = response.data.nama_kategory;
                    formCategory.deskripsi.value = response.data.deskripsi;
                } else {
                    // Tampilkan pesan error
                    alert(response.message);
                }
            })
            .catch(error => console.log(error));
    } else if (btnDelete) {
        // Konfirmasi
        const konfirmasi = confirm('Apakah anda yakin ingin menghapus data ini?');
        if (konfirmasi) {
            // Kirim data
            fetch(`?page=delete-category&id=${id}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
                .then(response => response.json())
                .then(response => {
                    // Cek response
                    if (response.status === true) {
                        // Reload halaman
                        window.location.reload();
                    } else {
                        // Tampilkan pesan error
                        alert(response.message);
                    }
                })
                .catch(error => console.log(error));
        }
    }
});