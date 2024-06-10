<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $procedureName = $_POST['procedureName'];
    $procedurePrice = $_POST['procedurePrice'];

    // Обработка загрузки изображения
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["procedureImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Проверка, является ли файл изображением
    $check = getimagesize($_FILES["procedureImage"]["tmp_name"]);
    if ($check !== false) {
        // Проверка на существование директории и её создание при необходимости
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($_FILES["procedureImage"]["tmp_name"], $target_file)) {
            // Успешно загружен
            $procedureImage = basename($_FILES["procedureImage"]["name"]);

            // Вставка данных в базу данных
            $sql = "INSERT INTO procedures (name, price, image) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sds", $procedureName, $procedurePrice, $procedureImage);

            if ($stmt->execute()) {
                header('Location: admin.php');
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>
