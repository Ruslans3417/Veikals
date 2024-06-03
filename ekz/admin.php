<?php
session_start();



include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<body>
<?php include 'header.php'; ?>
    <!-- Header -->
   

    <!-- Main Content -->
    <div class="content">
        <div class="container my-4">
            <h1 class="text-center">Admin Panel</h1>
            <hr>

            <!-- Manage Users Section -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Users
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, name, email, is_admin FROM users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $role = $row['is_admin'] ? 'Admin' : 'User';
                                    $buttonText = $row['is_admin'] ? 'Revoke Admin' : 'Make Admin';
                                    echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["email"] . "</td>
                                        <td>" . $role . "</td>
                                        <td>

                                            <form action='delete_user.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Manage Products Section -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Products
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, name, price, image FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["name"] . "</td>
                                        <td>" . $row["price"] . "</td>
                                        <td><img src='foto/" . $row["image"] . "' alt='" . $row["name"] . "' style='width: 50px;'></td>
                                        <td>
                                            <form action='edit_product.php' method='get' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                <button type='submit' class='btn btn-warning btn-sm'>Edit</button>
                                            </form>
                                            <form action='delete_product.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='id' value='" . $row["id"] . "'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No products found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Product Section -->
            <div class="card mb-4">
                <div class="card-header">
                    Add Product
                </div>
                <div class="card-body">
                    <form action="add_product.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
                        </div>
                        <div class="form-group">
                            <label for="productPrice">Product Price</label>
                            <input type="text" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required>
                        </div>
                        <div class="form-group">
                            <label for="productImage">Product Image</label>
                            <input type="file" class="form-control-file" id="productImage" name="productImage" required>
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product Description</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3" placeholder="Enter product description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>

            <!-- Manage Orders Section -->
            <div class="card mb-4">
                <div class="card-header">
                    Manage Orders
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT orders.id AS order_id, users.name AS user_name, orders.status 
                                    FROM orders 
                                    JOIN users ON orders.user_id = users.id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["order_id"] . "</td>
                                        <td>" . $row["user_name"] . "</td>
                                        <td><button class='btn btn-info btn-sm' onclick='showOrderDetails(" . $row["order_id"] . ")'>View Products</button></td>
                                        <td>" . $row["status"] . "</td>
                                        <td>
                                            <form action='update_order_status.php' method='post' style='display:inline-block;'>
                                                <input type='hidden' name='order_id' value='" . $row["order_id"] . "'>
                                                <select class='form-control form-control-sm' name='status'>
                                                    <option value='Processing'" . ($row["status"] == "Processing" ? " selected" : "") . ">Processing</option>
                                                    <option value='Shipped'" . ($row["status"] == "Shipped" ? " selected" : "") . ">Shipped</option>
                                                    <option value='Cancelled'" . ($row["status"] == "Cancelled" ? " selected" : "") . ">Cancelled</option>
                                                </select>
                                                <button type='submit' class='btn btn-success btn-sm mt-1'>Update Status</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No orders found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Modal for displaying order details -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="orderDetailsContent">
                    <!-- Order details will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#header").load("header.php");
            $("#footer").load("footer.php");
        });

        function showOrderDetails(orderId) {
            $.ajax({
                url: 'get_order_details.php',
                method: 'GET',
                data: { order_id: orderId },
                success: function(response) {
                    $('#orderDetailsContent').html(response);
                    $('#orderDetailsModal').modal('show');
                },
                error: function() {
                    alert('Failed to fetch order details.');
                }
            });
        }
    </script>
</body>
</html>
