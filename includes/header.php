<?php
// Start session safely
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LUX Hotel</title>
    <link rel="stylesheet" href="/hotel1/css/style.css">
</head>
<body>

<nav>
    <div class="logo">LUX Hotel</div>
    <div class="nav-links">
        <a href="/hotel1/index.php">Home</a>
        <a href="/hotel1/rooms.php">Rooms</a>

        <?php if (isset($_SESSION['customer_id'])): 
            // Include DB connection to get user name
            include($_SERVER['DOCUMENT_ROOT'] . "/hotel1/includes/db.php");

            $user_id = $_SESSION['customer_id'];
            $user_q = mysqli_query($conn, "SELECT customer_name FROM customers WHERE customer_id='$user_id'");
            $user = mysqli_fetch_assoc($user_q);
        ?>
            <a href="/hotel1/profile.php" class="profile-link">
                <!-- Always show default vector image -->
                <img src="/hotel1/images/profile.png" 
                     alt="Profile" class="nav-profile-pic">
                <?= htmlspecialchars($user['customer_name']); ?>
            </a>
            <a href="/hotel1/logout.php">Logout</a>
        <?php else: ?>
            <a href="/hotel1/login.php">Login</a>
            <a href="/hotel1/register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
