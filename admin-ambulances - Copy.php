<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}

include 'db_connect.php';

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = intval($_POST['booking_id']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE ambulance_bookings SET status='$status' WHERE id=$id";
    $conn->query($sql);
}

// Fetch all bookings
$sql = "SELECT * FROM ambulance_bookings ORDER BY booking_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Ambulance Bookings</title>
  <link rel="stylesheet" href="ambulance.css">
  <style>
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .admin-header h2 {
        margin: 0;
    }
    .button {
        display: inline-block;
        background:#007bff;
        color:#fff;
        padding:8px 15px;
        border-radius:5px;
        text-decoration:none;
        font-weight:bold;
        transition:0.3s;
    }
    .button:hover { background:#0056b3; }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table th, table td {
        border:1px solid #ccc;
        padding:8px;
        text-align:center;
    }
    table th {
        background:#f4f4f4;
    }
    .booking-info select {
        padding:5px;
    }
    .booking-info button {
        padding:5px 10px;
        background:#28a745;
        color:#fff;
        border:none;
        border-radius:3px;
        cursor:pointer;
    }
    .booking-info button:hover { background:#218838; }
  </style>
</head>
<body>
<div class="container">
    <div class="admin-header">
        <h2>Welcome, Admin!</h2>
        <div>
            <a href="admin-doctors.php" class="button">View All Doctors</a>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>

    <h3>Ambulance Bookings</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pickup</th>
                <th>Drop</th>
                <th>Contact</th>
                <th>Ambulance Type</th>
                <th>Booking Time</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['pickup_location'] ?></td>
                <td><?= $row['drop_location'] ?></td>
                <td><?= $row['contact_number'] ?></td>
                <td><?= $row['ambulance_type'] ?></td>
                <td><?= $row['booking_time'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                        <select name="status" required>
                            <option value="Pending" <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                            <option value="En Route" <?= $row['status']=='En Route'?'selected':'' ?>>En Route</option>
                            <option value="Arrived" <?= $row['status']=='Arrived'?'selected':'' ?>>Arrived</option>
                        </select>
                        <button type="submit" name="update_status">Update</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
