<?php
include("includes/db.php");
include("includes/header.php");

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<h2>Available Rooms</h2>

<div class="rooms">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="room">
        <img src="images/<?= $row['product_img1']; ?>">
        <h3><?= $row['product_title']; ?></h3>
        <p><?= $row['product_desc']; ?></p>
        <p><b>Rs. <?= $row['product_price']; ?>/night</b></p>
        <a href="room.php?id=<?= $row['product_id']; ?>">Book Now</a>
    </div>
<?php endwhile; ?>
</div>

<?php include("includes/footer.php"); ?>
