<?php

// Get product
$sql    = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Fetch all products
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);

// JSON encode
echo json_encode($products);
