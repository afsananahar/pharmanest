<?php
include 'db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $desc = $_POST['description'];
  $manufacturer = $_POST['manufacturer'];
  $category = $_POST['category'];
  $price = $_POST['price'];
  $image = $_POST['image'];

  $stmt = $conn->prepare("INSERT INTO medicines (name, description, manufacturer, category, price, image) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssis", $name, $desc, $manufacturer, $category, $price, $image);
  $stmt->execute();
  echo "<script>alert('Medicine Added Successfully!');</script>";
}
?>

<form method="POST" style="width:60%;margin:50px auto;">
  <h2>Add Medicine</h2>
  <input type="text" name="name" placeholder="Medicine Name" required><br><br>
  <textarea name="description" placeholder="Description" required></textarea><br><br>
  <input type="text" name="manufacturer" placeholder="Manufacturer"><br><br>
  <input type="text" name="category" placeholder="Category"><br><br>
  <input type="number" name="price" placeholder="Price (৳)" required><br><br>
  <input type="text" name="image" placeholder="Image URL (optional)"><br><br>
  <button type="submit">Add Medicine</button>
</form>
