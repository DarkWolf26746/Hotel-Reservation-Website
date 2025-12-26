<?php
include("includes/db.php");
include("includes/header.php");

$id = $_GET['id'];
$room = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM products WHERE product_id=$id")
);
?>

<h2><?= $room['product_title']; ?></h2>
<img src="images/<?= $room['product_img1']; ?>" width="300">
<p><?= $room['product_desc']; ?></p>

<form action="booking.php" method="post">
    <input type="hidden" name="product_id" value="<?= $room['product_id']; ?>">
    Check-in:
    <input type="date" name="check_in" required>
    Check-out:
    <input type="date" name="check_out" required>
    Rooms:
    <input type="number" name="rooms" min="1" value="1">
    <button>Confirm Booking</button>
</form>

<?php include("includes/footer.php"); ?>
