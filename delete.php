<?php
require 'db.php';

$id = $_GET['id'];

// Fetch the student data to get the profile picture path
$stmt = $pdo->prepare("SELECT profile_picture FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

// Delete profile picture if exists
if ($student['profile_picture']) {
    unlink($student['profile_picture']);
}

// Delete student record
$stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
?>
