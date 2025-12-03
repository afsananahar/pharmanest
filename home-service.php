<?php
include 'db_connect.php'; // include your database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $conn->real_escape_string($_POST['service']);
    $time = $conn->real_escape_string($_POST['time']);
    $address = $conn->real_escape_string($_POST['address']);

    // Set price dynamically
    if ($service === 'lab') $price = 500;
    elseif ($service === 'nursing') $price = 800;
    elseif ($service === 'physio') $price = 1000;
    else $price = 0;

    // Insert booking into database
    $sql = "INSERT INTO home_services (service_type, booking_time, address, price)
            VALUES ('$service', '$time', '$address', '$price')";

    if ($conn->query($sql) === TRUE) {
        $success = "✅ Booking successful! Estimated price: {$price} BDT";
    } else {
        $error = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Service - E-Health</title>
  <link rel="stylesheet" href="home-service.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      <li><a href="Medicine.php">Medicine</a></li>
      <li><a href="lab-test.php">Lab Test</a></li>
      <li><a href="ambulance.php">Ambulance</a></li>
      <li><a href="home-service.php" class="active">Services</a></li>
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

<section class="services">
  <div class="container">
    <h2>Home Service Categories</h2>
    <div class="service-cards">
      <div class="card">
        <i class="fa-solid fa-vial"></i>
        <h3>Lab Test</h3>
        <p>Blood, Urine, and other lab tests at home</p>
      </div>
      <div class="card">
        <i class="fa-solid fa-user-nurse"></i>
        <h3>Nursing Service</h3>
        <p>Professional nursing care at your doorstep</p>
      </div>
      <div class="card">
        <i class="fa-solid fa-dumbbell"></i>
        <h3>Physiotherapy</h3>
        <p>Expert physiotherapy sessions at home</p>
      </div>
    </div>
  </div>
</section>

<section class="booking">
  <div class="container">
    <h2>Book a Service</h2>
    <form method="POST" action="">
      <label for="service">Select Service</label>
      <select id="service" name="service" required>
        <option value="">--Choose a Service--</option>
        <option value="lab">Lab Test</option>
        <option value="nursing">Nursing Service</option>
        <option value="physio">Physiotherapy</option>
      </select>

      <label for="time">Select Date & Time</label>
      <input type="datetime-local" id="time" name="time" required>

      <label for="address">Address</label>
      <textarea id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>

      <button type="submit">Calculate Price & Proceed</button>
    </form>

    <?php
      if(isset($success)) echo "<p style='color:green; margin-top:10px;'>$success</p>";
      if(isset($error)) echo "<p style='color:red; margin-top:10px;'>$error</p>";
    ?>
  </div>
</section>

<section class="payment">
  <div class="container">
    <h2>Payment</h2>
    <p>After booking, you can pay via mobile banking, card, or online payment.</p>
    <button class="pay-btn">Pay Now</button>
  </div>
</section>

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
