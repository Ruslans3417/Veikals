<?php
$servername = "localhost"; // Имя сервера базы данных (обычно localhost)
$username = "root"; // Имя пользователя базы данных (обычно root)
$password = ""; // Пароль пользователя базы данных (обычно пустой или root)
$dbname = "veikals"; // Имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>