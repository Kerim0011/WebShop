<?php
include 'includes/db.php';


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

   
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username or email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss", $username,$email,$password);
        $stmt->execute();
        $_SESSION['user'] = ['username'=>$username,'role'=>'customer'];
        header("Location: index.php");
    }
}
?>

<?php include 'includes/header.php'; ?>
<h1>Register</h1>
<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Register</button>
</form>
<?php include 'includes/footer.php'; ?>
