<?php

$results = [
    'status'    => false,
    'message'   => '',
];

$payload = json_decode(file_get_contents('php://input'), true);

$username = $payload['username'];
$password = $payload['password'];

// get user
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);

// execute query
$stmt->execute();

// get result
$result = $stmt->get_result();

// if num rows > 0
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // verify password
    if (password_verify($password, $user['password'])) {
        // Generate token
        $token = md5(uniqid());

        // Save token to database
        $sql = "UPDATE users SET token = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $token, $user['id']);
        $stmt->execute();

        // Set result
        $results['status']   = true;
        $results['message']  = 'Login success';
        $results['userID']   = $user['id'];
        $results['token']    = $token;
        echo json_encode($results);
        exit();
    } else {
        $results['message'] = 'Password is incorrect';
        echo json_encode($results);
        exit();
    }
} else {
    $results['message'] = 'User not found';
    echo json_encode($results);
    exit();
}
