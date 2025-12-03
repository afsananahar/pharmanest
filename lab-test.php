<?php
include 'db_connect.php';

// Fetch lab tests for dynamic dropdown and table
$testsResult = $conn->query("SELECT * FROM lab_tests");

// Handle Booking Form Submission
$bookingID = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fullName'])) {
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $address = $conn->real_escape_string($_POST['address']);
    $testName = $conn->real_escape_string($_POST['test_name']);

    $insert = $conn->query("INSERT INTO lab_bookings (full_name, test_name, phone, test_date, address) 
                            VALUES ('$fullName', '$testName', '$phone', '$date', '$address')");

    if($insert){
        $bookingID = $conn->insert_id;
    } else {
        echo "<script>alert('❌ Booking failed. Please try again.');</script>";
    }
}

// Handle Report Download Form Submission
$report = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phone_report'])) {
    $phoneReport = $conn->real_escape_string($_POST['phone_report']);
    $bookingIDInput = $conn->real_escape_string($_POST['bookingID']);

    $result = $conn->query("SELECT * FROM lab_bookings WHERE id='$bookingIDInput' AND phone='$phoneReport' LIMIT 1");

    if($result && $result->num_rows > 0){
        $report = $result->fetch_assoc();
    } else {
        echo "<script>alert('❌ No booking found with this ID and phone number.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab Test</title>
  <link rel="stylesheet" href="lab-test.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Popup Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 2000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      background: #fff;
      padding: 25px 30px;
      border-radius: 12px;
      text-align: center;
      max-width: 400px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      animation: fadeIn 0.3s ease;
    }
    .modal-content h2 {
      color: #0A8F68;
      margin-bottom: 10px;
    }
    .modal-content p {
      color: #333;
      font-size: 1rem;
      margin-bottom: 20px;
    }
    .close-btn {
      background: #0A8F68;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    .close-btn:hover {
      background: #05664C;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="header">
  <div class="logo">
    <img src="PH1.png" alt="PharmaNest Logo">
    <span>PharmaNest</span>
  </div>
  <nav class="navbar">
    <ul class="nav-links" id="navLinks">
      <li><a href="index.php">Home</a></li>
      <li><a href="doctor-directory.php">Doctors</a></li>
      <li><a href="hospital.php">Hospitals</a></li>
      <li><a href="medicine.php">Medicine</a></li>
      <li><a href="lab-test.php">Lab Test</a></li>
      <li><a href="ambulance.php">Ambulance</a></li>
      <li><a href="home-service.php">Services</a></li>
    </ul>
    <div class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i>
    </div>
  </nav>
  <div class="header-right">
    <button class="lang-btn" onclick="switchLanguage()">EN | বাংলা</button>
  </div>
</header>

<script>
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');
menuToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  menuToggle.querySelector('i').classList.toggle('fa-bars');
  menuToggle.querySelector('i').classList.toggle('fa-times');
});
</script>

<!-- Main Content -->
<header>
  <h1>🧪 Lab Test & Packages</h1>
  <p>Book your medical tests online with home sample collection.</p>
</header>

<!-- Search -->
<section class="search-bar">
  <input type="text" placeholder="Search Test (e.g., CBC, Blood Sugar)">
  <button><i class="fas fa-search"></i></button>
</section>

