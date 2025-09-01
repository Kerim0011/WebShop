<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'includes/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

       
        if (password_verify($password, $user['password'])) {
            
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];

           
            if ($user['role'] === 'admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit;

        } else {
            $error = "Invalid password!";
        }

    } else {
        $error = "User not found!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<h1>Login</h1>

<?php 
if (isset($error)) {
    echo "<p style='color:red'>{$error}</p>";
}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
</form>

<?php include 'includes/footer.php'; ?>
