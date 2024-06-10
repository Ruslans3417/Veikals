<?php
// Подключение к базе данных
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы и экранирование
    $name = mysqli_real_escape_string($conn, $_POST['procedureName']);
    $description = mysqli_real_escape_string($conn, $_POST['procedureDescription']);
    $price = $_POST['procedurePrice'];

    // Проверка, что цена не отрицательная
    if ($price < 0) {
        die('Цена не может быть отрицательной.');
    }

    // Обработка загрузки изображения
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["procedureImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Проверка, является ли файл изображением
    $check = getimagesize($_FILES["procedureImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Файл не является изображением.";
        $uploadOk = 0;
    }

    // Проверка существования файла
    if (file_exists($target_file)) {
        echo "Извините, файл уже существует.";
        $uploadOk = 0;
    }

    // Ограничение размера файла (например, 5MB)
    if ($_FILES["procedureImage"]["size"] > 5000000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
    }

    // Разрешение определённых форматов файлов
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Извините, только JPG, JPEG, PNG и GIF файлы разрешены.";
        $uploadOk = 0;
    }

    // Проверка, прошли ли все проверки
    if ($uploadOk == 0) {
        echo "Извините, ваш файл не был загружен.";
    } else {
        if (move_uploaded_file($_FILES["procedureImage"]["tmp_name"], $target_file)) {
            // Файл загружен, вставка данных в базу данных
            $stmt = $conn->prepare("INSERT INTO procedures (name, description, price, image) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $name, $description, $price, $target_file);

            if ($stmt->execute() === TRUE) {
                echo "Процедура успешно добавлена.";
            } else {
                echo "Ошибка: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Извините, произошла ошибка при загрузке вашего файла.";
        }
    }
}

$conn->close();
?>
