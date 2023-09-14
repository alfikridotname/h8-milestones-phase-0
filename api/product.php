<?php

// Get product
$sql    =  "SELECT 
                p.id,
                c.nama_kategory,
                p.nama_produk,
                p.harga,
                p.foto
            FROM 
                products p
                INNER JOIN categories c ON p.kategori_id = c.id";
$result = mysqli_query($conn, $sql);

// Fetch all products
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);

// JSON encode
echo json_encode($products);
