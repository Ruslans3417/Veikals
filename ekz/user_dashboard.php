<?php
include 'connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.id, products.name, products.price, products.image FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">My Dashboard</h1>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>
                            <div class='card mb-4'>
                                <img src='foto/" . $row["image"] . "' class='card-img-top' alt='" . $row["name"] . "'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row["name"] . "</h5>
                                    <p class='card-text'>Price: $" . $row["price"] . "</p>
                                    <form action='place_order.php' method='post'>
                                        <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                                        <button type='submit' class='btn btn-success'>Place Order</button>
                                    </form>
                                </div>
                            </div>
                          </div>";
                }
            } else {
                echo "<p>No products in cart</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
