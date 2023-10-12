<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MakanYuk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?= include("navbar.php") ?>

  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide mt-3 rounded-carousel" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./images/food1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/food2.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="./images/food3.jpeg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" ariahidden="true"></span>
        <span class="visually-hidden">Next</span>
      </a>
    </div>
  </div>

  <section class="menu" style="margin-top: 10vh;">
    <div class="container">
      <h2 class="text-center">Menu</h2>
      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
          <div class="card">
            <img src="./images/food1.png" class="card-img-top" style="height: 250px; object-fit: cover;"
              alt="Menu Item 1">
            <div class="card-body">
              <h5 class="card-title">Menu Item 1</h5>
              <p class="card-text">Description of menu item 1.</p>
            </div>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
          <div class="card">
            <img src="./images/food2.jpeg" class="card-img-top" style="height: 250px; object-fit: cover;"
              alt="Menu Item 2">
            <div class="card-body">
              <h5 class="card-title">Menu Item 2</h5>
              <p class="card-text">Description of menu item 2.</p>
            </div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
          <div class="card">
            <img src="./images/food3.jpeg" class="card-img-top" style="height: 250px; object-fit: cover;"
              alt="Menu Item 3">
            <div class="card-body">
              <h5 class="card-title">Menu Item 3</h5>
              <p class="card-text">Description of menu item 3.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center">
        <a href="#" class="btn btn-custom mt-3">View All Menu</a>
      </div>
    </div>
  </section>

  <section class="container register-section mt-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-content">
        <h1>Pesan dari rumah via delivery</h1>
        <a href="register.php" class="btn btn-custom mt-3">Daftar sekarang</a>
      </div>
      <div class="col-md-6 illustration-content">
        <img src="./images/OBJECT.png" alt="illustration" class="img-fluid illustration">
      </div>
    </div>
  </section>

  <?= include("footer.php") ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>