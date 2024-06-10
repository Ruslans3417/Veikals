<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veikals</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
        .carousel-item img {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Veikals</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Text -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Sveiki!<br>
              Mani sauc Natalija. Es esmu kosmetoloģe-estētiķe no Liepājas.<br>
              Lielākā daļa mani pazīst kā Crystalino. Es padaru meitenes laimīgas gan savā kabinetā, gan tiešsaistē.<br>
              Piedāvāju veidot jūsu mājas kopšanu, izmantojot profesionālās līnijas un Korejas produktus. Būšu priecīga,<br>
              ja jūs uzticēsiet man rūpes par jūsu skaistumu un ādas veselību!</h1>
            <p class="lead"></p>
        </div>
    </header>

    <!-- Jūsu atsauksmes Carousel -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center">Jūsu atsauksmes</h2>
            <div id="reviewsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="C:\Games\xampp\htdocs\ekz\foto\20.png" alt="Review 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Review 2">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Review 3">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Review 4">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#reviewsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#reviewsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Products Carousel -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center">Our Products</h2>
            <div id="productsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/800x400" alt="Product 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Product 1</h5>
                            <p>Short description of product 1.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Product 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Product 2</h5>
                            <p>Short description of product 2.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Product 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Product 3</h5>
                            <p>Short description of product 3.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x400" alt="Product 4">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Product 4</h5>
                            <p>Short description of product 4.</p>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#productsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="py-4 bg-dark text-white-50">
      <div class="container text-center">
          <small>&copy; 2024 Veikals. All rights reserved.</small>
      </div>
  </footer>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
