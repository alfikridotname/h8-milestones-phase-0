<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
// db
include_once('./../admin/config/db.php');
// helper
include_once('./../admin/config/helper.php');

// Dynamic page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'category':
        include "category.php";
        break;
    case 'product':
        include "product.php";
        break;
    case 'identity':
        include "identity.php";
        break;
    case 'checkout':
        include "checkout.php";
        break;
    case 'send-contact-us':
        include "contact-us.php";
        break;
    case 'register':
        include "register.php";
        break;
    case 'login':
        include "login.php";
        break;
}
