<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $promotion = isset($_POST['productPromotion']) ? 1 : 0;

    // Проверка на отрицательную цену
    if ($price < 0) {
        echo "Price cannot be negative.";
        exit();
    }

    // Сохранение загруженных изображений на сервер
    $target_dir = "foto/";
    $target_file1 = $target_dir . basename($_FILES["productImage1"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["productImage2"]["name"]);
    $target_file3 = $target_dir . basename($_FILES["productImage3"]["name"]);
    move_uploaded_file($_FILES["productImage1"]["tmp_name"], $target_file1);
    move_uploaded_file($_FILES["productImage2"]["tmp_name"], $target_file2);
    move_uploaded_file($_FILES["productImage3"]["tmp_name"], $target_file3);

    $sql = "INSERT INTO products (name, price, image, image2, image3, description, promotion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsssii", $name, $price, $target_file1, $target_file2, $target_file3, $description, $promotion);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
