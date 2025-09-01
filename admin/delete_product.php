<?php
include '../includes/db.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM products WHERE id=$id");
}

header("Location: index.php");
exit;
