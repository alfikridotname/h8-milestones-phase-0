<?php

$phpInput = file_get_contents('php://input');
$pesanan = json_decode($phpInput, true);

// Insert Transaction
$sql = "INSERT INTO transactions (tanggal, user_id, created_at) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
$date = date('Y-m-d');
$dateTime = date('Y-m-d H:i:s');
mysqli_stmt_bind_param($stmt, 'sds', $date, $pesanan['user_id'], $dateTime);
$query = mysqli_stmt_execute($stmt);

// Get last id
$last_id = mysqli_insert_id($conn);

foreach ($pesanan['data'] as $key => $value) {
    $sql = "INSERT INTO transaction_details (transaction_id, product_id, qty, harga, total) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $totalHarga = $value['qty'] * $value['harga'];
    mysqli_stmt_bind_param($stmt, 'iiiii', $last_id, $value['id'], $value['qty'], $value['harga'], $totalHarga);
    $query = mysqli_stmt_execute($stmt);
}

// Check if data is exist
if (!$query) {
    $result['message'] = 'Data tidak ditemukan';
    echo json_encode($result);
    exit();
} else {
    $result['status'] = true;
    $result['message'] = 'Data berhasil disimpan';
    echo json_encode($result);
    exit();
}
