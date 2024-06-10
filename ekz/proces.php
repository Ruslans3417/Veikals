<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        // Проверка существования пользователя с таким же email
        $check_sql = "SELECT * FROM users WHERE email='$email'";
        $check_result = $conn->query($check_sql);

        if ($check_result === false) {
            die("Error in check query: " . $conn->error); // Проверка на ошибки запроса
        }

        if ($check_result->num_rows > 0) {
            echo "User with this email already exists";
        } else {
            $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                // echo "New record created successfully"; // Для отладки можно включить
                header("Location: mainshop.html"); // Перенаправление на другую страницу после успешной регистрации
                exit();
            } else {
                echo "Error in insert query: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    } elseif (isset($_POST['login'])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error in login query: " . $conn->error); // Проверка на ошибки запроса
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // echo "Login successful"; // Для отладки можно включить
                header("Location: mainshop.html"); // Перенаправление на другую страницу после успешной авторизации
                exit();
            } else {
                // Неверный пароль
                echo "Invalid password";
            }
        } else {
            // Пользователь не найден
            echo "No user found with that email";
        }

        $conn->close();
    }
}
?>
