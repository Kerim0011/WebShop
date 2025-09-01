<?php
include 'includes/db.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}


if (isset($_POST['remove'])) {
    $remove_id = $_POST['remove_id'];
    unset($_SESSION['cart'][$remove_id]);
}

include 'includes/header.php';
?>

<h1>Your Cart 🛒</h1>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <form method="POST">
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $qty) {
            $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result();
            $product = $res->fetch_assoc();
            $subtotal = $product['price'] * $qty;
            $total += $subtotal;
            echo "<tr>
                    <td>{$product['name']}</td>
                    <td>{$qty}</td>
                    <td>\${$product['price']}</td>
                    <td>\${$subtotal}</td>
                    <td>
                        <button type='submit' name='remove'>Remove</button>
                        <input type='hidden' name='remove_id' value='{$id}'>
                    </td>
                  </tr>";
        }
        ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td colspan="2"><strong>$<?php echo $total; ?></strong></td>
        </tr>
    </table>
    </form>
    <a href="checkout.php">Proceed to Checkout</a>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
