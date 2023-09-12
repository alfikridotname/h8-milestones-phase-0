<?php
// session
session_start();
// db
include_once('config/db.php');
// helper
include_once('config/helper.php');

// Dynamic page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'login':
        include "module/auth/login.php";
        break;
    case 'logout':
        include "module/auth/logout.php";
        break;
    case 'home':
        include "module/home/home.php";
        break;
    case 'category':
        include "./module/master/categories.php";
        break;
    case 'product':
        include "./module/master/products.php";
        break;
    case 'user':
        include "./module/master/users.php";
        break;
    default:
        include "module/error/404.php";
        break;
}
