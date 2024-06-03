<?php
session_start();
session_destroy(); // уничтожаем сессию
header("Location: http://localhost/ekz/login.php"); // перенаправляем на страницу входа
exit();
?>
