<?php
include 'includes/db.php';
include 'includes/header.php';
?>

<h1>All Products</h1>

<div class="products">
<?php
$result = $conn->query("SELECT * FROM products");
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
