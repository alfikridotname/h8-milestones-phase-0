<?php
// session
include_once('config/session.php');

// include header
include_once('layout/header.php');

// Menu
include_once('layout/menu.php');
?>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <h5 class="card-title">Selamat Datang <?= isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?></h5>
                <p class="card-text">Anda login sebagai <?= isset($_SESSION['level']) ? $_SESSION['level'] : ''; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
// Get Total Users
$sqlUser = "SELECT COUNT(*) AS total FROM users";
$resultUser = mysqli_query($conn, $sqlUser);
$rowUser = mysqli_fetch_assoc($resultUser);

// Get Total Categories
$sqlCategory = "SELECT COUNT(*) AS total FROM categories";
$resultCategory = mysqli_query($conn, $sqlCategory);
$rowCategory = mysqli_fetch_assoc($resultCategory);

// Get Total Products
$sqlProduct = "SELECT COUNT(*) AS total FROM products";
$resultProduct = mysqli_query($conn, $sqlProduct);
$rowProduct = mysqli_fetch_assoc($resultProduct);

// Get Total Transactions
$sqlTransaction = "SELECT COUNT(*) AS total FROM transactions";
$resultTransaction = mysqli_query($conn, $sqlTransaction);
$rowTransaction = mysqli_fetch_assoc($resultTransaction);

// Total
$total_user = $rowUser['total'];
$total_category = $rowCategory['total'];
$total_product = $rowProduct['total'];
$total_transaction = $rowTransaction['total'];


?>

<div class="row mt-3">
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <p class="card-text"><?= $total_user; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Total Category</h5>
                <p class="card-text"><?= $total_category; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Total Product</h5>
                <p class="card-text"><?= $total_product; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Total Transaksi</h5>
                <p class="card-text"><?= $total_transaction; ?></p>
            </div>
        </div>
    </div>
</div>

<?php
// include footer
include_once('layout/footer.php');
?>