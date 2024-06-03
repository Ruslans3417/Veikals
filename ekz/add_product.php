<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $image = $_FILES['productImage']['name'];

    // Save the uploaded image to the server
    $target_dir = "foto/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file);

    $sql = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdss", $name, $price, $description, $image);

    if ($stmt->execute()) {
        // Redirect to the admin panel
        header("Location: admin.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
