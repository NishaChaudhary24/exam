<?php
require 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

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
        $file_destination = $student['profile_picture'];
    }

    // Update student data
    $stmt = $pdo->prepare("UPDATE students SET name = ?, roll_number = ?, marks = ?, profile_picture = ? WHERE id = ?");
    $stmt->execute([$name, $roll_number, $marks, $file_destination, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Student</h2>
    <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required><br>
        <label>Roll Number:</label>
        <input type="text" name="roll_number" value="<?php echo htmlspecialchars($student['roll_number']); ?>" required><br>
        <label>Marks:</label>
        <input type="number" name="marks" value="<?php echo htmlspecialchars($student['marks']); ?>" required><br>
        <label>Profile Picture:</label>
        <input type="file" name="profile_picture" accept="image/*"><br>
        <button type="submit">Update Student</button>
    </form>
</body>
</html>
