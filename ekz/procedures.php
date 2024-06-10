<?php
session_start();
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Procedures</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container my-4">
    <h1 class="text-center">Our Procedures</h1>
    <hr>
    <div class="row">
        <?php
        $sql = "SELECT id, name, price, image FROM procedures";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='foto/" . $row["image"] . "' class='card-img-top' alt='" . $row["name"] . "'>
                        <div class='card-body'>
                            <h5 class='card-title'>" . $row["name"] . "</h5>
                            <p class='card-text'>Price: $" . $row["price"] . "</p>
                            <form action='appointments.php' method='post'>
                                <input type='hidden' name='procedure_id' value='" . $row["id"] . "'>
                                <button type='submit' class='btn btn-primary'>Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No procedures available at the moment.</p>";
        }
        ?>
    </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
