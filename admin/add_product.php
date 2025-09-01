<?php
include '../includes/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $target = "../assets/images/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?,?,?,?)");
    $stmt->bind_param("sdss",$name,$desc,$price,$image);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/admin.css">

<div class="container">
    <h1>Add New Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="file" name="image" required>
        <button type="submit" name="add">Add Product</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
