<?php
include 'db_connect.php';
$result = $conn->query("SELECT * FROM home_service_bookings ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Home Service Bookings</title>
  <style>
    table { width: 90%; margin: 40px auto; border-collapse: collapse; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background: #007bff; color: white; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">All Home Service Bookings</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Service</th>
      <th>Date & Time</th>
      <th>Address</th>
      <th>Price (BDT)</th>
      <th>Booked On</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= ucfirst($row['service_type']) ?></td>
      <td><?= $row['booking_time'] ?></td>
      <td><?= $row['address'] ?></td>
      <td><?= $row['price'] ?></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
