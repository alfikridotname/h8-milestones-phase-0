<?php

$results = [
    'success' => false,
    'message' => ''
];

// Get Form Data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Validate Form Data
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    $results['message'] = 'Please fill all fields';
}

// Insert Data
if (empty($results['message'])) {
    $sql = "INSERT INTO contact_us (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $results['success'] = true;
        $results['message'] = 'Your message has been sent successfully';
    } else {
        $results['message'] = 'Something went wrong, please try again later';
    }
}

echo json_encode($results);
