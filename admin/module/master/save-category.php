<?php
include_once('./config/db.php');
include_once('./config/helper.php');

// Result
$result = [
    'status'    => false,
    'message'   => ''
];

// Get data from form
$id             = isset($_POST['id']) && $_POST['id'] != '' ? abs($_POST['id']) : 0;
$nama_kategory  = $_POST['nama_kategory'];
$deskripsi      = $_POST['deskripsi'];

// Check if nama category is exist
$sql = "SELECT * FROM categories WHERE nama_kategory = '$nama_kategory' AND id != $id";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    $result['message'] = 'Nama kategory sudah ada';
    echo json_encode($result);
    exit();
}

// Insert data to database
if ($id == 0) {
    $sql        = "INSERT INTO categories (nama_kategory, deskripsi, created_at, updated_at) VALUES (?, ?, ?, ?)";
    $stmt       = mysqli_prepare($conn, $sql);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt, 'ssss', $nama_kategory, $deskripsi, $created_at, $updated_at);
    $query      = mysqli_stmt_execute($stmt);
} else {
    $sql = "UPDATE categories SET nama_kategory=?, deskripsi=?, updated_at=? WHERE id=?";

    // Prepare statement
    $stmt       = mysqli_prepare($conn, $sql);
    $updated_at = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt, 'ssss', $nama_kategory, $deskripsi, $updated_at, $id);

    // Execute query
    $query = mysqli_stmt_execute($stmt);
}

// Check if query success
if ($query) {
    $result['status'] = true;
    $result['message'] = 'Berhasil menambahkan kategory';
} else {
    $result['message'] = 'Gagal menambahkan kategory';
}

// Output
echo json_encode($result);
