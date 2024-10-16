<?php
require 'db.php';

// Fetch all students
$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Student Information</h2>
    <a href="add.php">Add New Student</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Roll Number</th>
            <th>Marks</th>
            <th>Profile Picture</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['name']); ?></td>
            <td><?php echo htmlspecialchars($student['roll_number']); ?></td>
            <td><?php echo htmlspecialchars($student['marks']); ?></td>
            <td>
                <?php if ($student['profile_picture']): ?>
                    <img src="<?php echo $student['profile_picture']; ?>" alt="Profile Picture" width="50" height="50">
                <?php else: ?>
                    No Picture
                <?php endif; ?>
            </td>
            <td>
                <a href="edit.php?id=<?php echo $student['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
