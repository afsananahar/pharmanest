<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Directory</title>
  <link rel="stylesheet" href="hospital.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header class="header">
  <div class="logo">
    <img src="PH1.png" alt="PharmaNest Logo">
    <span>PharmaNest</span>
  </div>
  <nav class="navbar">
    <ul class="nav-links">
      <li><a href="index.html">Home</a></li>
      <li><a href="doctor-directory.html">Doctors</a></li>
      <li><a href="hospital.php">Hospitals</a></li>
      <li><a href="Medicine.html">Medicine</a></li>
      <li><a href="lab-test.html">Lab Test</a></li>
      <li><a href="ambulance.html">Ambulance</a></li>
      <li><a href="home-service.html">Services</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <h1>Find a Hospital</h1>

  <!-- Filter & Search -->
  <form method="GET" class="filters">
    <input type="text" name="search" placeholder="Search Hospital Name..." value="<?php echo $_GET['search'] ?? ''; ?>">
    <select name="type">
      <option value="">Hospital Type</option>
      <option>General</option>
      <option>Specialized</option>
      <option>Clinic</option>
    </select>
    <select name="service">
      <option value="">Services</option>
      <option>Emergency</option>
      <option>ICU</option>
      <option>Diagnostic</option>
    </select>
    <button type="submit"><i class="fas fa-search"></i> Search</button>
  </form>

  <div class="map" style="width:100%; height:400px;">
    <iframe 
      src="https://www.openstreetmap.org/export/embed.html?bbox=91.1705,23.4500,91.2000,23.4800&layer=mapnik" 
      style="border:0; width:100%; height:100%;" 
      allowfullscreen loading="lazy">
    </iframe>
  </div>

  <!-- Hospital List -->
  <div class="hospital-list">
    <?php
      $query = "SELECT * FROM hospitals WHERE 1";

      if (!empty($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
        $query .= " AND name LIKE '%$search%'";
      }

      if (!empty($_GET['type'])) {
        $type = $conn->real_escape_string($_GET['type']);
        $query .= " AND type='$type'";
      }

      if (!empty($_GET['service'])) {
        $service = $conn->real_escape_string($_GET['service']);
        $query .= " AND service='$service'";
      }

      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
          <div class='hospital-card'>
            <h3>{$row['name']}</h3>
            <p><i class='fas fa-location-dot'></i> {$row['location']}</p>
            <p><i class='fas fa-phone'></i> {$row['phone']}</p>
            <p><i class='fas fa-star'></i> Rating: {$row['rating']}</p>
            <button>View Details</button>
          </div>";
        }
      } else {
        echo "<p>No hospitals found.</p>";
      }

      $conn->close();
    ?>
  </div>
</div>

<footer class="footer">
  <div class="footer-container">
    <div class="footer-section about">
      <h3>About PharmaNest</h3>
      <p>PharmaNest is your one-stop solution for booking doctors, ordering medicines, and accessing healthcare services online.</p>
    </div>
    <div class="footer-section contact">
      <h3>Contact</h3>
      <p>Email: support@ehealth.com</p>
      <p>Phone: +880 1234 567890</p>
      <p>Address: Cumilla, Bangladesh</p>
    </div>
    <div class="footer-section social">
      <h3>Follow Us</h3>
      <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
      <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; 2025 PharmaNest. All Rights Reserved. Design by Nafiz and Afsan.
  </div>
</footer>

</body>
</html>
