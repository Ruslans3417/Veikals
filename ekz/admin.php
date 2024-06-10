<?php
// Запуск сессии
session_start();

// Подключение к базе данных
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<body>
<?php 
// Подключение заголовка страницы
include 'header.php'; 
?>
    <!-- Основное содержимое -->
    <div class="content">
        <div class="container my-4">
            <h1 class="text-center">Admin Panel</h1>
            <hr>

            <!-- Раздел управления пользователями -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Users
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Запрос на получение списка пользователей из базы данных
                            $sql = "SELECT id, name, email, is_admin FROM users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Вывод каждого пользователя в таблицу
                                while ($row = $result->fetch_assoc()) {
                                    $role = $row['is_admin'] ? 'Admin' : 'User';
                                    echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['name'] . "</td>
                                        <td>" . $row['email'] . "</td>
                                        <td>" . $role . "</td>
                                        <td>
                                            <form action='delete_user.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Раздел управления продуктами -->
            <div class="card mb-4">
    <div class="card-header">
        Manage Products
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Запрос на получение списка продуктов из базы данных
                $sql = "SELECT id, name, price, image, image2, image3 FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Вывод каждого продукта в таблицу
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['price'] . "</td>
                            <td>
                                <img src='foto/" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 50px;'>
                                <img src='foto/" . $row['image2'] . "' alt='" . $row['name'] . "' style='width: 50px;'>
                                <img src='foto/" . $row['image3'] . "' alt='" . $row['name'] . "' style='width: 50px;'>
                            </td>
                            <td>
                                <form action='edit_product.php' method='get' style='display:inline-block;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' class='btn btn-warning btn-sm'>Edit</button>
                                </form>
                                <form action='delete_product.php' method='post' style='display:inline-block;'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Раздел добавления продукта -->
<div class="card mb-4">
    <div class="card-header">
        Add Product
    </div>
    <div class="card-body">
        <form action="add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Product Price</label>
                <input type="number" step="0.01" min="0" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required>
            </div>
            <div class="form-group">
                <label for="productImage1">Product Image 1</label>
                <input type="file" class="form-control-file" id="productImage1" name="productImage1" required>
            </div>
            <div class="form-group">
                <label for="productImage2">Product Image 2</label>
                <input type="file" class="form-control-file" id="productImage2" name="productImage2">
            </div>
            <div class="form-group">
                <label for="productImage3">Product Image 3</label>
                <input type="file" class="form-control-file" id="productImage3" name="productImage3">
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" placeholder="Enter product description" required></textarea>
            </div>
            <div class="form-group">
                <label for="productPromotion">Promotion</label>
                <input type="checkbox" class="form-check-input" id="productPromotion" name="productPromotion">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</div>

            <!-- Раздел управления заказами -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Orders
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Запрос на получение списка заказов из базы данных
                            $sql = "SELECT orders.id AS order_id, users.name AS user_name, orders.status 
                                    FROM orders 
                                    JOIN users ON orders.user_id = users.id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Вывод каждого заказа в таблицу
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row['order_id'] . "</td>
                                        <td>" . $row['user_name'] . "</td>
                                        <td>" . $row['status'] . "</td>
                                        <td><a href='order_details.php?order_id=" . htmlspecialchars($row['order_id']) . "' class='btn btn-info'>View Details</a></td>
                                        <td>
                                            <form action='update_order_status.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='order_id' value='" . $row['order_id'] . "'>
                                                <select class='form-control form-control-sm' name='status'>
                                                    <option value='Processing'" . ($row['status'] == 'Processing' ? ' selected' : '') . ">Processing</option>
                                                    <option value='Shipped'" . ($row['status'] == 'Shipped' ? ' selected' : '') . ">Shipped</option>
                                                    <option value='Cancelled'" . ($row['status'] == 'Cancelled' ? ' selected' : '') . ">Cancelled</option>
                                                </select>
                                                <button type='submit' class='btn btn-success btn-sm mt-1'>Update Status</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No orders found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Раздел управления процедурами -->
            <div class="card mb-4">
                <div class="card-header">
                    Управление Процедурами
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Изображение</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Запрос на получение списка процедур из базы данных
                            $sql = "SELECT id, name,  price, image FROM procedures";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Вывод каждой процедуры в таблицу
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row['id'] . "</td>
                                        <td>" . $row['name'] . "</td>
                                        <td>" . $row['price'] . "</td>
                                        <td><img src='foto/" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 50px;'></td>
                                        <td>
                                            <form action='edit_procedure.php' method='get' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='btn btn-warning btn-sm'>Редактировать</button>
                                            </form>
                                            <form action='delete_procedure.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Удалить</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>Процедуры не найдены</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Раздел добавления процедуры -->
            <div class="card mb-4">
                <div class="card-header">
                    Добавить Процедуру
                </div>
                <div class="card-body">
                    <form action="add_procedure.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="procedureName">Название Процедуры</label>
                            <input type="text" class="form-control" id="procedureName" name="procedureName" placeholder="Введите название процедуры" required>
                        </div>

                        <div class="form-group">
                            <label for="procedurePrice">Цена Процедуры</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="procedurePrice" name="procedurePrice" placeholder="Введите цену процедуры" required>
                        </div>
                        <div class="form-group">
                            <label for="procedureImage">Изображение Процедуры</label>
                            <input type="file" class="form-control-file" id="procedureImage" name="procedureImage" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить Процедуру</button>
                    </form>
                </div>
            </div>

            <!-- Раздел управления записями -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Appointments
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Appointment ID</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Procedure</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Запрос на получение списка записей из базы данных
                            $sql = "SELECT appointments.id AS appointment_id, users.name AS user_name, appointments.date, appointments.time, procedures.name AS procedure_name
                                    FROM appointments 
                                    JOIN users ON appointments.user_id = users.id
                                    JOIN procedures ON appointments.procedure_id = procedures.id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Вывод каждой записи в таблицу
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row['appointment_id'] . "</td>
                                        <td>" . $row['user_name'] . "</td>
                                        <td>" . $row['date'] . "</td>
                                        <td>" . $row['time'] . "</td>
                                        <td>" . $row['procedure_name'] . "</td>
                                        <td>
                                            <form action='admin.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row['appointment_id'] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No appointments found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php 
    // Подключение нижнего колонтитула страницы
    include 'footer.php'; 
    ?>
</body>

</html>
