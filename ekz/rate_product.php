<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];

// Проверка существующей оценки
$query = "SELECT * FROM ratings WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$existing_rating = $stmt->get_result()->fetch_assoc();

if ($existing_rating) {
    // Обновление существующей оценки
    $query = "UPDATE ratings SET rating = ? WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $rating, $user_id, $product_id);
} else {
    // Вставка новой оценки
    $query = "INSERT INTO ratings (user_id, product_id, rating) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $user_id, $product_id, $rating);
}

$stmt->execute();

header('Location: profile.php');
exit();
