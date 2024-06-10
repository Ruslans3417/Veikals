<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

include 'connect.php';

$is_admin = false;
$is_logged_in = false;

// Проверяем, авторизован ли пользователь
if (isset($_SESSION['user_id'])) {
    $is_logged_in = true;

    // Проверяем роль пользователя
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        $is_admin = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Veikals</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0; /* Убираем отступы */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        .card img {
            max-height: 200px;
            object-fit: cover;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .navbar {
            background-color:#666; /* Черный цвет фона */
            padding: 10px;
            margin: 0; /* Убираем отступы */
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff; /* Белый цвет текста */
            text-decoration: none;
        }
        .navbar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .navbar-menu li {
            display: inline-block;
            padding-right: 10px;
        }
        .navbar-menu a {
            color: #fff; /* Белый цвет текста */
            text-decoration: none;
        }
        .navbar-menu a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
  <header>
    <nav class="navbar">
      <a href="mainshop.php" class="logo">crystalino</a>
      <div class="navbar-menu">
        <ul>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="mainshop.php">Katalogs</a>
          </li>
          
          <!-- Показываем вкладку для админа только если пользователь администратор -->
          <?php if ($is_admin): ?>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="admin.php">Admin</a>
          </li>
          <?php endif; ?>

          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="contact.php">Kontakti</a>
          </li>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="procedures.php">procedures</a>
          </li>
          <!-- Показываем кнопки регистрации и логина только для неавторизованных пользователей -->
          <?php if (!$is_logged_in): ?>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="register.php">Registration</a>
          </li>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="login.php">Login</a>
          </li>
          <?php else: ?>
          <!-- Показываем вкладку профиля и кнопку выхода для авторизованных пользователей -->
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="profile.php">Profile</a>
          </li>
          <li style="display: inline-block; padding-right: 0.5cm;">
            <a href="logout.php">Logout</a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
      <button class="menu-toggle">
        <!-- Иконка для меню -->
      </button>
    </nav>
    <!-- Здесь располагаются элементы навигации -->
  </header>
</body>
</html>
