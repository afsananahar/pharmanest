<?php
include 'db_connect.php';

// Handle appointment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctorName = $_POST['doctorName'] ?? '';
    $patientName = $_POST['patientName'] ?? '';
    $patientPhone = $_POST['patientPhone'] ?? '';
    $appointmentDate = $_POST['appointmentDate'] ?? '';
    $appointmentTime = $_POST['appointmentTime'] ?? '';

    // Get doctor ID from name
    $stmt = $conn->prepare("SELECT id FROM doctors WHERE name = ?");
    $stmt->bind_param("s", $doctorName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
        $doctorId = $doctor['id'];

        // Insert appointment
        $insert = $conn->prepare("INSERT INTO appointments (doctor_id, patient_name, patient_phone, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param("issss", $doctorId, $patientName, $patientPhone, $appointmentDate, $appointmentTime);
        if ($insert->execute()) {
            echo "<script>alert('Appointment booked successfully!'); window.location.href='doctor-directory.php';</script>";
        } else {
            echo "<script>alert('Failed to book appointment.');</script>";
        }
    } else {
        echo "<script>alert('Doctor not found.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Directory - Cumilla</title>
  <link rel="stylesheet" href="doctor-directory.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<!-- Header -->
<header class="header">
  <div class="logo">
    <img src="PH1.png" alt="PharmaNest Logo">
    <span>PharmaNest</span>
  </div>

  <nav class="navbar">
    <ul class="nav-links" id="navLinks">
      <li><a href="index.php">Home</a></li>
      <li><a href="doctor-directory.php" class="active">Doctors</a></li>
      <li><a href="hospital.php">Hospitals</a></li>
      <li><a href="Medicine.php">Medicine</a></li>
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

<body>
  <section class="doctor-directory">
    <h1>Find Specialist Doctors in Cumilla</h1>

    <!-- 🔎 Search & Filter -->
    <div class="search-filter">
      <input type="text" id="searchInput" placeholder="Search by Name or Speciality...">
      <select id="categoryFilter">
        <option value="all">All Categories</option>
        <?php
        // Fetch distinct specialties for the dropdown
        $specialties = $conn->query("SELECT DISTINCT speciality FROM doctors");
        while ($spec = $specialties->fetch_assoc()) {
          echo "<option value='{$spec['speciality']}'>{$spec['speciality']}</option>";
        }
        ?>
      </select>
    </div>

    <!-- Doctor List -->
    <div class="doctor-list" id="doctorList">
      <?php
      $result = $conn->query("SELECT * FROM doctors WHERE city='Cumilla' ORDER BY id DESC");
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
          <div class='doctor-card' data-category='{$row['speciality']}'>
            <img src='{$row['photo']}' alt='{$row['name']}'>
            <div class='doctor-info'>
              <h2>{$row['name']}</h2>
              <p><i class='fas fa-stethoscope'></i> {$row['speciality']}</p>
              <p><i class='fas fa-user-graduate'></i> {$row['qualification']}</p>
              <p><i class='fas fa-hospital'></i> {$row['hospital']}</p>
              <p><i class='fas fa-clock'></i> {$row['timing']}</p>
              <p><i class='fas fa-phone'></i> {$row['phone']}</p>
              <button class='book-btn'>Book Appointment</button>
            </div>
          </div>";
        }
      } else {
        echo "<p>No doctors found in Cumilla.</p>";
      }
      ?>
    </div>

    <!-- 📌 Appointment Modal -->
<div class="modal" id="appointmentModal">
  <div class="modal-content">
    <span class="close-btn" id="closeModal">&times;</span>
    <h2 id="doctorName">Book Appointment</h2>
    <form method="POST" action="">
      <!-- Hidden field for doctor name -->
      <input type="hidden" name="doctorName" id="modalDoctorName">

      <input type="text" name="patientName" placeholder="Your Name" required>
      <input type="text" name="patientPhone" placeholder="Contact Number" required>
      <input type="date" name="appointmentDate" required>
      <input type="time" name="appointmentTime" required>
      <button type="submit">Confirm Appointment</button>
    </form>
  </div>
</div>

<style>
  /* Modal Styles */
  .modal {
    display: none; 
    position: fixed; 
    z-index: 999; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0,0,0,0.5); 
  }

  .modal-content {
    background-color: #fff;
    margin: 80px auto;
    padding: 30px;
    border-radius: 12px;
    max-width: 500px;
    text-align: center;
    position: relative;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }

  .close-btn {
    position: absolute;
    top: 12px;
    right: 16px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    color: #333;
  }

  .modal-content h2 {
    margin-bottom: 20px;
    color: #222;
  }

  .modal-content input, 
  .modal-content button {
    width: 90%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 16px;
  }

  .modal-content button {
    background-color: #45a049;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: 0.3s;
  }

  .modal-content button:hover {
    background-color: #3c8c3f;
  }
</style>

<script>
  // Modal JS
  const modal = document.getElementById('appointmentModal');
  const closeModal = document.getElementById('closeModal');
  const doctorNameField = document.getElementById('doctorName');
  const doctorInputField = document.getElementById('modalDoctorName');

  // Open modal on click of any button with class 'book-btn'
  const bookButtons = document.querySelectorAll('.book-btn');
  bookButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      const doctorCard = e.target.closest('.doctor-card');
      const doctorName = doctorCard.querySelector('h2').innerText;

      doctorNameField.innerText = `Book Appointment with ${doctorName}`;
      doctorInputField.value = doctorName;
      modal.style.display = 'block';
    });
  });

  // Close modal
  closeModal.addEventListener('click', () => modal.style.display = 'none');
  window.addEventListener('click', (e) => {
    if (e.target === modal) modal.style.display = 'none';
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
