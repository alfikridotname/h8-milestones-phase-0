<?php

// Display error
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database
$host       = 'localhost';
$port       = '3306';
$username   = 'root';
$password   = 'root';
$database   = 'company_profile_db';

// Connect
$conn = mysqli_connect($host, $username, $password, $database, $port);

// Check connection
if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
