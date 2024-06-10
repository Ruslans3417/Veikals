<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $procedureName = $_POST['procedureName'];
    $procedurePrice = $_POST['procedurePrice'];
    $procedureImage = '';

    // Обработка загрузки изображения
    if ($_FILES['procedureImage']['name']) {
        $target_dir = "foto/";
        $target_file = $target_dir . basename($_FILES["procedureImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Проверка, является ли файл изображением
        $check = getimagesize($_FILES["procedureImage"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["procedureImage"]["tmp_name"], $target_file)) {
                $procedureImage = basename($_FILES["procedureImage"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "File is not an image.";
            exit();
        }
    }

    // Обновление данных в базе данных
    if ($procedureImage) {
        $sql = "UPDATE procedures SET name = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsi", $procedureName, $procedurePrice, $procedureImage, $id);
    } else {
        $sql = "UPDATE procedures SET name = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdi", $procedureName, $procedurePrice, $id);
    }

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid request.";
}
?>
