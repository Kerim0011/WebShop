<?php
include 'includes/db.php';
include 'includes/header.php';
?>

<h1>Welcome to Mini WebShop 🛒</h1>
<p>Check out our latest products!</p>

<div class="products">
<?php
$result = $conn->query("SELECT * FROM products LIMIT 6");
while($product = $result->fetch_assoc()) {
    echo "<div class='product'>
            <img src='assets/images/{$product['image']}' alt='{$product['name']}' width='150'>
            <h3>{$product['name']}</h3>
            <p>\${$product['price']}</p>
            <a href='product.php?id={$product['id']}'>View Product</a>
          </div>";
}
?>
</div>

<?php include 'includes/footer.php'; ?>
