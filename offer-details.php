<?php
// Offer details (no DB needed)
$offers = [
  1 => [
    "title" => "Free Health Checkup",
    "icon" => "fa-solid fa-stethoscope",
    "details" => "
      <p>Book a doctor this month and enjoy a <b>completely free health checkup</b> at our partner clinics.</p>
      <ul>
        <li>Includes basic blood pressure and sugar testing.</li>
        <li>Valid for first-time patients only.</li>
        <li>Offer valid till the end of this month.</li>
      </ul>
    "
  ],
  2 => [
    "title" => "Medicine Discount",
    "icon" => "fa-solid fa-pills",
    "details" => "
      <p>Enjoy a <b>15% discount</b> on selected medicines purchased online through our pharmacy partners.</p>
      <ul>
        <li>Applicable on both prescription and OTC medicines.</li>
        <li>Offer valid for registered users only.</li>
      </ul>
    "
  ],
  3 => [
    "title" => "Home Service Discount",
    "icon" => "fa-solid fa-house-medical",
    "details" => "
      <p>Get a <b>special discount</b> on your first home medical service booking.</p>
      <ul>
        <li>Available in select cities only.</li>
        <li>Includes nurse and caretaker services.</li>
        <li>Book before the end of this month.</li>
      </ul>
    "
  ],
  4 => [
    "title" => "Cardio Screening Offer",
    "icon" => "fa-solid fa-heart-pulse",
    "details" => "
      <p>Keep your heart healthy! Book a <b>Cardio Screening</b> at discounted rates this month.</p>
      <ul>
        <li>Includes ECG, BP, and cholesterol testing.</li>
        <li>Available at partnered hospitals.</li>
      </ul>
    "
  ],
  5 => [
    "title" => "Vaccination Camp",
    "icon" => "fa-solid fa-syringe",
    "details" => "
      <p>Join our <b>Vaccination Camp</b> for kids and adults at reduced prices.</p>
      <ul>
        <li>Includes common flu, hepatitis, and COVID vaccines.</li>
        <li>Bring your ID for registration.</li>
      </ul>
    "
  ],
];

// Get ID from URL
$id = $_GET['id'] ?? 0;
$offer = $offers[$id] ?? null;

if (!$offer) {
  echo "<h2>Invalid Offer ID</h2>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $offer['title']; ?> - Offer Details</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: #f4f7f8; /* matches homepage light background */
      margin: 0;
      padding: 0;
    }
    .offer-details {
      max-width: 900px;
      margin: 60px auto;
      background: #fff;
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .offer-details:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    }
    .offer-details i {
      font-size: 70px;
      color: #45a049; /* same green as homepage */
      margin-bottom: 25px;
    }
    .offer-details h2 {
      font-size: 28px;
      color: #222;
      margin-bottom: 25px;
      font-weight: 600;
    }
    .offer-details p, .offer-details li {
      color: #555;
      line-height: 1.8;
      font-size: 16px;
      text-align: left;
      margin-bottom: 12px;
    }
    .offer-details ul {
      padding-left: 20px;
      margin-top: 10px;
    }
    .offer-details a.back-btn {
      display: inline-block;
      margin-top: 30px;
      background: #45a049;
      color: #fff;
      padding: 12px 25px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }
    .offer-details a.back-btn:hover {
      background: #3c8c3f;
    }
    /* Responsive */
    @media (max-width: 768px) {
      .offer-details {
        margin: 40px 20px;
        padding: 35px 25px;
      }
      .offer-details i {
        font-size: 55px;
      }
      .offer-details h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="offer-details">
    <i class="<?php echo $offer['icon']; ?>"></i>
    <h2><?php echo $offer['title']; ?></h2>
    <div><?php echo $offer['details']; ?></div>
    <a href="index.php#offers" class="back-btn">← Back to Offers</a>
  </div>
</body>
</html>
