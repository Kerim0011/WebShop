<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$isAdminPage = strpos($_SERVER['PHP_SELF'], '/admin/') !== false;


$base = '/WebShop/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mini WebShop</title>
    <?php if ($isAdminPage): ?>
        <link rel="stylesheet" href="<?= $base ?>assets/css/admin.css">
    <?php else: ?>
        <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
    <?php endif; ?>
</head>
<body>
<nav>
    <?php if ($isAdminPage && isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
       
        <a href="<?= $base ?>logout.php">Logout</a>
    <?php else: ?>
        
        <a href="<?= $base ?>index.php">Home</a>
        <a href="<?= $base ?>products.php">Products</a>
        <a href="<?= $base ?>cart.php">Cart</a>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="<?= $base ?>logout.php">Logout</a>
            <?php if($_SESSION['user']['role'] == 'admin'): ?>
                <a href="<?= $base ?>admin/">Admin</a>
            <?php endif; ?>
        <?php else: ?>
            <a href="<?= $base ?>login.php">Login</a>
            <a href="<?= $base ?>register.php">Register</a>
        <?php endif; ?>
    <?php endif; ?>
</nav>
<hr>
