// Inisialisasi
const btnAddData = document.getElementById('btn-add-user');
const formUser = document.getElementById('form-user');
const tableUser = document.getElementById('table-user');

// Event
btnAddData.addEventListener('click', function () {
    // Toggle
    formUser.classList.toggle('d-none');
});

// formUser Submit
formUser.addEventListener('submit', function (e) {
    e.preventDefault();

    // Ambil data
    const data = new FormData(formUser);

    // Kirim data
    fetch('?page=save-user', {
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

// tableUser Click button edit
tableUser.addEventListener('click', function (e) {
    const btnEdit = e.target.classList.contains('btn-edit');
    const id = e.target.getAttribute('data-id');
    const btnDelete = e.target.classList.contains('btn-delete');
    // Cek target
    if (btnEdit) {
        // Ambil data dari database
        fetch(`?page=edit-user&id=${id}`, {
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
                    formUser.classList.remove('d-none');

                    // Isi form
                    formUser.id.value = response.data.id;
                    formUser.first_name.value = response.data.first_name;
                    formUser.last_name.value = response.data.last_name;
                    formUser.username.value = response.data.username;
                    formUser.email.value = response.data.email;
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
            fetch(`?page=delete-user&id=${id}`, {
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