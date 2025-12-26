<?php
include("../includes/db.php");
if(!isset($_SESSION['admin'])) header("Location: login.php");

$count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM booking"));
?>

<h2>Admin Dashboard</h2>
<p>Total Bookings: <?= $count['total']; ?></p>
