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

// Get data from table products
$sql    = "SELECT * FROM products WHERE id = ?";
$stmt   = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
$query  = mysqli_stmt_execute($stmt);
$resultQuery = mysqli_stmt_get_result($stmt);
$row    = mysqli_fetch_assoc($resultQuery);

// Check if data is exist
if (!$row) {
    $result['message'] = 'Data tidak ditemukan';
    echo json_encode($result);
    exit();
} else {
    $result['status'] = true;
    $result['data'] = $row;
    echo json_encode($result);
    exit();
}

echo json_encode($result);
