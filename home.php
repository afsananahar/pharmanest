<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PharmaNest</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  

<!-- Floating medical icons -->
<i class="fas fa-plus floating-icon" style="top: 10%; left: 15%; animation-duration: 12s;"></i>
<i class="fas fa-pills floating-icon" style="top: 50%; left: 25%; animation-duration: 14s;"></i>
<i class="fas fa-heart floating-icon" style="top: 30%; left: 70%; animation-duration: 16s;"></i>
<i class="fas fa-stethoscope floating-icon" style="top: 80%; left: 50%; animation-duration: 18s;"></i>
<i class="fas fa-capsules floating-icon" style="top: 20%; left: 85%; animation-duration: 13s;"></i>
<i class="fas fa-syringe floating-icon" style="top: 60%; left: 10%; animation-duration: 17s;"></i>
<i class="fas fa-notes-medical floating-icon" style="top: 40%; left: 60%; animation-duration: 15s;"></i>

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
        <li><a href="ambulance-booking.php">Ambulance</a></li>
        <li><a href="home-service.php">Services</a></li>
      </ul>
      <div class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
      </div>
    </nav>

    <div class="header-right">
      <button class="lang-btn" onclick="switchLanguage()">EN | বাংলা</button>
   
      <!-- 🌙 Dark Mode Toggle -->
  <button id="dark-mode-toggle" class="dark-toggle">🌙</button>
    </div>
    
  </header>

  <!-- Search Section -->
  <section class="search-section">
    <div class="search-box">
      <input type="text" placeholder="Search here..." />
      <button><i class="fas fa-search"></i></button>
    </div>
  </section>

  <script>
    // Mobile menu toggle
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      menuToggle.querySelector('i').classList.toggle('fa-bars');
      menuToggle.querySelector('i').classList.toggle('fa-times');
    });
  </script>

  <!-- Banner -->
  <section class="banner">
    <h2 id="banner-text">Stay Healthy with PharmaNest</h2>
    <p id="banner-subtext">Book doctors, order medicines, call ambulance, all in one place.</p>
  </section>

  <!-- Quick Links -->
  <section class="quick-links">

    <a href="hospital.php" class="card">
        <i class="fa-solid fa-hospital"></i>
        <span>Hospital</span>
    </a>
    <a href="doctor-directory.php" class="card">
        <i class="fa-solid fa-user-doctor"></i>
        <span>Doctor Booking</span>
    </a>
    <a href="medicine.php" class="card">
        <i class="fa-solid fa-pills"></i>
        <span>Medicine</span>
    </a>
    <a href="lab-test.php" class="card">
        <i class="fa-solid fa-flask"></i>
        <span>Lab Test</span>
    </a>
    <a href="ambulance-booking.php" class="card">
        <i class="fa-solid fa-truck-medical"></i>
        <span>Ambulance</span>
    </a>
    <a href="home-service.php" class="card">
        <i class="fa-solid fa-house-medical"></i>
        <span>Home Service</span>
    </a>

      
  </section>


  <!-- Featured Services -->
<section class="featured-services">
  <h2 class="section-title">Our Services</h2>
  <div class="services-container">

    <a href="doctor-directory.php" class="service-card">
      <i class="fa-solid fa-user-doctor"></i>
      <h4>Certified Doctors</h4>
    </a>

    <a href="ambulance-booking.php" class="service-card">
      <i class="fa-solid fa-ambulance"></i>
      <h4>24/7 Ambulance</h4>
    </a>

    <a href="Medicine.php" class="service-card">
      <i class="fa-solid fa-pills"></i>
      <h4>Medicine Delivery</h4>
    </a>

    <a href="health-checkup.php" class="service-card">
      <i class="fa-solid fa-heart-pulse"></i>
      <h4>Health Checkup</h4>
    </a>

    <a href="specialist.php" class="service-card">
      <i class="fa-solid fa-stethoscope"></i>
      <h4>Specialist Consultation</h4>
    </a>

  </div>
</section>

 <!-- Health Tips / Blog Section -->
