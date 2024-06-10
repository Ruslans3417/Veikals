<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Начало транзакции
    $conn->begin_transaction();

    try {
        // Удаление связанных записей из таблицы order_items
        $sql = "DELETE FROM order_items WHERE product_id='$id'";
        $conn->query($sql);

        // Удаление записи из таблицы products
        $sql = "DELETE FROM products WHERE id='$id'";
        $conn->query($sql);

        // Фиксация транзакции
        $conn->commit();
        
        header("Location: admin.php");
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error: " . $exception->getMessage();
    }
    
    $conn->close();
}
?>
