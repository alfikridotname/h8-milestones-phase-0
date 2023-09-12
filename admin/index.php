<?php
include_once('config/db.php');
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
switch ($page) {
    case 'login':
        include "./module/auth/login.php";
        break;
    case 'home':
        include "home.php";
        break;
    case 'barang':
        include "barang.php";
        break;
    case 'kategori':
        include "kategori.php";
        break;
    case 'user':
        include "user.php";
        break;
    case 'logout':
        include "logout.php";
        break;
    default:
        echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
        break;
}
