<?php
include("includes/db.php");

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

$product_id = $_POST['product_id'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$rooms = $_POST['rooms'];

$price = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT product_price FROM products WHERE product_id=$product_id")
)['product_price'];

$days = (strtotime($check_out) - strtotime($check_in)) / 86400;
$total = $price * $days * $rooms;

mysqli_query($conn, "
INSERT INTO booking (customer_id, product_id, total, check_in, check_out, number_of_rooms)
VALUES ('{$_SESSION['customer_id']}', '$product_id', '$total', '$check_in', '$check_out', '$rooms')
");

echo "<h2>Booking Successful!</h2>";
echo "<a href='rooms.php'>Back to Rooms</a>";
