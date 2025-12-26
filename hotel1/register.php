<?php
include("includes/db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $pass    = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // simple duplicate email check
    $check = mysqli_query($conn, "SELECT * FROM customers WHERE customer_email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Email already registered!";
    } else {
        mysqli_query($conn, "
            INSERT INTO customers
            (customer_name, customer_email, customer_pass, customer_contact, customer_address, customer_image, customer_ip)
            VALUES
            ('$name', '$email', '$pass', '$contact', '$address', 'default.png', '{$_SERVER['REMOTE_ADDR']}')
        ");

        $message = "Registration successful! You can login now.";
    }
}
?>

<?php include("includes/header.php"); ?>

<h2>Customer Registration</h2>

<?php if($message) echo "<p style='color:red;'>$message</p>"; ?>

<form method="post">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="contact" placeholder="Contact Number" required>
    <input type="text" name="address" placeholder="Address" required>
    <button type="submit">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

<?php include("includes/footer.php"); ?>
