<?php
include_once('./config/db.php');
include_once('./config/helper.php');

// Result
$result = [
    'status'    => false,
    'message'   => ''
];

// Get data from form
$id          = isset($_POST['id']) && $_POST['id'] != '' ? abs($_POST['id']) : 0;
$kategori_id = $_POST['kategori_id'];
$nama_produk = $_POST['nama_produk'];
$harga       = $_POST['harga'];
$foto        = $_FILES['foto'];

// Upload file foto
$target_dir = "./assets/img/";
$target_file = $target_dir . basename($foto["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = $foto['full_path'] == '' ? false : getimagesize($foto["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    $result['message'] = 'File bukan gambar';
    $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
    $result['message'] = 'Sorry, file already exists.';
    @unlink($target_file);
}

// Check file size
if ($foto["size"] > 500000) {
    $result['message'] = 'Sorry, your file is too large.';
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
) {
    $result['message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $result['message'] = 'Sorry, your file was not uploaded.';
    // echo json_encode($result);
    // exit();
} else {
    if (move_uploaded_file($foto["tmp_name"], $target_file)) {
        $result['message'] = 'The file ' . htmlspecialchars(basename($foto["name"])) . ' has been uploaded.';
    } else {
        $result['message'] = 'Sorry, there was an error uploading your file.';
        echo json_encode($result);
        exit();
    }
}

// Check if nama produk is exist
$sql = "SELECT * FROM products WHERE nama_produk = '$nama_produk' AND id != $id";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    $result['message'] = 'Nama produk sudah ada';
    echo json_encode($result);
    exit();
}

// Insert data to database
if ($id == 0) {
    $sql        = "INSERT INTO products (kategori_id, nama_produk, foto, harga, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt       = mysqli_prepare($conn, $sql);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt, 'ississ', $kategori_id, $nama_produk, $foto["name"], $harga, $created_at, $updated_at);
    $query      = mysqli_stmt_execute($stmt);
} else {
    $sql = "UPDATE products SET kategori_id = ?, nama_produk = ?, foto = ?, harga = ?, updated_at = ? WHERE id = ?";

    // Prepare statement
    $stmt       = mysqli_prepare($conn, $sql);
    $updated_at = date('Y-m-d H:i:s');
    $foto_lama  = "select foto from products where id = $id";
    $sql        = mysqli_query($conn, $foto_lama);
    $row        = mysqli_fetch_assoc($sql);

    $fotoupdate = $foto['name'] == '' ? $row['foto'] : $foto['name'];
    mysqli_stmt_bind_param($stmt, 'issisi', $kategori_id, $nama_produk, $fotoupdate, $harga, $updated_at, $id);

    // Execute query
    $query = mysqli_stmt_execute($stmt);
}

// Check if query success
if ($query) {
    $result['status'] = true;
    $result['message'] = 'Berhasil menambahkan product';
} else {
    $result['message'] = 'Gagal menambahkan product';
}

// Output
echo json_encode($result);
