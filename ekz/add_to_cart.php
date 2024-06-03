<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1; // Можно добавить поле для выбора количества

    // Если корзина еще не создана, создаем ее
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Если товар уже есть в корзине, увеличиваем количество
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header("Location: mainshop.php");
} else {
    echo "Invalid request.";
}
?>
