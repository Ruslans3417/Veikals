<?php
include 'connect.php';

$productID = $_POST['productID'];
$discount = $_POST['discount'];
$promotionStart = $_POST['promotionStart'];
$promotionEnd = $_POST['promotionEnd'];

$sql = "INSERT INTO promotions (product_id, discount, start_date, end_date) VALUES ('$productID', '$discount', '$promotionStart', '$promotionEnd')";
if ($conn->query($sql) === TRUE) {
    echo "Promotion added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