<section class="health-tips">
  <h2 class="section-title">Health Tips</h2>
  <div class="tips-container">
    
    <div class="tip-card">
      <i class="fa-solid fa-shield-virus"></i>
      <h4>5 Ways to Boost Immunity</h4>
      <p>Learn simple tips to strengthen your immune system daily.</p>
      <a href="tip-details.php?id=1" class="tip-btn">Read More</a>
    </div>
    
    <div class="tip-card">
      <i class="fa-solid fa-apple-whole"></i>
      <h4>Healthy Eating Habits</h4>
      <p>Discover the foods that promote long-term health.</p>
      <a href="tip-details.php?id=2" class="tip-btn">Read More</a>
    </div>
    
    <div class="tip-card">
      <i class="fa-solid fa-dumbbell"></i>
      <h4>Stay Active at Home</h4>
      <p>Simple exercises you can do without going to the gym.</p>
      <a href="tip-details.php?id=3" class="tip-btn">Read More</a>
    </div>

    <div class="tip-card">
      <i class="fa-solid fa-bed"></i>
      <h4>Improve Sleep Quality</h4>
      <p>Learn techniques for better sleep and overall health.</p>
      <a href="tip-details.php?id=4" class="tip-btn">Read More</a>
    </div>

    <div class="tip-card">
      <i class="fa-solid fa-water"></i>
      <h4>Stay Hydrated</h4>
      <p>Understand the importance of drinking enough water daily.</p>
      <a href="tip-details.php?id=5" class="tip-btn">Read More</a>
    </div>

    <div class="tip-card">
      <i class="fa-solid fa-brain"></i>
      <h4>Mental Wellness Tips</h4>
      <p>Simple practices to keep your mind healthy and focused.</p>
      <a href="tip-details.php?id=6" class="tip-btn">Read More</a>
    </div>

    <div class="tip-card">
      <i class="fa-solid fa-heart-pulse"></i>
      <h4>Heart Health Tips</h4>
      <p>Simple daily habits to maintain a strong and healthy heart.</p>
      <a href="tip-details.php?id=7" class="tip-btn">Read More</a>
    </div>

    <div class="tip-card">
      <i class="fa-solid fa-leaf"></i>
      <h4>Go Green</h4>
      <p>Incorporate more plants and eco-friendly habits into your life.</p>
      <a href="tip-details.php?id=8" class="tip-btn">Read More</a>
    </div>

  </div>
</section>

<!-- Popular Doctors / Featured Specialists -->
<section class="featured-doctors">
  <h2 class="section-title">Popular Specialists</h2>
  <div class="doctors-container">

    <div class="doctor-card">
      <img src="Prof.-Dr.-M-Abdullah-Al-Safi-Majumder.jpg" alt="Prof. Dr. Abdullah-Al-Safi Majumder">
      <h4>Prof. Dr. Abdullah-Al-Safi Majumder</h4>
      <p>Cardiologist</p>
      <a href="doctor-directory.php" class="book-btn">Book Now</a>
    </div>

    <div class="doctor-card">
      <img src="d2.jpeg" alt="Prof. Dr. Abida Sultana">
      <h4>Prof. Dr. Abida Sultana</h4>
      <p>Dermatologist</p>
      <a href="doctor-directory.php" class="book-btn">Book Now</a>
    </div>

    <div class="doctor-card">
      <img src="D3.jpeg" alt="Prof. Dr. Md. Ruhul Amin">
      <h4>Prof. Dr. Md. Ruhul Amin</h4>
      <p>Pediatrician</p>
      <a href="doctor-directory.php" class="book-btn">Book Now</a>
    </div>

    <div class="doctor-card">
      <img src="Rame.jpeg" alt="Prof. Dr. Ramesh Chandra Debnath">
      <h4>Prof. Dr. Ramesh Chandra Debnath</h4>
      <p>Neurologist</p>
      <a href="doctor-directory.php" class="book-btn">Book Now</a>
    </div>

    <div class="doctor-card">
      <img src="AT.jpeg" alt="Prof. Dr. Md. Habibullah Talukder">
      <h4>Prof. Dr. Md. Habibullah Talukder</h4>
      <p>Oncologist</p>
      <a href="doctor-directory.php" class="book-btn">Book Now</a>
    </div>

  </div>
</section>

  <<!-- Promotions / Offers -->
