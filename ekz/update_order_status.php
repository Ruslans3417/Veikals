<?php
include 'connect.php';

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка при обновлении статуса заказа.";
    }
} else {
    echo "Неверный запрос.";
}
?>
