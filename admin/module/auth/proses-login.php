<?php
include_once('../../config/db.php');
include_once('../../config/helper.php');

// Result
$result = [
    'status'    => false,
    'message'   => ''
];

// Data
$username = $_POST['username'];
$password = $_POST['password'];

// Query bind param
$query = "SELECT CONCAT(first_name,' ',last_name) AS fullname, password, level FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();

// Result
$res = $stmt->get_result();
if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $hash = $row['password'];

    if (password_verify($password, $hash)) {
        session_start();
        $result['status']           = true;
        $result['message']          = 'Login berhasil';
        $_SESSION['fullname']       = $row['fullname'];
        $_SESSION['username']       = $username;
        $_SESSION['level']          = $row['level'];
        $_SESSION['system_login']   = true;
    } else {
        $result['message'] = 'Username atau Password salah';
    }
} else {
    $result['message'] = 'Username atau password salah';
}

echo json_encode($result);
