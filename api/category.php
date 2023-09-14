<?php
// Get categories
$sql = "SELECT * FROM categories";
$result = mysqli_query($conn, $sql);

// Fetch all category
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);

// JSON encode
echo json_encode($products);
