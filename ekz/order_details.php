<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows == 0) {
    echo "Order not found or you do not have permission to view this order.";
    exit();
}

$order = $order_result->fetch_assoc();

$sql = "SELECT products.name, order_items.quantity, order_items.price FROM order_items 
        JOIN products ON order_items.product_id = products.id 
        WHERE order_items.order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$items_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-4">
    <h1>Order Details</h1>
    <div class="card mb-4">
        <div class="card-header">
            <strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?>
        </div>
        <div class="card-body">

            <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
            <h4>Items</h4>
            <ul class="list-group">
                <?php
                while ($item = $items_result->fetch_assoc()) {
                    echo "<li class='list-group-item'>
                            <strong>" . htmlspecialchars($item['name']) . "</strong>
                            <span class='badge badge-primary badge-pill'>" . htmlspecialchars($item['quantity']) . "</span>
                            <span class='badge badge-secondary'>€" . htmlspecialchars($item['price']) . "</span>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <a href="profile.php" class="btn btn-secondary">Back to Profile</a>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
