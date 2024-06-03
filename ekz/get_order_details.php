<?php
include 'connect.php';

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "SELECT products.name, products.image 
            FROM order_items 
            JOIN products ON order_items.product_id = products.id 
            WHERE order_items.order_id = '$order_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul class='list-group'>";
        while ($row = $result->fetch_assoc()) {
            echo "<li class='list-group-item'>
                    <img src='foto/" . $row['image'] . "' alt='" . $row['name'] . "' style='width: 50px; margin-right: 10px;'>
                    " . $row['name'] . "
                  </li>";
        }
        echo "</ul>";
    } else {
        echo "No products found for this order.";
    }

    $conn->close();
} else {
    echo "Invalid order ID.";
}
?>
