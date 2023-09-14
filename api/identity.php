<?php
// Get Identity
$sql = "SELECT * FROM identity";
$result = mysqli_query($conn, $sql);

// Fetch one identity
$identity = mysqli_fetch_assoc($result);

// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);

// JSON encode
echo json_encode($identity);
