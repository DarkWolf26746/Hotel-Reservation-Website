<?php
$conn = mysqli_connect("localhost", "root", "", "hotel");
if (!$conn) {
    die("Database connection failed");
}
session_start();
?>
