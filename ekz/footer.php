<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer</title>
  <link rel="stylesheet" href="path/to/footer.css">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: 0;
    }
    .content {
      flex: 1;
    }
    .footer {
      background-color: #343a40;
      color: #fff;
      padding: 50px 20px;
    }
    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
    }
    .block {
      flex-basis: calc(33.33% - 20px);
      margin-bottom: 20px;
    }
    .footer-heading {
      font-size: 20px;
    }
    .footer-section-content p {
      margin: 10px 0;
    }
    .footer-bottom {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="content">
    <!-- Основное содержимое страницы -->
  </div>
  <footer class="footer">
    <div class="footer-container">
      <div class="block">
        <h3 class="footer-heading">Uzņēmums</h3>
        <div class="footer-section-content">
          <p>Mēs esam uzņēmums, kas piedāvā augstas kvalitātes kosmētiku par pieejamām cenām.</p>
        </div>
      </div>
      <div class="block">
        <h3 class="footer-heading">Kontakti</h3>
        <div class="footer-section-content">
          <p>Telefons: +371 20061409</p>
          <p>E-pasts: crystalino.shop@gmail.com</p>
          <p>Adrese: Graudu iela 27</p>
        </div>
      </div>
      <div class="block">
        <h3 class="footer-heading">Sociālie tīkli</h3>
        <div class="footer-section-content">
          <p>
            <a href="https://www.facebook.com/crystalino.shop">Facebook</a>
          </p>
          <p>
            <a href="https://www.instagram.com/crystalino.beauty/">Instagram</a>
          </p>
          <p>
            <a href="https://api.whatsapp.com/send?phone=37120061409&text=Labdien%21%0AV%C4%93los%20pierakst%C4%ABties%20uz%20proced%C5%ABru">WhatsApp</a>
          </p>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024.</p>
    </div>
  </footer>
</body>
</html>
