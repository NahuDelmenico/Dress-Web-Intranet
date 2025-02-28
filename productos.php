<?php

session_start();
$usuarioLogeado = $_SESSION['usuario'] ?? null;

require_once ('./consultas/conexion.php');
require_once ('./funciones/funciones.php');
require_once ('./consultas/consulta_productos.php');
require_once ('./consultas/consulta_categorias.php');
require_once ('./funciones/paginado.php');

// QUERY CATALOGO PRODUCTOS

$productos=getProductos($conexion);

// QUERY CATEGORIA PRODUCTOS

$categorias=getCategorias($conexion);


// FILTRO DE PRODUCTOS

$categoria = $_GET['categoria'] ?? null;
$arrayFiltrado=getCatalogoFiltrado($productos, $categoria);

// PAGINADO
$pagina_actual = $_GET['pag'] ?? 1;
$cuantos_por_pagina = 6;

$cantidad = count($productos);

$arrayFiltrado = paginador_lista($arrayFiltrado, $pagina_actual, $cuantos_por_pagina);
$enlaces = paginador_enlaces($cantidad, $pagina_actual, $cuantos_por_pagina);

?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Productos_rusanco </title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <?php require_once('layout/links.php')?>
</head>

<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>

    <main>
        
    <section id="productos">

        <figure>
            <img id="bannerProductos" src="img/carrusel/banner_productos.jpg" alt="Cyber week">
        </figure>
        
        <div class="container">
        <div class="container">
        <h1 class="text text-center">Productos</h1>

        <article id="filtro">
            <form action="productos.php#catalogo" method="get" class="mb-5">
                <div class="mb-3">
                    <label for="categoria" class="form-label"> Filtrar por categoría </label>
                   
                   
                    <select name="categoria" id="categoria" class="form-control">
                        
                        <option value="">Todos los productos</option>
                        <?php foreach ($categorias as $p): ?>
                            <option value="<?php echo $p['categoria'] ?>"><?php echo $p['categoria'] ?></option>
                        
                        <?php endforeach ?>

                        
                        
                     </select>

                </div>
                <button type="submit" class="btn btn-primary" style="background-color:black; border:0px;"> Filtrar </button>
            </form>
        </article>
                        
    <div id="catalogo">
        <?php foreach($arrayFiltrado as $p): ?>
                <article>
                    <div class="card" >
                        <img src="./img/<?php echo $p['imagen'] ?>" alt="<?php echo $p['nombre'] ?>" /> 
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $p['nombre'] ?></h5>
                            <p class="card-text">$<?php echo $p['precio'] ?> </p>
                        
                        </div>
                    <a href="#" class="boton_compra" >Comprar</a>
                    </div>
                </article>
        <?php endforeach ?>
    </div>
    <nav aria-label="Page navigation example" class="paginado">
            <ul class="pagination">
                <?php if($enlaces['anterior']): ?>
                    <li class="page-item"><a class="page-link" href="productos.php?pag=<?php echo $enlaces['anterior'] ?>"> <<< </a></li>
                <?php endif ?>
                <li class="page-item"><a class="page-link" href="#"> Página actual: <?php echo $enlaces['actual'] ?> </a></li>
                <?php if($enlaces['siguiente']): ?>
                    <li class="page-item"><a class="page-link" href="productos.php?pag=<?php echo $enlaces['siguiente'] ?>"> >>> </a></li>
                <?php endif ?>
            </ul>
        </nav>
    </section>


    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>