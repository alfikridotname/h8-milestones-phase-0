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
        include "module/master/categories.php";
        break;
    case 'save-category':
        include "module/master/save-category.php";
        break;
    case 'edit-category':
        include "module/master/edit-category.php";
        break;
    case 'delete-category':
        include "module/master/delete-category.php";
        break;
    case 'product':
        include "module/master/products.php";
        break;
    case 'save-product':
        include "module/master/save-product.php";
        break;
    case 'edit-product':
        include "module/master/edit-product.php";
        break;
    case 'delete-product':
        include "module/master/delete-product.php";
        break;
    case 'user':
        include "./module/master/users.php";
        break;
    case 'save-user':
        include "./module/master/save-user.php";
        break;
    case 'edit-user':
        include "./module/master/edit-user.php";
        break;
    case 'delete-user':
        include "./module/master/delete-user.php";
        break;
    default:
        include "module/error/404.php";
        break;
}
