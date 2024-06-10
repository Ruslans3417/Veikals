<?php
// Запуск сессии
session_start();

// Подключение к базе данных
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка на наличие данных в массиве $_POST
    $userName = isset($_POST['userName']) ? $_POST['userName'] : null;
    $userEmail = isset($_POST['userEmail']) ? $_POST['userEmail'] : null;
    $userPhone = isset($_POST['userPhone']) ? $_POST['userPhone'] : null;
    $appointmentDate = isset($_POST['appointmentDate']) ? $_POST['appointmentDate'] : null;
    $appointmentTime = isset($_POST['appointmentTime']) ? $_POST['appointmentTime'] : null;
    $procedure_id = isset($_POST['procedure_id']) ? $_POST['procedure_id'] : null;

    // Проверка, что все необходимые данные заполнены
    if ($userName && $userEmail && $userPhone && $appointmentDate && $appointmentTime && $procedure_id) {
        // Проверка, существует ли пользователь уже
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Пользователь существует, получаем его ID
            $user = $result->fetch_assoc();
            $user_id = $user['id'];
        } else {
            // Пользователь не существует, создаем нового
            $sql = "INSERT INTO users (name, email, phone, is_admin) VALUES (?, ?, ?, 0)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $userName, $userEmail, $userPhone);
            $stmt->execute();
            $user_id = $stmt->insert_id;
        }

        // Сохранение записи на процедуру
        $sql = "INSERT INTO appointments (user_id, date, time, procedure_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $user_id, $appointmentDate, $appointmentTime, $procedure_id);
        $stmt->execute();
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
<div class="content">
    <div class="container my-4">
        <h1 class="text-center">Book an Appointment</h1>
        <hr>
        <!-- Форма записи на процедуры -->
        <div class="card mb-4">
            <div class="card-header">
                Book an Appointment
            </div>
            <div class="card-body">
                <form action="appointments.php" method="post">
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter user name" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">User Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter user email" required>
                    </div>
                    <div class="form-group">
                        <label for="userPhone">User Phone</label>
                        <input type="text" class="form-control" id="userPhone" name="userPhone" placeholder="Enter user phone" required>
                    </div>
                    <div class="form-group">
                        <label for="appointmentDate">Appointment Date</label>
                        <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="appointmentTime">Appointment Time</label>
                        <select class="form-control" id="appointmentTime" name="appointmentTime" required>
                            <option value="15:00">15:00</option>
                            <option value="17:00">17:00</option>
                            <option value="19:00">19:00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="procedure_id">Procedure</label>
                        <select class="form-control" id="procedure_id" name="procedure_id" required>
                            <!-- Предположим, что у вас есть таблица procedures, из которой можно извлечь данные -->
                            <?php
                            $sql = "SELECT id, name FROM procedures";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
