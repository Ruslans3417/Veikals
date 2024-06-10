<?php
include 'connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT is_admin FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $newStatus = $user['is_admin'] ? 0 : 1;
        $updateSql = "UPDATE users SET is_admin = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ii", $newStatus, $id);

        if ($updateStmt->execute()) {
            header('Location: admin.php');
            exit();
        } else {
            echo "Ошибка при обновлении статуса пользователя.";
        }
    } else {
        echo "Пользователь не найден.";
    }
} else {
    echo "Неверный запрос.";
}
?>