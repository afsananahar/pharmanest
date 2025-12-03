<?php
include 'db_connect.php'; // Your existing DB connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pickup = $conn->real_escape_string($_POST['pickup_location']);
    $drop = $conn->real_escape_string($_POST['drop_location']);
    $contact = $conn->real_escape_string($_POST['contact_number']);
    $type = $conn->real_escape_string($_POST['ambulance_type']);

    if (!empty($pickup) && !empty($drop) && !empty($contact) && !empty($type)) {
       $sql = "INSERT INTO ambulance_bookings 
        (pickup_location, drop_location, contact_number, ambulance_type, status)
        VALUES ('$pickup', '$drop', '$contact', '$type', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            $success = "✅ Booking successful!";
        } else {
            $error = "❌ Error: " . $conn->error;
        }
    } else {
        $error = "❌ Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ambulance Booking - E-Health</title>
  <link rel="stylesheet" href="ambulance.css">
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
    // Mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      menuToggle.querySelector('i').classList.toggle('fa-bars');
      menuToggle.querySelector('i').classList.toggle('fa-times');
    });

    // Select ambulance type when button clicked
    function selectAmbulance(type) {
      document.getElementById('ambulanceType').value = type;
      window.scrollTo({ top: document.querySelector('.booking-form').offsetTop, behavior: 'smooth' });
    }
  </script>

  <div class="container">
    <h1>Book an Ambulance</h1>

    <!-- Search Section -->
    <div class="search-section">
      <input type="text" placeholder="Enter your location...">
      <button><i class="fas fa-search"></i> Search</button>
    </div>

    <!-- Ambulance Types -->
    <div class="ambulance-types">
      <h2>Choose Ambulance Type</h2>
      <div class="type-card">
        <i class="fas fa-ambulance fa-2x"></i>
        <h3>AC Ambulance</h3>
        <p>Price Estimate: $50</p>
        <button type="button" onclick="selectAmbulance('AC Ambulance')">Select</button>
      </div>
      <div class="type-card">
        <i class="fas fa-ambulance fa-2x"></i>
        <h3>Non-AC Ambulance</h3>
        <p>Price Estimate: $40</p>
        <button type="button" onclick="selectAmbulance('Non-AC Ambulance')">Select</button>
      </div>
      <div class="type-card">
        <i class="fas fa-ambulance fa-2x"></i>
        <h3>ICU Support</h3>
        <p>Price Estimate: $100</p>
        <button type="button" onclick="selectAmbulance('ICU Support')">Select</button>
      </div>
    </div>

    <!-- Booking Form -->
    <div class="booking-form">
      <h2>Book Now</h2>
      <form method="POST" action="">
        <input type="text" name="pickup_location" placeholder="Pickup Location" required>
        <input type="text" name="drop_location" placeholder="Drop Location" required>
        <input type="tel" name="contact_number" placeholder="Contact Number" required>

        <select id="ambulanceType" name="ambulance_type" required>
          <option value="">Select Ambulance Type</option>
          <option value="AC Ambulance">AC Ambulance</option>
          <option value="Non-AC Ambulance">Non-AC Ambulance</option>
          <option value="ICU Support">ICU Support</option>
        </select>

        <button type="submit">Pay & Book</button>
      </form>

      <!-- Display success or error -->
      <?php
      if(isset($success)) echo "<p style='color:green;'>$success</p>";
      if(isset($error)) echo "<p style='color:red;'>$error</p>";
      ?>
    </div>
  </div>

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
