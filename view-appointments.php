<?php
include 'db_connect.php';

// Fetch all appointments with doctor names
$result = $conn->query("
    SELECT a.id, d.name AS doctor_name, a.patient_name, a.patient_phone, a.appointment_date, a.appointment_time
    FROM appointments a
    JOIN doctors d ON a.doctor_id = d.id
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - All Appointments</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    .appointments-container {
      max-width: 1000px;
      margin: 60px auto;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #222;
      margin-bottom: 40px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #45a049;
      color: white;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f1f1f1;
    }
    .back-btn {
      display: inline-block;
      margin: 20px 0;
      background: #45a049;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }
    .back-btn:hover {
      background: #3c8c3f;
    }
    @media (max-width: 768px) {
      th, td {
        padding: 8px;
      }
      table {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="appointments-container">
    <h1>All Booked Appointments</h1>
    <a href="admin-dashboard.php" class="back-btn">← Back to Dashboard</a>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Doctor Name</th>
          <th>Patient Name</th>
          <th>Phone</th>
          <th>Date</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $count = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$count}</td>
                    <td>{$row['doctor_name']}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['patient_phone']}</td>
                    <td>{$row['appointment_date']}</td>
                    <td>{$row['appointment_time']}</td>
                  </tr>";
            $count++;
          }
        } else {
          echo "<tr><td colspan='6' style='text-align:center;'>No appointments found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
