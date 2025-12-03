<?php
include 'db_connect.php';

$booking = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact = $conn->real_escape_string($_POST['contact_number']);

    $sql = "SELECT * FROM ambulance_bookings 
            WHERE contact_number='$contact' 
            ORDER BY booking_time DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
    } else {
        $error = "❌ No booking found for this contact number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track Ambulance - E-Health</title>
  <link rel="stylesheet" href="ambulance.css">
</head>
<body>
<div class="container">
  <h1>Track Your Ambulance</h1>

  <form method="POST" action="">
    <input type="tel" name="contact_number" placeholder="Enter your Contact Number" required>
    <button type="submit">Track</button>
  </form>

  <?php
  if($error) {
      echo "<p style='color:red;'>$error</p>";
  }

  if($booking) {
      echo "<div class='booking-info'>";
      echo "<h2>Booking Details</h2>";
      echo "<p><strong>Pickup Location:</strong> " . $booking['pickup_location'] . "</p>";
      echo "<p><strong>Drop Location:</strong> " . $booking['drop_location'] . "</p>";
      echo "<p><strong>Ambulance Type:</strong> " . $booking['ambulance_type'] . "</p>";
      echo "<p><strong>Booking Time:</strong> " . $booking['booking_time'] . "</p>";
      echo "<p><strong>Status:</strong> " . $booking['status'] . "</p>";
      echo "</div>";
  }
  ?>
</div>
</body>
</html>
