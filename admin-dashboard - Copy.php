<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.html");
    exit;
}

include 'db_connect.php'; // Your database connection file

// Fetch counts
$doctorCount = $conn->query("SELECT COUNT(*) as total FROM doctors")->fetch_assoc()['total'];
$ambulanceCount = $conn->query("SELECT COUNT(*) as total FROM ambulance_bookings")->fetch_assoc()['total'];
$medicineCount = $conn->query("SELECT COUNT(*) as total FROM medicines")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - PharmaNest</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0f7fa, #ffffff);
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: #00bfa5;
      color: white;
      width: 100%;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    header h1 {
      margin: 0;
      font-size: 22px;
      font-weight: 600;
    }

    .admin-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .admin-photo {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid white;
    }

    .logout-btn {
      background: #f44336;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      text-decoration: none;
      transition: 0.3s;
    }

    .logout-btn:hover {
      background: #d32f2f;
    }

    .container {
      padding: 40px 30px;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .welcome-text {
      text-align: center;
      margin-bottom: 30px;
    }

    .welcome-text h2 {
      color: #00bfa5;
      margin-bottom: 5px;
    }

    .cards {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      background: white;
      width: 180px;
      height: 140px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-decoration: none;
      color: #333;
      font-weight: 600;
      transition: 0.3s;
      position: relative;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .card i {
      font-size: 30px;
      margin-bottom: 10px;
      color: #00bfa5;
    }

    .count {
      position: absolute;
      top: 10px;
      right: 15px;
      background: #00bfa5;
      color: white;
      font-size: 16px;
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 50px;
    }

    footer {
      margin-top: auto;
      background: #00bfa5;
      color: white;
      text-align: center;
      padding: 10px 0;
      width: 100%;
      font-size: 14px;
    }
  </style>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <h1>PharmaNest Admin Dashboard</h1>
    <div class="admin-info">
      <?php if (!empty($_SESSION['photo'])): ?>
        <img src="<?php echo $_SESSION['photo']; ?>" alt="Admin Photo" class="admin-photo">
      <?php else: ?>
        <img src="https://via.placeholder.com/40" alt="Admin Photo" class="admin-photo">
      <?php endif; ?>
      <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
      <a href="index.php" class="logout-btn">🚪 Logout</a>
    </div>
  </header>

  <div class="container">
    <div class="welcome-text">
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
      <p>Manage all sections from here</p>
    </div>

    <div class="cards">
      <a href="admin-doctors.php" class="card">
        <div class="count"><?php echo $doctorCount; ?></div>
        <i class="fas fa-user-md"></i>
        Doctors
      </a>

      <a href="admin-ambulances.php" class="card">
        <div class="count"><?php echo $ambulanceCount; ?></div>
        <i class="fas fa-ambulance"></i>
        Ambulances
      </a>

      <a href="admin-medicine.php" class="card">
        <div class="count"><?php echo $medicineCount; ?></div>
        <i class="fas fa-pills"></i>
        Medicines
      </a>
           <a href="view-appointments.php" class="card">
        <div class="count"><?php echo $medicineCount; ?></div>
        <i class="fas fa-pills"></i>
       Appointments
      </a>

    </div>
  </div>

  <footer>
    &copy; <?php echo date("Y"); ?> PharmaNest. All rights reserved.
  </footer>
</body>
</html>
