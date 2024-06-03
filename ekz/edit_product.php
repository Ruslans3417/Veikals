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
        echo "Produkts nav atrasts";
        exit();
    }
} else {
    echo "Nederīgs pieprasījums.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediģēt produktu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Rediģēt produktu</h1>
        <form action="update_product.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="form-group">
                <label for="productName">produkta nosaukums</label>
                <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productPrice">Produkta cena</label>
                <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="productDescription">Produkta apraksts</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="productImage">Produkta attēls</label>
                <input type="file" class="form-control-file" id="productImage" name="productImage">
                <?php if (!empty($product['image'])): ?>
                    <img src="foto/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Saglabāt izmaiņas</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
