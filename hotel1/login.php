<?php
include("includes/db.php");

if($_POST){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM customers WHERE customer_email='$email' AND customer_pass='$pass'");
    if(mysqli_num_rows($q)){
        $user = mysqli_fetch_assoc($q);
        $_SESSION['customer_id'] = $user['customer_id'];
        header("Location: rooms.php");
    } else {
        echo "Invalid login";
    }
}
?>

<form method="post">
    <h2>Customer Login</h2>
    <input type="email" name="email" required>
    <input type="password" name="password" required>
    <button>Login</button>
</form>
