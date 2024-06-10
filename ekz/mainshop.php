<?php
include 'connect.php';

// Проверка, есть ли поисковый запрос и фильтры по цене
$search_query = isset($_GET['search']) ? $_GET['search'] : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : 0;

// Обновленный SQL-запрос для получения информации о продуктах
$sql = "SELECT * FROM products WHERE 1=1";

// Если есть поисковый запрос, добавляем условие для поиска
if ($search_query) {
    $sql .= " AND name LIKE '%" . $conn->real_escape_string($search_query) . "%'";
}

// Проверка значений цены
if ($min_price < 0) {
    $min_price = 0;  // Установка минимальной цены в 0, если она отрицательная
}
if ($max_price < 0) {
    $max_price = 0;  // Установка максимальной цены в 0, если она отрицательная
}

// Если установлены минимальная и/или максимальная цена, добавляем условия для фильтрации
if ($min_price > 0) {
    $sql .= " AND price >= " . $min_price;
}
if ($max_price > 0) {
    $sql .= " AND price <= " . $max_price;
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            max-height: 200px;
            object-fit: cover;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card {
            flex: 1 1 calc(33.333% - 15px); /* Adjusts the cards to be 3 per row with some gap */
            max-width: calc(33.333% - 15px);
        }
        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 15px); /* Adjusts the cards to be 2 per row on small screens */
                max-width: calc(50% - 15px);
            }
        }
        @media (max-width: 576px) {
            .card {
                flex: 1 1 100%; /* Single column layout on extra small screens */
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="content">
    <div class="container my-4">
        <div class="row">
            <div class="col-md-6">
                <form class="form-inline" method="get" action="mainshop.php">
                    <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo htmlspecialchars($search_query); ?>">
                    <input class="form-control mr-sm-2" type="number" name="min_price" placeholder="Min Price" min="0" aria-label="Min Price" value="<?php echo isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : ''; ?>">
                    <input class="form-control mr-sm-2" type="number" name="max_price" placeholder="Max Price" min="0" aria-label="Max Price" value="<?php echo isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : ''; ?>">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='card mb-4 shadow-sm'>
                        <div id='carousel" . $row['id'] . "' class='carousel slide' data-ride='carousel'>
                            <div class='carousel-inner'>";
                    if (!empty($row['image'])) {
                        echo "
                                <div class='carousel-item active'>
                                    <img src='" . htmlspecialchars($row['image']) . "' class='d-block w-100' alt='" . htmlspecialchars($row['name']) . "'>
                                </div>";
                    }
                    if (!empty($row['image2'])) {
                        echo "
                                <div class='carousel-item" . (empty($row['image']) ? ' active' : '') . "'>
                                    <img src='" . htmlspecialchars($row['image2']) . "' class='d-block w-100' alt='" . htmlspecialchars($row['name']) . "'>
                                </div>";
                    }
                    if (!empty($row['image3'])) {
                        echo "
                                <div class='carousel-item" . (empty($row['image']) && empty($row['image2']) ? ' active' : '') . "'>
                                    <img src='" . htmlspecialchars($row['image3']) . "' class='d-block w-100' alt='" . htmlspecialchars($row['name']) . "'>
                                </div>";
                    }
                    echo "
                            </div>
                            <a class='carousel-control-prev' href='#carousel" . $row['id'] . "' role='button' data-slide='prev'>
                                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                <span class='sr-only'>Previous</span>
                            </a>
                            <a class='carousel-control-next' href='#carousel" . $row['id'] . "' role='button' data-slide='next'>
                                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                <span class='sr-only'>Next</span>
                            </a>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>" . htmlspecialchars($row['name']) . "</h5>";
                    if ($row['promotion']) {
                        echo "<p class='card-text text-danger'>Товар по акции!</p>";
                        echo "<p class='card-text text-danger'>Price: €" . htmlspecialchars($row['price']) . "</p>";
                    } else {
                        echo "<p class='card-text'>Price: €" . htmlspecialchars($row['price']) . "</p>";
                    }
                    if (isset($row['description'])) {
                        echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
                    }
                    echo "
                            <form action='add_to_cart.php' method='post'>
                                <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                                <input type='hidden' name='product_price' value='" . $row["price"] . "'>
                                <button type='submit' class='btn btn-primary'>Add to Cart</button>
                            </form>
                            <a href='otziv.php?id=" . $row["id"] . "' class='btn btn-info mt-2'>Отзывы</a>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>No products found</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
