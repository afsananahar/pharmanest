<?php
// No need to include database or query the table
// include 'db_connect.php'; ❌ remove this line

// Predefined health tips
$tips = [
  1 => [
    "title" => "5 Ways to Boost Immunity",
    "icon" => "fa-solid fa-shield-virus",
    "content" => "
      <ul>
        <li>Eat a balanced diet rich in fruits and vegetables.</li>
        <li>Exercise regularly to keep your body active.</li>
        <li>Get 7–8 hours of quality sleep daily.</li>
        <li>Stay hydrated — drink at least 8 glasses of water.</li>
        <li>Manage stress through meditation or relaxation techniques.</li>
      </ul>
    "
  ],
  2 => [
    "title" => "Healthy Eating Habits",
    "icon" => "fa-solid fa-apple-whole",
    "content" => "
      <p>Healthy eating is about balance and variety. Focus on whole grains, lean proteins, fruits, and vegetables. Avoid processed foods, sugary drinks, and excessive salt. Plan your meals to include nutrients that support your lifestyle.</p>
    "
  ],
  3 => [
    "title" => "Stay Active at Home",
    "icon" => "fa-solid fa-dumbbell",
    "content" => "
      <p>You don’t need a gym to stay fit! Do home workouts like pushups, squats, or yoga. Take breaks during work to stretch, and go for walks when possible. Consistency is key to maintaining a healthy lifestyle.</p>
    "
  ],
  4 => [
    "title" => "Improve Sleep Quality",
    "icon" => "fa-solid fa-bed",
    "content" => "
      <p>Stick to a sleep schedule, avoid screens before bed, and create a calm bedtime environment. Good sleep boosts mood, focus, and immunity.</p>
    "
  ],
  5 => [
    "title" => "Stay Hydrated",
    "icon" => "fa-solid fa-water",
    "content" => "
      <p>Drink water regularly throughout the day. Hydration keeps your skin healthy, your organs functioning, and your energy up.</p>
    "
  ],
  6 => [
    "title" => "Mental Wellness Tips",
    "icon" => "fa-solid fa-brain",
    "content" => "
      <p>Take breaks, practice mindfulness, and connect with loved ones. Mental health is just as important as physical health.</p>
    "
  ],
  7 => [
    "title" => "Heart Health Tips",
    "icon" => "fa-solid fa-heart-pulse",
    "content" => "
      <p>Maintain a healthy weight, avoid smoking, eat less processed food, and get regular exercise to protect your heart.</p>
    "
  ],
  8 => [
    "title" => "Go Green",
    "icon" => "fa-solid fa-leaf",
    "content" => "
      <p>Grow plants, reduce plastic use, recycle, and use eco-friendly transport. Small steps make a big impact on the planet.</p>
    "
  ],
];

// Get ID from URL
$id = $_GET['id'] ?? 0;
$tip = $tips[$id] ?? null;

if (!$tip) {
  echo "<h2>Invalid Tip ID</h2>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $tip['title']; ?> - Health Tip</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    .tip-details {
      max-width: 800px;
      margin: 60px auto;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    .tip-details i {
      font-size: 60px;
      color: #45a049;
      margin-bottom: 20px;
    }
    .tip-details h2 {
      color: #222;
      margin-bottom: 20px;
    }
    .tip-details p, .tip-details li {
      color: #555;
      line-height: 1.7;
      font-size: 16px;
      text-align: left;
    }
    .tip-details a.back-btn {
      display: inline-block;
      margin-top: 25px;
      background: #45a049;
      color: #fff;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      transition: 0.3s;
    }
    .tip-details a.back-btn:hover {
      background: #3c8c3f;
    }
  </style>
</head>
<body>
  <div class="tip-details">
    <i class="<?php echo $tip['icon']; ?>"></i>
    <h2><?php echo $tip['title']; ?></h2>
    <div><?php echo $tip['content']; ?></div>
    <a href="health-tips.php" class="back-btn">← Back to Health Tips</a>
  </div>
</body>
</html>
