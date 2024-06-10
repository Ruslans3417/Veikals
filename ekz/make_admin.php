<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    if (!empty($id)) {
        $sql = "UPDATE users SET is_admin = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "User promoted to admin successfully.";
        } else {
            echo "Execute failed: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
    } else {
        echo "User ID is empty.";
    }

    $conn->close();
    header("Location: admin.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>
