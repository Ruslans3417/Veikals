<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["productName"];
    $price = $_POST["productPrice"];
    $description = $_POST["productDescription"];
    $image = $_FILES["productImage"]["name"];

    // Путь для загрузки изображений
    $target_dir = "foto/";
    $target_file = $target_dir . basename($image);

    if (!empty($image)) {
        // Загружаем новое изображение
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            // Обновляем продукт с новым изображением
            $sql = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdssi", $name, $price, $description, $image, $id);
        } else {
            echo "Ошибка загрузки изображения.";
            exit();
        }
    } else {
        // Обновляем продукт без изменения изображения
        $sql = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsi", $name, $price, $description, $id);
    }

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Неверный запрос.";
}
?>
