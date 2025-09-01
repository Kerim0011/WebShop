<?php
include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) {
    echo "Product not found!";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Product not found!";
    exit;
}

$product = $result->fetch_assoc();
?>

<h1><?php echo $product['name']; ?></h1>
<img src="assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="200">
<p><?php echo $product['description']; ?></p>
<p>Price: $<?php echo $product['price']; ?></p>

<form action="cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
    Quantity: <input type="number" name="quantity" value="1" min="1">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>

<?php include 'includes/footer.php'; ?>
