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
$firstName      = $_POST['first_name'];
$lastName       = $_POST['last_name'];
$username       = $_POST['username'];
$email          = $_POST['email'];
$password       = $_POST['password'];
$ulangiPassword = $_POST['ulangi_password'];
$level          = $_POST['level'];
$status         = isset($_POST['status']) ? $_POST['status'] : 0;

// Check if password and ulangi password is same
if ($password != $ulangiPassword) {
    $result['message'] = 'Password dan Ulangi Password tidak sama';
    echo json_encode($result);
    exit();
}

// Check if username is exist
$sql = "SELECT * FROM users WHERE username = '$username' AND id != $id";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    $result['message'] = 'Username sudah ada';
    echo json_encode($result);
    exit();
}

// Check if email is exist
$sql = "SELECT * FROM users WHERE email = '$email' AND id != $id";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    $result['message'] = 'Email sudah ada';
    echo json_encode($result);
    exit();
}

// Encrypt password
$password = password_hash($password, PASSWORD_DEFAULT);

// Insert data to database
if ($id == 0) {
    $sql        = "INSERT INTO users (first_name, last_name, username, email, password, level, status,created_at,updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt       = mysqli_prepare($conn, $sql);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt, 'ssssssiss', $firstName, $lastName, $username, $email, $password, $level, $status, $created_at, $updated_at);
    $query      = mysqli_stmt_execute($stmt);
} else {
    $sql        = "UPDATE users SET first_name=?, last_name=?, username=?, email=?, password=?, level=?, status=?, updated_at=? WHERE id=?";
    $stmt       = mysqli_prepare($conn, $sql);
    $updated_at = date('Y-m-d H:i:s');
    mysqli_stmt_bind_param($stmt, 'ssssssisi', $firstName, $lastName, $username, $email, $password, $level, $status, $updated_at, $id);
    $query      = mysqli_stmt_execute($stmt);
}

// Check if query success
if ($query) {
    $result['status'] = true;
    $result['message'] = 'Berhasil menambahkan user';
} else {
    $result['message'] = 'Gagal menambahkan user';
}

// Output
echo json_encode($result);
