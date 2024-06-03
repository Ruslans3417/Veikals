<?php
session_start();
include 'connect.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Получение информации о пользователе
$stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Получение данных о заказах пользователя
$stmt = $conn->prepare("SELECT orders.id, orders.status, products.name AS product_name, order_items.quantity 
                        FROM orders 
                        JOIN order_items ON orders.id = order_items.order_id 
                        JOIN products ON order_items.product_id = products.id 
                        WHERE orders.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();

// Получение данных о товарах в корзине
$cart = $_SESSION['cart'] ?? [];
$products = [];

if ($cart) {
    $product_ids = implode(',', array_keys($cart));
    $sql = "SELECT * FROM products WHERE id IN ($product_ids)";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $products[$row['id']] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lietotāja profils</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h1>Lietotāja profils</h1>
    <h3>Personas dati</h3>
    <form action="update_profile.php" method="post">
        <div class="form-group">
            <label for="username">Lietotājvārds:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Jauna parole:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Atjaunināt</button>
    </form>

    <h3 class="mt-5">Iepirkumu grozs</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prece</th>
                <th>Daudzums</th>
                <th>Cena</th>
                <th>Kopā</th>
                <th>Darbības</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_price = 0;
            foreach ($cart as $product_id => $quantity) {
                $product = $products[$product_id];
                $total = $product['price'] * $quantity;
                $total_price += $total;
                echo "<tr>
                    <td>{$product['name']}</td>
                    <td>{$quantity}</td>
                    <td>\${$product['price']}</td>
                    <td>\${$total}</td>
                    <td>
                        <form action='remove_from_cart.php' method='post' style='display:inline-block;'>
                            <input type='hidden' name='product_id' value='{$product_id}'>
                            <button type='submit' class='btn btn-danger btn-sm'>Noņemt</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
            <tr>
                <td colspan="3" class="text-right"><strong>Kopējā summa:</strong></td>
                <td><strong>$<?php echo $total_price; ?></strong></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" data-toggle="modal" data-target="#checkoutModal">Pasūtīt</button>

    <h3 class="mt-5">Pasūtījumu vēsture</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pasūtījuma ID</th>
                <th>Prece</th>
                <th>Daudzums</th>
                <th>Kopējā cena</th>
                <th>Statuss</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = $orders->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['total_price'] ?? ''; ?></td>
                    <td><?php echo $order['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process_order.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Pasūtījuma noformēšana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Vārds:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Adrese:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Tālrunis:</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Atcelt</button>
                    <button type="submit" class="btn btn-primary">Pabeigt</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
