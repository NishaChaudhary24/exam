<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $marks = $_POST['marks'];

    // Handle profile picture upload
    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_destination = 'uploads/' . $file_name;

        move_uploaded_file($file_tmp, $file_destination);
    } else {
        $file_destination = null;
    }

    // Insert student data into the database
    $stmt = $pdo->prepare("INSERT INTO students (name, roll_number, marks, profile_picture) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $roll_number, $marks, $file_destination]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add New Student</h2>
    <form action="add.php" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Roll Number:</label>
        <input type="text" name="roll_number" required><br>
        <label>Marks:</label>
        <input type="number" name="marks" required><br>
        <label>Profile Picture:</label>
        <input type="file" name="profile_picture" accept="image/*"><br>
        <button type="submit">Add Student</button>
    </form>
</body>
</html>
