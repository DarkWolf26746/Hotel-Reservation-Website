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
        $error = "Invalid login";
    }
}

include("includes/header.php");
?>

<div class="form-container">
    <form method="post">
        <h2>Customer Login</h2>
        <p class="motto">Where Comfort Meets Elegance</p>

        <?php if(isset($error)) echo "<p class='error-msg'>$error</p>"; ?>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>

        <p class="form-footer">
            Don't have an account? <a href="register.php">Register</a>
        </p>
    </form>
</div>

<?php include("includes/footer.php"); ?>
