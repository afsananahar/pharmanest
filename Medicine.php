<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Medicine | PharmaNest</title>

  <!-- CSS -->
  <link rel="stylesheet" href="Medicine.css">

  <!-- Font Awesome for icons -->
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
        <li><a href="Medicine.php" class="active">Medicine</a></li>
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

  <!-- JS for menu toggle -->
  <script>
    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    menuToggle.addEventListener('click', () => {
      navLinks.classList.toggle('active');
      menuToggle.querySelector('i').classList.toggle('fa-bars');
      menuToggle.querySelector('i').classList.toggle('fa-times');
    });
  </script>

  <!-- Main Site Content -->
  <div class="site">
    <header class="topbar">
      <div class="brand"></div>

      <div class="search-area">
        <input type="text" placeholder="Search for medicine (e.g. Paracetamol)" />
        <button class="btn search-btn"><i class="fa fa-search"></i> Search</button>
      </div>

      <div class="top-actions">
        <button class="btn secondary"><i class="fa fa-prescription-bottle"></i> Prescription</button>
        <button class="btn"><i class="fa fa-shopping-cart"></i> Cart <span class="cart-count">0</span></button>
      </div>
    </header>

    <main class="container">
      <aside class="filters">
        <h3>Filters</h3>

        <label>Category</label>
        <select>
          <option value="">All Categories</option>
          <option>Pain Killer</option>
          <option>Antibiotic</option>
          <option>Supplement</option>
          <option>Diabetes</option>
        </select>

        <label>Services</label>
        <div class="checkboxes">
          <label><input type="checkbox"/> Home Delivery</label>
          <label><input type="checkbox"/> Consultation</label>
          <label><input type="checkbox"/> In Stock</label>
        </div>

        <label>Rating</label>
        <select>
          <option value="">All</option>
          <option>4.5+</option>
          <option>4.0+</option>
          <option>3.5+</option>
        </select>

        <button class="btn full">Apply</button>
      </aside>

      <section class="product-area">
        <div class="product-header">
          <h2>Medicine List</h2>
          <p class="muted">Showing 8 results</p>
        </div>

        <div class="products-grid">
          <!-- Medicine Cards -->
          <?php
          $medicines = [
            ["Paracetamol 500mg", "Used to relieve pain and reduce fever", "ACME Pharma", "৳ 18 / strip", "https://via.placeholder.com/120x90?text=Paracetamol"],
            ["Amoxicillin 500mg", "Antibiotic (Requires doctor's prescription)", "HealthCorp", "৳ 55 / strip", "https://via.placeholder.com/120x90?text=Amoxicillin"],
            ["Vitamin D3 1000IU", "Supports bone strength and vitamin balance", "NutriPlus", "৳ 220 / bottle", "https://via.placeholder.com/120x90?text=Vitamin+D"],
            ["Glibenclamide 5mg", "Used to control diabetes (Doctor’s advice required)", "PharmaWell", "৳ 75 / strip", "https://via.placeholder.com/120x90?text=Glibenclamide"],
            ["Cough Syrup 100ml", "Used for cough and respiratory relief", "SyrupLabs", "৳ 150", "https://via.placeholder.com/120x90?text=Cough+Syrup"],
            ["Antacid Tablet", "Used for acidity and indigestion", "DigestPro", "৳ 30 / pack", "https://via.placeholder.com/120x90?text=Antacid"],
            ["Lubricant Eye Drops", "Used for dry and irritated eyes", "EyeCare", "৳ 120", "https://via.placeholder.com/120x90?text=Eye+Drops"],
            ["Antiseptic Cream", "Used for wounds and burns", "HealFast", "৳ 95", "https://via.placeholder.com/120x90?text=Antiseptic"]
          ];

          foreach ($medicines as $med) {
              echo '
              <article class="med-card">
                <div class="med-thumb">
                  <img src="'.$med[4].'" alt="'.$med[0].'">
                </div>
                <div class="med-body">
                  <h3>'.$med[0].'</h3>
                  <p class="med-desc">'.$med[1].'</p>
                  <p class="med-meta"><strong>Manufacturer:</strong> '.$med[2].'</p>
                  <div class="med-footer">
                    <span class="price">'.$med[3].'</span>
                    <div class="actions">
                      <button class="btn small">Add</button>
                      <button class="btn outline small">Details</button>
                    </div>
                  </div>
                </div>
              </article>
              ';
          }
          ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
          <button class="btn outline small">&laquo; Prev</button>
          <button class="btn small active">1</button>
          <button class="btn small">2</button>
          <button class="btn small">3</button>
          <button class="btn outline small">Next &raquo;</button>
        </div>
      </section>
    </main>
  </div>

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
