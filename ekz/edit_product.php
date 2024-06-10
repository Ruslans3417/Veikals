<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Товар не найден";
        exit();
    }
} else {
    echo "Неверный запрос.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать товар</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Редактировать товар</h1>
        <form action="update_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="productName">Название товара</label>
                <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Цена товара</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Описание товара</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="productPromotion">Акционный товар</label>
                <input type="checkbox" id="productPromotion" name="productPromotion" value="1" <?php if ($product['promotion']) echo 'checked'; ?>>
            </div>
            <div class="form-group">
                <label for="productImage1">Изображение товара 1</label>
                <input type="file" class="form-control-file" id="productImage1" name="productImage1">
                <?php if (!empty($product['image'])): ?>
                    <img src="<?php echo $product['image']; ?>" alt="Product Image 1" style="width: 100px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="productImage2">Изображение товара 2</label>
                <input type="file" class="form-control-file" id="productImage2" name="productImage2">
                <?php if (!empty($product['image2'])): ?>
                    <img src="<?php echo $product['image2']; ?>" alt="Product Image 2" style="width: 100px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="productImage3">Изображение товара 3</label>
                <input type="file" class="form-control-file" id="productImage3" name="productImage3">
                <?php if (!empty($product['image3'])): ?>
                    <img src="<?php echo $product['image3']; ?>" alt="Product Image 3" style="width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
