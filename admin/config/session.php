<?php
if (!isset($_SESSION['system_login'])) {
    echo '<meta http-equiv="refresh" content="0;url=../index.php?page=login">';
}
