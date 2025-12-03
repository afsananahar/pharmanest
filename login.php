<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
  $stmt->bind_param("ss", $email, $role);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
      // Session setup
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['role'] = $user['role'];

      // Redirect by role
      if ($user['role'] === 'admin') {
        header("Location: admin-dashboard.html");
      } else {
        header("Location: user-dashboard.html");
      }
      exit;
    } else {
      echo "<script>alert('❌ Incorrect password!'); window.history.back();</script>";
    }
  } else {
    echo "<script>alert('❌ No account found for this email!'); window.history.back();</script>";
  }
}
?>
