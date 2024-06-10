<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $promotion = isset($_POST['productPromotion']) ? 1 : 0;

    // Проверка на отрицательную цену
    if ($price < 0) {
        echo "Цена не может быть отрицательной.";
        exit();
    }

    // Обновление изображений, если загружены новые
    $target_dir = "foto/";
    $image1 = isset($_FILES["productImage1"]["name"]) && !empty($_FILES["productImage1"]["name"]) ? $target_dir . basename($_FILES["productImage1"]["name"]) : (isset($_POST['existingImage1']) ? $_POST['existingImage1'] : NULL);
    $image2 = isset($_FILES["productImage2"]["name"]) && !empty($_FILES["productImage2"]["name"]) ? $target_dir . basename($_FILES["productImage2"]["name"]) : (isset($_POST['existingImage2']) ? $_POST['existingImage2'] : NULL);
    $image3 = isset($_FILES["productImage3"]["name"]) && !empty($_FILES["productImage3"]["name"]) ? $target_dir . basename($_FILES["productImage3"]["name"]) : (isset($_POST['existingImage3']) ? $_POST['existingImage3'] : NULL);

    if (!is_null($image1) && isset($_FILES["productImage1"]["name"]) && !empty($_FILES["productImage1"]["name"])) {
        move_uploaded_file($_FILES["productImage1"]["tmp_name"], $image1);
    }
    if (!is_null($image2) && isset($_FILES["productImage2"]["name"]) && !empty($_FILES["productImage2"]["name"])) {
        move_uploaded_file($_FILES["productImage2"]["tmp_name"], $image2);
    }
    if (!is_null($image3) && isset($_FILES["productImage3"]["name"]) && !empty($_FILES["productImage3"]["name"])) {
        move_uploaded_file($_FILES["productImage3"]["tmp_name"], $image3);
    }

    // Создание SQL-запроса и массива параметров
    $sql = "UPDATE products SET name=?, price=?, description=?, promotion=?";
    $params = [$name, $price, $description, $promotion];
    $types = "sdss";

    if (!is_null($image1)) {
        $sql .= ", image=?";
        $params[] = $image1;
        $types .= "s";
    }
    if (!is_null($image2)) {
        $sql .= ", image2=?";
        $params[] = $image2;
        $types .= "s";
    }
    if (!is_null($image3)) {
        $sql .= ", image3=?";
        $params[] = $image3;
        $types .= "s";
    }

    $sql .= " WHERE id=?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Ошибка: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
