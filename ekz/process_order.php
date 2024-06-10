<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $total_price = $_POST['total_price'];
    $cart = $_SESSION['cart'] ?? [];

    if (!empty($cart)) {
        // Начать транзакцию
        $conn->begin_transaction();

        try {
            // Вставка заказа в таблицу orders
            $stmt = $conn->prepare("INSERT INTO orders (user_id, status) VALUES (?, 'Processing')");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $order_id = $stmt->insert_id;
            $stmt->close();

            // Вставка товаров заказа в таблицу order_items
            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, (SELECT price FROM products WHERE id = ?))");
            foreach ($cart as $product_id => $quantity) {
                $stmt->bind_param("iiii", $order_id, $product_id, $quantity, $product_id);
                $stmt->execute();
            }
            $stmt->close();

            // Коммит транзакции
            $conn->commit();
            unset($_SESSION['cart']); // Очистить корзину после успешного оформления заказа
            header("Location: profile.php");
        } catch (mysqli_sql_exception $exception) {
            // Откат транзакции в случае ошибки
            $conn->rollback();
            throw $exception;
        }
    } else {
        echo "Корзина пуста.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
