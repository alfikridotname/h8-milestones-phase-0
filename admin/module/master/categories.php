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
            <div class="card-header">Master Categories</div>
            <div class="card-body">

                <!-- Btn Add Category -->
                <button id="btn-add-category" class="btn btn-primary">Tambah Data</button>
                <!-- End Btn Add Category -->

                <!-- Form -->
                <form id="form-category" class="row g-3 mt-3 d-none">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="col-md-6">
                        <label for="nama_kategory" class="form-label">Nama Category</label>
                        <input type="text" class="form-control" id="nama_kategory" name="nama_kategory" placeholder="Input Nama Kategory" required>
                    </div>
                    <div class="col-md-6">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Input Deskripsi" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="mt-3">

                <!-- End Form -->

                <!-- Table Categories -->
                <div class="table-responsive">
                    <table id="table-category" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nama Kategory</th>
                                <th>Deskripsi</th>
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
                            $sql    = "SELECT id, nama_kategory, deskripsi, created_at, updated_at FROM categories ORDER BY id DESC";
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
                                    <td><?php echo $row['deskripsi']; ?></td>
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
$js .= '<script src="./js_resource/category.js"></script>';
// include footer
include_once('layout/footer.php');
?>