<!-- Popular Tests -->
<section class="tests">
  <h2>Popular Tests</h2>
  <table>
    <tr>
      <th>Test Name</th>
      <th>Price (৳)</th>
      <th>Report Time</th>
      <th>Action</th>
    </tr>
    <?php
    $tests = $conn->query("SELECT * FROM lab_tests ORDER BY id ASC");
    if($tests->num_rows > 0){
        while($test = $tests->fetch_assoc()){
            echo "<tr>
                    <td>{$test['name']}</td>
                    <td>{$test['price']}</td>
                    <td>{$test['report_time']}</td>
                    <td><button class='book-btn' onclick=\"fillBookingForm('{$test['name']}')\">Book</button></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No tests available</td></tr>";
    }
    ?>
  </table>
</section>

<!-- Packages -->
<section class="packages">
  <h2>Health Packages</h2>
  <div class="package-list">
    <?php
    $packages = $conn->query("SELECT * FROM lab_packages ORDER BY id ASC");
    if($packages->num_rows > 0){
        while($pkg = $packages->fetch_assoc()){
            echo "<div class='package'>
                    <h3>{$pkg['name']}</h3>
                    <p>{$pkg['description']}</p>
                    <span>৳ {$pkg['price']}</span>
                    <button class='book-btn' onclick=\"fillBookingForm('{$pkg['name']}')\">Book</button>
                  </div>";
        }
    } else {
        echo "<p>No packages available</p>";
    }
    ?>
  </div>
</section>

<!-- Booking Form -->
<section class="booking-form">
  <h2>Book Your Test</h2>
  <form method="post">
    <label>Select Test:</label>
    <select name="test_name" id="bookingTest" required>
      <?php
        $testsResult->data_seek(0); // reset pointer
        while($row = $testsResult->fetch_assoc()){
          echo "<option value='{$row['name']}'>{$row['name']}</option>";
        }
      ?>
    </select>
    <input type="text" name="fullName" placeholder="Full Name" required>
    <input type="tel" name="phone" placeholder="Phone Number" required>
    <input type="date" name="date" required>
    <input type="text" name="address" placeholder="Address (for home collection)">
    <button type="submit">Confirm Booking</button>
  </form>
</section>

<!-- Payment Gateway -->
<section class="payment">
  <h2>💳 Pay Online</h2>
  <div class="payment-options">
    <div class="pay-card">
      <i class="fas fa-mobile-alt"></i>
      <p>bKash</p>
    </div>
    <div class="pay-card">
      <i class="fas fa-wallet"></i>
      <p>Nagad</p>
    </div>
    <div class="pay-card">
      <i class="fas fa-credit-card"></i>
      <p>Credit/Debit Card</p>
    </div>
  </div>
  <button class="pay-btn">Proceed to Payment</button>
</section>

<!-- Download Report -->
<section class="report-download">
  <h2>📄 Download Report</h2>
<form method="POST" action="generate_report.php" target="_blank">

    <input type="text" name="bookingID" placeholder="Enter Booking ID" required>
    <input type="tel" name="phone_report" placeholder="Registered Phone Number" required>
    <button type="submit">Download Report</button>
  </form>

  <?php if($report): ?>
    <div class="report-result">
      <h3>🧾 Lab Test Report</h3>
      <p><strong>Booking ID:</strong> <?php echo $report['id']; ?></p>
      <p><strong>Name:</strong> <?php echo $report['full_name']; ?></p>
      <p><strong>Test:</strong> <?php echo $report['test_name']; ?></p>
      <p><strong>Date:</strong> <?php echo $report['test_date']; ?></p>
      <p><strong>Address:</strong> <?php echo $report['address']; ?></p>
      <p><strong>Booking Time:</strong> <?php echo $report['booking_time']; ?></p>
      <p>✅ Your report is ready. (PDF download feature coming soon!)</p>
    </div>
  <?php endif; ?>
</section>

<!-- Modal for Booking Confirmation -->
<div class="modal" id="bookingModal">
  <div class="modal-content">
    <h2>Booking Confirmed 🎉</h2>
    <p id="bookingMessage"></p>
    <button class="close-btn" id="closeModal">OK</button>
  </div>
</div>

<script>
function toggleChat() {
  document.getElementById('chatBody').classList.toggle('active');
}

function fillBookingForm(name) {
    document.getElementById('bookingTest').value = name;
    document.querySelector('.booking-form').scrollIntoView({behavior: "smooth"});
    alert('Selected: ' + name + ' - Please complete your details and confirm booking.');
}

// Show booking modal if success
const bookingID = <?php echo json_encode($bookingID); ?>;
if (bookingID) {
    document.getElementById('bookingModal').style.display = 'flex';
    document.getElementById('bookingMessage').textContent = '✅ Your booking has been confirmed! Your Booking ID is #' + bookingID;
}

document.getElementById('closeModal').addEventListener('click', () => {
  document.getElementById('bookingModal').style.display = 'none';
  window.location.href = 'lab-test.php';
});
</script>

<!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section about">
      <h3>About PharmaNest</h3>
      <p>PharmaNest is your one-stop solution for booking doctors, ordering medicines, calling ambulance, and accessing healthcare services online.</p>
    </div>

    <div class="footer-section contact">
      <h3>Contact</h3>
      <p>Email: support@ehealth.com</p>
      <p>Phone: +880 1234 567890</p>
      <p>Address: Cumilla, Bangladesh</p>
    </div>

    <div class="footer-section policies">
      <h3>Policies</h3>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="#">FAQ</a>
    </div>

    <div class="footer-section social">
      <h3>Follow Us</h3>
      <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
      <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
      <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
    </div>

    <div class="footer-section payments">
      <h3>We Accept</h3>
      <div class="payment-icons">
        <img src="visa.png" alt="Visa">
        <img src="Mas.png" alt="MasterCard">
        <img src="bkash.png" alt="Bkash">
        <img src="nagad.png" alt="Nagad">
        <img src="Roket.png" alt="Rocket">
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    &copy; 2025 PharmaNest. All Rights Reserved. Design by Nafiz and Afsan.
  </div>
</footer>

</body>
</html>
