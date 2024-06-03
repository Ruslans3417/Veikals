<?php
include 'connect.php';

// Проверка, есть ли поисковый запрос
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Обновленный SQL-запрос для получения информации о продуктах без рейтинга
$sql = "SELECT products.*
        FROM products";

// Если есть поисковый запрос, добавляем условие для поиска
if ($search_query) {
    $sql .= " WHERE products.name LIKE '%" . $conn->real_escape_string($search_query) . "%'";
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
                        <img src='foto/" . htmlspecialchars($row['image']) . "' class='card-img-top' alt='" . htmlspecialchars($row['name']) . "'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . htmlspecialchars($row['name']) . "</h5>";
                            if (isset($row['description'])) {
                                echo "<p class='card-text'>" . htmlspecialchars($row['description']) . "</p>";
                            }
                            echo "
                            <p class='card-text'>price: $" . htmlspecialchars($row['price']) . "</p>
                            <form action='add_to_cart.php' method='post'>
                                <input type='hidden' name='product_id' value='" . $row["id"] . "'>
                                <input type='hidden' name='product_price' value='" . $row["price"] . "'>
                                <button type='submit' class='btn btn-primary'>Add to Cart</button>
                            </form>
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
