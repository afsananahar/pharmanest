<?php
$servername = "localhost";
$username = "root"; // যদি তোমার MySQL অন্য username হয়, বদলাও
$password = "";     // যদি পাসওয়ার্ড থাকে, সেটা দাও
$dbname = "e_health";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("❌ Connection failed: " . $conn->connect_error);
}
// echo "✅ Connected Successfully"; // Debug check (optional)
?>


