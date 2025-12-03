<?php
session_start();
// For simplicity, let's assume admin login session exists
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.html");
    exit;
}

include 'db_connect.php';

// Handle Create Hospital
if (isset($_POST['add_hospital'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $type = $conn->real_escape_string($_POST['type']);
    $service = $conn->real_escape_string($_POST['service']);
    $location = $conn->real_escape_string($_POST['location']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $rating = $conn->real_escape_string($_POST['rating']);

    $conn->query("INSERT INTO hospitals1 (name, type, service, location, phone, rating) 
                  VALUES ('$name','$type','$service','$location','$phone','$rating')");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM hospitals1 WHERE id=$id");
}

// Fetch all hospitals
$result = $conn->query("SELECT * FROM hospitals1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Hospitals</title>
    <link rel="stylesheet" href="hospital-admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<header>
    <h1>Hospital Admin Panel</h1>
    <p>Welcome, <?php echo $_SESSION['admin_name']; ?> | <a href="logout.php">Logout</a></p>
</header>

<section class="add-hospital">
    <h2>Add New Hospital</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Hospital Name" required>
        <select name="type" required>
            <option value="">Select Type</option>
            <option value="General">General</option>
            <option value="Specialized">Specialized</option>
            <option value="Clinic">Clinic</option>
        </select>
        <select name="service" required>
            <option value="">Select Service</option>
            <option value="Emergency">Emergency</option>
            <option value="ICU">ICU</option>
            <option value="Diagnostic">Diagnostic</option>
        </select>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="number" step="0.1" name="rating" placeholder="Rating" min="0" max="5" required>
        <button type="submit" name="add_hospital"><i class="fas fa-plus"></i> Add Hospital</button>
    </form>
</section>

<section class="hospital-list">
    <h2>Hospital List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Service</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Rating</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['service']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['rating']; ?></td>
                <td>
                    <a href="edit-hospital.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                    <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this hospital?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</section>

</body>
</html>
