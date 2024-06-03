<?php
session_start();
include 'connect.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];

// Обновление имени пользователя
$stmt = $conn->prepare("UPDATE users SET name = ? WHERE id = ?");
$stmt->bind_param("si", $username, $user_id);
$stmt->execute();

if ($password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();
}

header("Location: profile.php");
exit();
?>