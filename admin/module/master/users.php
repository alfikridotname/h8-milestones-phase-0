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
            <div class="card-header">Master Users</div>
            <div class="card-body">
                <!-- Btn Add User -->
                <button id="btn-add-user" class="btn btn-primary">Tambah Data</button>
                <!-- End Btn Add User -->

                <!-- Form -->
                <form id="form-user" class="row g-3 mt-3 d-none">
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Input First Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Input Last Name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Username" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Input Password">
                    </div>
                    <div class="col-md-6">
                        <label for="ulangi_password" class="form-label">Ulangi Password</label>
                        <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" placeholder="Input Password Lagi">
                    </div>
                    <div class="col-md-6">
                        <label for="level" class="form-label">Level</label>
                        <select id="level" class="form-select" name="level" required>
                            <option value="Admin">Admin</option>
                            <option value="Pembeli">Pembeli</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1">
                            <label class="form-check-label" for="status">
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>

                <!-- Divider -->
                <hr class="mt-3">

                <!-- End Form -->

                <!-- Table User -->
                <div class="table-responsive">
                    <table id="table-user" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include database
                            include_once('config/db.php');

                            // perintah sql untuk menampilkan daftar users
                            $sql    = "SELECT id, CONCAT(first_name,' ',last_name) AS fullname, username, email, level, status, created_at, updated_at FROM users ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);

                            // variabel untuk penomoran baris otomatis
                            $no = 1;

                            // melakukan perulangan while dari query $result
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['fullname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['level']; ?></td>
                                    <td><?php echo $row['status'] == '1' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Non Active</span>'; ?></td>
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
$js .= '<script src="./js_resource/user.js"></script>';
// include footer
include_once('layout/footer.php');
?>