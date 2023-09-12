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
// include footer
include_once('layout/footer.php');
?>