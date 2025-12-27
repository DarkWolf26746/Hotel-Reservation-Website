<?php
include("includes/db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $pass    = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Handle file upload
    $profile_image = 'default.png';
    if(isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK){
        $img_name = $_FILES['profile_image']['name'];
        $img_tmp  = $_FILES['profile_image']['tmp_name'];
        $img_ext  = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];

        if(in_array($img_ext, $allowed_ext)){
            $profile_image = uniqid() . '.' . $img_ext;
            move_uploaded_file($img_tmp, "images/" . $profile_image);
        } else {
            $message = "Invalid image format. Allowed: jpg, jpeg, png, webp.";
        }
    }

    // Duplicate email check
    $check = mysqli_query($conn, "SELECT * FROM customers WHERE customer_email='$email'");
    if(mysqli_num_rows($check) > 0){
        $message = "Email already registered!";
    } else {
        mysqli_query($conn, "
            INSERT INTO customers
            (customer_name, customer_email, customer_pass, customer_contact, customer_address, customer_image, customer_ip)
            VALUES
            ('$name', '$email', '$pass', '$contact', '$address', '$profile_image', '{$_SERVER['REMOTE_ADDR']}')
        ");

        $message = "Registration successful! You can login now.";
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="form-container">
    <form method="post" enctype="multipart/form-data">
        <h2>Create Account</h2>

        <?php if($message) echo "<p class='error-msg'>$message</p>"; ?>

        <span class="motto">Your Luxury, Our Priority</span>

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="contact" placeholder="Contact Number" required>
        <input type="text" name="address" placeholder="Address" required>
        <label for="profile_image">Profile Picture:</label>
        <input type="file" name="profile_image" accept="image/*">
        <button type="submit">Register</button>

        <p class="form-footer">Already have an account? <a href="login.php">Login</a></p>
    </form>
</div>

<?php include("includes/footer.php"); ?>
