<?php
// session
include_once('config/session.php');

// include header
include_once('layout/header.php');

// Menu
include_once('layout/menu.php');
?>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Master Products</div>
            <div class="card-body">

                <!-- Btn Add Product -->
                <button id="btn-add-product" class="btn btn-primary">Tambah Data</button>
                <!-- End Btn Add Product -->

                <!-- Form -->
                <form id="form-product" class="row g-3 mt-3 d-none" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="col-md-6">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select id="kategori_id" name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <?php
                            // include database
                            include_once('config/db.php');

                            // perintah sql untuk menampilkan daftar categories
                            $sql    = "SELECT id, nama_kategory FROM categories ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            // melakukan perulangan while dari query $result
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama_kategory']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Input Nama Produk" required>
                    </div>
                    <div class="col-md-6">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Input Harga" required>
                    </div>
                    <div class="col-md-6">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="Input foto">
                    </div>
                    <div class="col-12">
                        <img id="foto_produk" src="" alt="" width="100" class="mt-3 d-none">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="mt-3">

                <!-- End Form -->

                <!-- Table Products -->
                <div class="table-responsive">
                    <table id="table-product" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Kategory</th>
                                <th>Nama Produk</th>
                                <th>Foto</th>
                                <th>Harga</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include database
                            include_once('config/db.php');

                            // perintah sql untuk menampilkan daftar categories
                            $sql    = "SELECT 
                                            p.id, 
                                            c.nama_kategory,
                                            p.nama_produk, 
                                            p.foto,
                                            p.harga, 
                                            p.created_at, 
                                            p.updated_at 
                                        FROM 
                                            products p INNER JOIN categories c ON p.kategori_id = c.id
                                        ORDER BY
                                            p.id DESC";
                            $result = mysqli_query($conn, $sql);

                            // variabel untuk penomoran baris otomatis
                            $no = 1;

                            // melakukan perulangan while dari query $result
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['nama_kategory']; ?></td>
                                    <td><?php echo $row['nama_produk']; ?></td>
                                    <td>
                                        <img src="./assets/img/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama_produk']; ?>" width="100">
                                    </td>
                                    <td><?php echo $row['harga']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo $row['updated_at']; ?></td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-warning btn-sm btn-edit" data-id="<?php echo $row['id']; ?>">Edit</button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="<?php echo $row['id']; ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// JS
$js = '<script src="./js_resource/helper.js"></script>';
$js .= '<script src="./js_resource/product.js"></script>';
// include footer
include_once('layout/footer.php');
?>