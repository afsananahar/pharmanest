<?php
include 'db_connect.php';

// Handle doctor deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Get the photo path to delete the image file
    $res = $conn->query("SELECT photo FROM doctors WHERE id=$id");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if (file_exists($row['photo'])) unlink($row['photo']);
    }
    $conn->query("DELETE FROM doctors WHERE id=$id");
    header("Location: admin-doctors.php");
    exit;
}

// Handle doctor upload
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $speciality = $_POST['speciality'];
    $qualification = $_POST['qualification'];
    $hospital = $_POST['hospital'];
    $timing = $_POST['timing'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    $target_dir = "uploads/";
    $file_name = basename($_FILES["photo"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO doctors (name, speciality, qualification, hospital, timing, phone, photo, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $speciality, $qualification, $hospital, $timing, $phone, $target_file, $city);
        $stmt->execute();
        $message = "Doctor added successfully!";
    } else {
        $message = "Image upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Doctors</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f7f7f7; }
        h1 { text-align: center; margin-bottom: 20px; }
        form { background: #fff; padding: 20px; border-radius: 10px; max-width: 500px; margin: 0 auto 30px; box-shadow: 0 0 10px #ccc; }
        input, select { width: 100%; margin: 8px 0; padding: 10px; }
        button { background: #28a745; color: #fff; border: none; padding: 10px; cursor: pointer; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; box-shadow: 0 0 10px #ccc; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background: #007bff; color: white; }
        img { max-width: 80px; border-radius: 5px; }
        .delete-btn { background: #dc3545; padding: 5px 10px; border-radius: 5px; color: white; text-decoration: none; }
        .message { text-align: center; margin-bottom: 20px; color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Doctor Management Dashboard</h1>

    <?php if($message) echo "<p class='message'>$message</p>"; ?>

    <!-- Upload Form -->
    <form method="POST" enctype="multipart/form-data">
        <h2>Add New Doctor</h2>
        <input type="text" name="name" placeholder="Doctor Name" required>
        <input type="text" name="speciality" placeholder="Speciality" required>
        <input type="text" name="qualification" placeholder="Qualification" required>
        <input type="text" name="hospital" placeholder="Hospital" required>
        <input type="text" name="timing" placeholder="Timing" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="text" name="city" placeholder="City" value="Cumilla" required>
        <input type="file" name="photo" required>
        <button type="submit">Upload Doctor</button>
    </form>

    <!-- Doctor List -->
    <table>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Speciality</th>
            <th>Qualification</th>
            <th>Hospital</th>
            <th>Timing</th>
            <th>Phone</th>
            <th>City</th>
            <th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM doctors ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td><img src='{$row['photo']}' alt='{$row['name']}'></td>
                <td>{$row['name']}</td>
                <td>{$row['speciality']}</td>
                <td>{$row['qualification']}</td>
                <td>{$row['hospital']}</td>
                <td>{$row['timing']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['city']}</td>
                <td><a class='delete-btn' href='?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
