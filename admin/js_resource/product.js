// Inisialisasi
const btnAddData = document.getElementById('btn-add-product');
const formProduct = document.getElementById('form-product');
const fotoProduk = document.getElementById('foto_produk');
const tableProduct = document.getElementById('table-product');

// Event
btnAddData.addEventListener('click', function () {
    // Toggle
    formProduct.classList.toggle('d-none');
    formProduct.id.value = '';
});

// formProduct Submit
formProduct.addEventListener('submit', function (e) {
    e.preventDefault();

    // Ambil data
    const data = new FormData(formProduct);

    // Kirim data
    fetch('?page=save-product', {
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

// tableProduct Click button edit
tableProduct.addEventListener('click', function (e) {
    const btnEdit = e.target.classList.contains('btn-edit');
    const id = e.target.getAttribute('data-id');
    const btnDelete = e.target.classList.contains('btn-delete');
    // Cek target
    if (btnEdit) {
        // Ambil data dari database
        fetch(`?page=edit-product&id=${id}`, {
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
                    formProduct.classList.remove('d-none');

                    // Isi form
                    formProduct.id.value = response.data.id;
                    formProduct.kategori_id.value = response.data.kategori_id;
                    formProduct.nama_produk.value = response.data.nama_produk;
                    formProduct.harga.value = response.data.harga;

                    // foto_produk set src
                    fotoProduk.classList.remove('d-none');
                    fotoProduk.src = `./assets/img/${response.data.foto}`;
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
            fetch(`?page=delete-product&id=${id}`, {
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