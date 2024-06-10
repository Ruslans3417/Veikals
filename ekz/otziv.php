<?php
include 'connect.php';

// Проверка, есть ли ID продукта в URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Проверка, существует ли продукт с данным ID
$product_check_sql = "SELECT COUNT(*) FROM products WHERE id = ?";
$product_check_stmt = $conn->prepare($product_check_sql);
$product_check_stmt->bind_param("i", $product_id);
$product_check_stmt->execute();
$product_check_stmt->bind_result($product_exists);
$product_check_stmt->fetch();
$product_check_stmt->close();

if ($product_exists == 0) {
    die('Product not found');
}

// Обработка формы отправки отзыва
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $review_text = $_POST['review_text'];
    $rating = intval($_POST['rating']);
    
    // SQL-запрос для вставки нового отзыва
    $sql = "INSERT INTO reviews (product_id, user_name, review_text, rating) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $product_id, $user_name, $review_text, $rating);
    $stmt->execute();
}

// Получение отзывов для текущего продукта
$sql = "SELECT * FROM reviews WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container my-4">
    <h2>Product Reviews</h2>
    
    <!-- Форма для добавления отзыва -->
    <form method="post">
        <div class="form-group">
            <label for="user_name">Ваше имя</label>
            <input type="text" class="form-control" id="user_name" name="user_name" required>
        </div>
        <div class="form-group">
            <label for="review_text">Ваш отзыв</label>
            <textarea class="form-control" id="review_text" name="review_text" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Оценка</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="5">5 - Отлично</option>
                <option value="4">4 - Хорошо</option>
                <option value="3">3 - Средне</option>
                <option value="2">2 - Плохо</option>
                <option value="1">1 - Ужасно</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Оставить отзыв</button>
    </form>

    <!-- Список отзывов -->
    <h3 class="mt-4">Существующие отзывы</h3>
    <?php if (count($reviews) > 0): ?>
        <ul class="list-group">
            <?php foreach ($reviews as $review): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($review['user_name']); ?>:</strong>
                    <span><?php echo htmlspecialchars($review['review_text']); ?></span>
                    <div>Оценка: <?php echo htmlspecialchars($review['rating']); ?>/5</div>
                    <small><?php echo htmlspecialchars($review['created_at']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Пока отзывов нет. Будьте первым, кто оставит отзыв о данном продукте!</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
