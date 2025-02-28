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
      <?php require_once("layout/nav.php") ?>
    </header>
    <main>
          
          <section id="aboutus">
          <h1>Sobre nosotros</h1>
            <article>
                <div>
                  <h2>Since 2003</h2>
                  <p>RUSANCO IND nació en 2003 de la amistad y visión compartida de Gerónimo Banavides y Martín Disalvo, dos amigos de la secundaria que decidieron emprender juntos en el mundo de la moda. Con la idea de crear ropa única y auténtica, abrieron su primer local en una galería de Flores, Buenos Aires, y rápidamente captaron la atención de quienes buscan calidad y estilo sin seguir las tendencias de siempre.</p>
                </div>
                <div>
                  <figure>
                    <img src="./img/sobreNosotros1.jpg">
                  </figure>
                </div> 
            </article>

            <article>
              <div>
                  <figure>
                    <img src="./img/sobrenosotros2.jpg">
                  </figure>
              </div>
              
                <div>
                    <p>Hoy, RUSANCO IDN es sinónimo de prendas urbanas de diseño propio, como remeras, buzos, camperas y accesorios, pensadas para quienes valoran la creatividad y la durabilidad. Tras el éxito de su tienda inicial, la marca dio el salto a Palermo, consolidándose como un referente de moda joven y fresca.</p>
                    <p>Más que una marca, somos una comunidad que celebra la individualidad y el estilo propio. En RUSANCO IDN, creemos que la moda es una forma de expresión, y nos apasiona ofrecerte piezas que te acompañen a ser tú mismo, sin reglas ni restricciones.</p>
                </div>
             
            </article>
          </section>
          <section id="publicidad">
                <iframe src="https://www.youtube.com/embed/csh5JtWVe-Q?si=GhkqzE_gwRmcKVtn" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </section>
    </main>
    
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>

</html>