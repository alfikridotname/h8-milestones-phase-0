<?php
// css
$css = '<link rel="stylesheet" href="./assets/css/login.css">';

// Header
include_once('layout/header.php');
?>

<!-- Main -->
<main class="form-signin">
    <!-- Form Login -->
    <form id="form-login" method="post">
        <div class="text-center">
            <!-- Logo -->
            <img class="mb-4" src="./assets/img/logo.png" alt="Logo" width="100">
            <!-- End Logo -->

            <!-- Title -->
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <!-- End Title -->

            <!-- Alert -->
            <div id="alert" class="alert alert-danger d-none" role="alert">
                <span id="alert-msg"></span>
            </div>
            <!-- End Alert -->
        </div>

        <!-- Username -->
        <div class="form-floating">
            <input type="username" class="form-control" id="username" name="username" placeholder="Input Username">
            <label for="username">Username</label>
        </div>
        <!-- End Username -->

        <!-- Password -->
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Input Password">
            <label for="password">Password</label>
        </div>
        <!-- End Password -->

        <!-- Sign In Button -->
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <!-- End Sign In Button -->

        <!-- Copyright -->
        <p class="mt-3 mb-3 text-muted text-center">&copy; 2023</p>
        <!-- End Copyright -->
    </form>
    <!-- End Form Login -->
</main>
<!-- End Main -->

<?php

// JS
$js = '<script src="./js_resource/helper.js"></script>';
$js .= '<script src="./js_resource/login.js"></script>';

// Footer
include_once('layout/footer.php');
?>