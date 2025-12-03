<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
        }

        /* Top Navbar */
        .navbar {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 12px;
            border-radius: 5px;
            background-color: #4CAF50;
            transition: 0.3s;
        }

        .navbar a:hover {
            background-color: #4CAF50;
        }

        /* Dashboard Container */
        .dashboard {
            max-width: 1000px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Welcome Card */
        .welcome-card {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .welcome-card h2 {
            margin-bottom: 10px;
            color: #4CAF50;
        }

        /* Cards Section */
        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background-color: white;
            flex: 1 1 250px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .card h3 {
            margin-bottom: 15px;
            color: #4CAF50'

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }

        .card a:hover {
            background-color: #4CAF50;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>User Dashboard</h1>
        <a href="index.php">Logout</a>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard">

        <!-- Welcome Card -->
        <div class="welcome-card">
            <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
            <p>Manage your health services easily from here.</p>
        </div>

        <!-- Quick Access Cards -->
        <div class="cards">
            <div class="card">
                <h3>Book Lab Tests</h3>
                <p>Schedule lab tests with a few clicks.</p>
                <a href="lab-tests.php">Book Now</a>
            </div>
            <div class="card">
                <h3>View Medicines</h3>
                <p>Check available medicines and orders.</p>
                <a href="medicines.php">View Medicines</a>
            </div>
            <div class="card">
                <h3>Request Ambulance</h3>
                <p>Quick ambulance requests for emergencies.</p>
                <a href="ambulances.php">Request Now</a>
            </div>
        </div>

    </div>

</body>
</html>
