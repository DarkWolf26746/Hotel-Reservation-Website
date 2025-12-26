<?php
include("includes/db.php");
include("includes/header.php");

$about = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM about_us LIMIT 1"));
?>

<h1><?= $about['about_heading']; ?></h1>
<p><?= $about['about_short_desc']; ?></p>
<p><?= $about['about_desc']; ?></p>

<a href="rooms.php">Explore Rooms</a>

<?php include("includes/footer.php"); ?>
