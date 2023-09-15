<?php

// Define results
$results = [
    'status'    => false,
    'message'   => '',
];

// Get payload
$payload = json_decode(file_get_contents('php://input'), true);

// Init variable
$first_name = $payload['first_name'];
$last_name  = $payload['last_name'];
$email      = $payload['email'];
$username   = $payload['username'];
$password   = $payload['password'];
$level      = 'pembeli';
$status     = 1;

// Check if username is exist
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

// Execute query
$stmt->execute();

// Get result
$result = $stmt->get_result();

// If num rows > 0
if ($result->num_rows > 0) {
    $results['message'] = 'Username sudah digunakan';
    echo json_encode($results);
    exit();
} else {
    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data
    $sql = "INSERT INTO users (first_name, last_name, email, username, password, level, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $first_name, $last_name, $email, $username, $password, $level, $status);
    $query = $stmt->execute();

    // Check if data is exist
    if (!$query) {
        $results['message'] = 'Data tidak ditemukan';
        echo json_encode($results);
        exit();
    } else {
        $results['status'] = true;
        $results['message'] = 'Data berhasil disimpan';
        echo json_encode($results);
        exit();
    }
}
