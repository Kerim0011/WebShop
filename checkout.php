<?php
include 'includes/db.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}


if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}


$total = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $stmt = $conn->prepare("SELECT price FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $product = $res->fetch_assoc();
    $total += $product['price'] * $qty;
}


$user_id = $_SESSION['user']['id'];
$stmt = $conn->prepare("INSERT INTO orders (user_id,total) VALUES (?,?)");
$stmt->bind_param("id",$user_id,$total);
$stmt->execute();
$order_id = $stmt->insert_id;


foreach ($_SESSION['cart'] as $id => $qty) {
    $stmt = $conn->prepare("INSERT INTO order_items (order_id,product_id,quantity) VALUES (?,?,?)");
    $stmt->bind_param("iii",$order_id,$id,$qty);
    $stmt->execute();
}

// Clear cart
unset($_SESSION['cart']);

include 'includes/header.php';
?>

<h1>Checkout Complete ✅</h1>
<p>Thank you for your purchase! Your order ID is <?php echo $order_id; ?>.</p>
<a href="index.php">Go Back to Home</a>

<?php include 'includes/footer.php'; ?>
