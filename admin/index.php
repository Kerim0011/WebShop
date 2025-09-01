<?php
include '../includes/db.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$result = $conn->query("SELECT * FROM products");
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/admin.css">

<div class="container">
    <h1>Admin Panel - Products</h1>
    <a class="button" href="add_product.php">Add New Product</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while($product = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td>$<?php echo $product['price']; ?></td>
            <td><img src="../assets/images/<?php echo $product['image']; ?>" width="50"></td>
            <td>
                <a class="button edit" href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                <a class="button delete" href="delete_product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
