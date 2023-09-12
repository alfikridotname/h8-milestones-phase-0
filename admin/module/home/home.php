<?php
// session
include_once('config/session.php');

// include header
include_once('layout/header.php');

// Menu
include_once('layout/menu.php');

// include footer
include_once('layout/footer.php');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <h5 class="card-title">Selamat Datang <?= $_SESSION['fullname']; ?></h5>
                <p class="card-text">Anda login sebagai <?= $_SESSION['level']; ?></p>
            </div>
        </div>
    </div>
</div>