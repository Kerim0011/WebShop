<?php
include '../includes/db.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../assets/images/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'],$target);
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("sdssi",$name,$desc,$price,$image,$id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=?");
        $stmt->bind_param("sdsi",$name,$desc,$price,$id);
    }

    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/admin.css">

<div class="container">
    <h1>Edit Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="file" name="image">
        <img src="../assets/images/<?php echo $product['image']; ?>" width="100">
        <button type="submit" name="update">Update Product</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
