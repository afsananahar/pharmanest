<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $role = $_POST['role'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit;
  }

  // Check if email exists
  $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists! Try another.'); window.history.back();</script>";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (role, name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $role, $name, $email, $hashedPassword);
    
    if ($stmt->execute()) {
      echo "<script>alert('✅ Registration Successful! Please Login.'); window.location.href='login.html';</script>";
    } else {
      echo "<script>alert('❌ Something went wrong: " . $stmt->error . "'); window.history.back();</script>";
    }
  }
}
?>
