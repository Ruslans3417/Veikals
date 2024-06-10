<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);

    if ($stmt->execute()) {
        header("Location: admin.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
