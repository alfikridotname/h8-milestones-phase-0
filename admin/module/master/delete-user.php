<?php
include_once('./config/db.php');
include_once('./config/helper.php');

// Result
$result = [
    'status'    => false,
    'message'   => ''
];

// GET ID
$id = abs($_GET['id']);

// Delete
$sql    = "DELETE FROM users WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
$query  = mysqli_stmt_execute($stmt);

// Check if data is exist
if (!$query) {
    $result['message'] = 'Data tidak ditemukan';
    echo json_encode($result);
    exit();
} else {
    $result['status'] = true;
    $result['message'] = 'Data berhasil dihapus';
    echo json_encode($result);
    exit();
}

echo json_encode($result);
