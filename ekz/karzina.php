<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Veikals</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .profile-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">Veikals</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.html">Profile</a>
                        <span class="sr-only">(current)</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container my-5">
            <div class="profile-container">
                <h2 class="text-center">User Profile</h2>
                <hr>
                <h4>My Orders</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample Order Data -->
                        <tr>
                            <td>101</td>
                            <td>Product 1</td>
                            <td>Shipped</td>
                            <td>2024-05-25</td>
                        </tr>
                        <tr>
                            <td>102</td>
                            <td>Product 2</td>
                            <td>Processing</td>
                            <td>2024-05-26</td>
                        </tr>
                        <!-- More orders can be added dynamically -->
                    </tbody>
                </table>
                <hr>
                <h4>Account Information</h4>
                <p>
                    <strong>Username:</strong> JohnDoe<br>
                    <strong>Email:</strong> john@example.com<br>
                </p>
                <a href="edit_profile.html" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>&copy; 2024 Veikals. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