<section class="promotions">
  <h2 class="section-title">Latest Offers</h2>
  <div class="promo-cards">
    
    <div class="promo-card">
      <i class="fa-solid fa-stethoscope"></i>
      <h4>Free Health Checkup</h4>
      <p>Book a doctor this month and get a free checkup.</p>
      <a href="offer-details.php?id=1">Grab Offer</a>
    </div>

    <div class="promo-card">
      <i class="fa-solid fa-pills"></i>
      <h4>Medicine Discount</h4>
      <p>Get 15% off on selected medicines.</p>
      <a href="offer-details.php?id=2">Grab Offer</a>
    </div>

    <div class="promo-card">
      <i class="fa-solid fa-house-medical"></i>
      <h4>Home Service</h4>
      <p>Discount on your first home service booking.</p>
      <a href="offer-details.php?id=3">Grab Offer</a>
    </div>

    <div class="promo-card">
      <i class="fa-solid fa-heart-pulse"></i>
      <h4>Cardio Screening</h4>
      <p>Special heart checkup at a discounted rate this month.</p>
      <a href="offer-details.php?id=4">Grab Offer</a>
    </div>

    <div class="promo-card">
      <i class="fa-solid fa-syringe"></i>
      <h4>Vaccination Camp</h4>
      <p>Get your children vaccinated at reduced prices.</p>
      <a href="offer-details.php?id=5">Grab Offer</a>
    </div>

  </div>
</section>

 <!-- Newsletter / Subscription -->
<section class="newsletter">
  <h2 class="section-title">Subscribe for Updates</h2>
  <p>Get the latest health tips and offers directly in your inbox.</p>
  <form class="newsletter-form">
    <input type="email" placeholder="Enter your email" required>
    <button type="submit">Subscribe</button>
  </form>
</section>


  <!-- FAQs Section -->
  <section class="faqs">
    <h2 class="section-title">FAQs</h2>
    <div class="faq-container">
      <div class="faq-card">
        <h4>How do I book a doctor?</h4>
        <p>Click on the Doctors section, choose your specialist, and book an appointment.</p>
      </div>
      <div class="faq-card">
        <h4>Can I order medicines online?</h4>
        <p>Yes! Go to the Medicine section and place your order easily.</p>
      </div>
      <div class="faq-card">
        <h4>Is ambulance service available 24/7?</h4>
        <p>Absolutely, we provide round-the-clock ambulance services.</p>
      </div>
      <div class="faq-card">
  <h4>Do you offer home healthcare?</h4>
  <p>Yes! You can book home services for doctor visits, nursing, and physiotherapy.</p>
</div>

<div class="faq-card">
  <h4>Are the consultations online?</h4>
  <p>We provide both in-person and online consultations depending on your preference.</p>
</div>

    </div>
  </section>

  <!-- Partners / Certifications -->
  <section class="partners">
    <h2 class="section-title">Our Trusted Partners</h2>
    <div class="partners-container">
      <img src="sauare-pharma-logo.png" alt="Partner 1">
      <img src="BX.png" alt="Partner 2">
      <img src="inc.png" alt="Partner 3">
      <img src="re.png" alt="Partner 4">
    </div>
  </section>

  <!-- Testimonials -->
<section class="reviews">
  <h2 class="section-title">Reviews</h2>
  <div class="review-slider-wrapper">
    <div class="review-slider">
      <div class="review-card">
        <img src="nafizaaaa.png" alt="Nafiz ">
        <h4>Nafiz</h4>
        <p>"PharmaNest made booking doctors so easy! Highly recommend."</p>
      </div>
      <div class="review-card">
        <img src="Fahim.jpg" alt="Fahim">
        <h4>Fahim</h4>
        <p>"Fast ambulance service and excellent support from the team."</p>
      </div>
      <div class="review-card">
        <img src="Sumon.jpg" alt="Sumon">
        <h4>Sumon</h4>
        <p>"Ordering medicines online is super convenient and reliable."</p>
      </div>
    </div>
  </div>
</section>



 <!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    
    <!-- About -->
    <div class="footer-section about">
      <h3>About PharmaNest</h3>
      <p>PharmaNest is your one-stop solution for booking doctors, ordering medicines, calling ambulance, and accessing healthcare services online.</p>
    </div>

    <!-- Contact -->
    <div class="footer-section contact">
      <h3>Contact</h3>
      <p>Email: support@ehealth.com</p>
      <p>Phone: +880 1234 567890</p>
      <p>Address: Cumilla, Bangladesh</p>
    </div>

    <!-- Policies -->
    <div class="footer-section policies">
      <h3>Policies</h3>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms of Service</a>
      <a href="#">FAQ</a>
    </div>

    <!-- Social Media -->
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
