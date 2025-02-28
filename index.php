<?php  
session_start();
$usuarioLogeado = $_SESSION['usuario'] ?? null;


require_once('./consultas/conexion.php');


?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RUSANCO</title>
    <?php require_once('layout/links.php')?>
  </head>

<body>
    <header>
      <?php require("layout/nav.php") ?>
    </header>
    <main>
          <section id="carouselExampleDark" class="carousel carousel-dark slide">
            <article class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </article>

            <article class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="img/carrusel/BANNER.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  
                </div>
              </div>

              <div class="carousel-item" data-bs-interval="2000">
                <img src="img/carrusel/BANNER.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                </div>
              </div>

              <div class="carousel-item">
                <img src="img/carrusel/BANNER.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
  
                </div>
              </div>
            </article>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </section>

          <h1 class='busqueda'>¿Que estas buscando?</h1>
          <section class='mosaico'>
            
            <article class='acceso'>
              <a href="productos.php">
                <figure>
                  <img src="img/remera_blanca.webp" alt="Remeras">
                </figure>
                <h2>REMERAS</h2>
              </a>
            </article>
            <article class='acceso'>
              <a href="productos.php">
                <figure>
                  <img src="img/jean_vitruvio.webp" alt="Jeans">
                </figure>
                <h2>JEANS</h2>
              </a>
            </article>
            <article class='acceso'>
              <a href="productos.php">
                <figure>
                  <img src="img/buzo_lenon.webp" alt="Buzos">
                </figure>
                <h2>BUZOS</h2>
              </a>
            </article>
          </section>

        
    </main>
    
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>