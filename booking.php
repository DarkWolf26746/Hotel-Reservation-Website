<?php
include("includes/db.php");

// Redirect if not logged in
if(!isset($_SESSION['customer_id'])){
    header("Location: login.php");
    exit();
}

// Get POST data safely
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$check_in = $_POST['check_in'] ?? '';
$check_out = $_POST['check_out'] ?? '';
$rooms = isset($_POST['rooms']) ? intval($_POST['rooms']) : 1;

// Validate inputs
if(!$product_id || !$check_in || !$check_out || $rooms < 1){
    die("<p>Invalid booking details. <a href='rooms.php'>Go back</a></p>");
}

if(strtotime($check_out) <= strtotime($check_in)){
    die("<p>Check-out date must be after check-in. <a href='rooms.php'>Go back</a></p>");
}

// Fetch room details
$room_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id=$product_id");
if(mysqli_num_rows($room_query) == 0){
    die("<p>Invalid room selected. <a href='rooms.php'>Go back</a></p>");
}

$room = mysqli_fetch_assoc($room_query);
$price = $room['product_price'];

// Calculate number of nights and total cost
$days = (strtotime($check_out) - strtotime($check_in)) / 86400;
$total = $price * $days * $rooms;

// Insert booking and get inserted ID
mysqli_query($conn, "
    INSERT INTO booking (customer_id, product_id, total, check_in, check_out, number_of_rooms)
    VALUES ('{$_SESSION['customer_id']}', '$product_id', '$total', '$check_in', '$check_out', '$rooms')
");
$booking_id = mysqli_insert_id($conn);

// Format price
function formatPrice($amount){
    return "Rs. " . number_format($amount, 2);
}

// Generate booking reference (e.g., "LUX2025XXXX")
$booking_ref = "LUX" . date("Y") . str_pad($booking_id, 4, "0", STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .confirmation-card {
            max-width: 500px;
            margin: 60px auto;
            background: rgba(255,255,255,0.9);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
            font-family: 'Poppins', sans-serif;
        }
        .confirmation-card h2 {
            color: #0077b6;
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
        }
        .confirmation-card p {
            font-size: 16px;
            margin: 8px 0;
            color: #111;
        }
        .confirmation-card a, .confirmation-card button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: linear-gradient(135deg, #0aa4d8, #0077b6);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }
        .confirmation-card button:hover, .confirmation-card a:hover {
            opacity: 0.9;
        }
    </style>
    <script>
        function printBooking() {
            const content = document.getElementById('booking-summary').innerHTML;
            const myWindow = window.open('', 'Print', 'height=600,width=800');
            myWindow.document.write('<html><head><title>Booking Summary</title>');
            myWindow.document.write('<style>body{font-family: Poppins, sans-serif; padding:20px;} h2{color:#0077b6;}</style>');
            myWindow.document.write('</head><body>');
            myWindow.document.write(content);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.print();
        }
    </script>
</head>
<body>

<div class="confirmation-card" id="booking-summary">
    <h2>Booking Confirmed!</h2>
    <p><strong>Booking Reference:</strong> <?= $booking_ref; ?></p>
    <p><strong>Room:</strong> <?= htmlspecialchars($room['product_title']); ?></p>
    <p><strong>Check-in:</strong> <?= htmlspecialchars($check_in); ?></p>
    <p><strong>Check-out:</strong> <?= htmlspecialchars($check_out); ?></p>
    <p><strong>Number of Rooms:</strong> <?= $rooms; ?></p>
    <p><strong>Nights:</strong> <?= $days; ?></p>
    <p><strong>Total Price:</strong> <?= formatPrice($total); ?></p>

    <button onclick="printBooking()">Print Booking Summary</button>
    <a href="rooms.php">Back to Rooms</a>
</div>

</body>
</html>
