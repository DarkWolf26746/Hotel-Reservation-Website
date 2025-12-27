<?php
include("includes/db.php");

if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['customer_id'];

// Handle deletion
if(isset($_GET['delete_booking'])) {
    $delete_id = intval($_GET['delete_booking']);
    mysqli_query($conn, "DELETE FROM booking WHERE booking_id='$delete_id' AND customer_id='$user_id'");
    header("Location: profile.php");
    exit();
}

// Fetch user info
$user_q = mysqli_query($conn, "SELECT customer_name, customer_email, customer_contact, customer_address, customer_image FROM customers WHERE customer_id='$user_id'");
$user = mysqli_fetch_assoc($user_q);
$profile_img = $user['customer_image'] ? $user['customer_image'] : "default-profile.png";

// Fetch user bookings
$bookings_q = mysqli_query($conn, "
    SELECT b.*, p.product_title, p.product_img1
    FROM booking b
    JOIN products p ON b.product_id = p.product_id
    WHERE b.customer_id='$user_id'
    ORDER BY b.booking_id DESC
");
?>

<?php include("includes/header.php"); ?>

<div class="profile-page-container">

    <!-- Profile Info Card -->
    <div class="profile-card">
        <img src="images/profile.png" alt="Profile" class="nav-profile-pic">
        <h3><?= htmlspecialchars($user['customer_name']); ?></h3>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['customer_email']); ?></p>
        <p><strong>Contact:</strong> <?= htmlspecialchars($user['customer_contact']); ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($user['customer_address']); ?></p>
    </div>

    <!-- User Bookings -->
    <div class="user-bookings-section">
        <h3>Your Bookings</h3>
        <button class="print-btn" onclick="window.print()">Print Booking History</button>
        <div class="booking-cards">
            <?php if(mysqli_num_rows($bookings_q) > 0): ?>
                <?php while($booking = mysqli_fetch_assoc($bookings_q)): ?>
                    <div class="booking-card">
                        <img src="images/<?= htmlspecialchars($booking['product_img1']); ?>" alt="<?= htmlspecialchars($booking['product_title']); ?>">
                        <div class="booking-info">
                            <h4><?= htmlspecialchars($booking['product_title']); ?></h4>
                            <p><strong>Check-in:</strong> <?= $booking['check_in']; ?></p>
                            <p><strong>Check-out:</strong> <?= $booking['check_out']; ?></p>
                            <p><strong>Rooms:</strong> <?= $booking['number_of_rooms']; ?></p>
                            <p><strong>Total:</strong> Rs. <?= $booking['total']; ?></p>
                            <p><strong>Booking Ref:</strong> <?= $booking['booking_id']; ?></p>
                            <a href="profile.php?delete_booking=<?= $booking['booking_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to cancel this booking?');">Cancel Booking</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>You have not booked any rooms yet.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?php include("includes/footer.php"); ?>

