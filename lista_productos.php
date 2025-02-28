<?php

session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
}

require_once ('./consultas/conexion.php');
require_once ('./funciones/funciones.php');
require_once ('./consultas/consulta_productos.php');
require_once ('./consultas/consulta_categorias.php');
require_once ('./funciones/paginado.php');

// QUERY CATALOGO PRODUCTOS
$productos = getProductos($conexion);

// QUERY CATEGORIAS PRODUCTOS
$categorias = getCategorias($conexion);

// FILTRO DE PRODUCTOS
$categoria = $_GET['categoria'] ?? null;
$arrayFiltrado = getCatalogoFiltrado($productos, $categoria);


$pagina_actual = $_GET['pag'] ?? 1;
$cuantos_por_pagina = 6;

$cantidad = count($productos);

$arrayFiltrado = paginador_lista($arrayFiltrado, $pagina_actual, $cuantos_por_pagina);
$enlaces = paginador_enlaces($cantidad, $pagina_actual, $cuantos_por_pagina);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <?php require_once('./layout/links.php'); ?>
</head>
<body>
    <?php 
    include "consultas/conexion.php";
    include "funciones/eliminarProducto.php";  // Aquí se incluye el archivo para usar la función de eliminación.
    ?>
    <header>
        <?php require("layout/nav.php"); ?>
    </header>

    <main>

    <?php require_once('layout/nav_intranet.php') ?>

    <section  class="d-md-flex justify-content-center d-none" >    
           
        <div style="width: 80%">
        
            <h1>Lista de produtos</h1>
                <article id="filtro">
                    <form action="lista_productos.php#catalogo" method="get" class="my-1 py-1">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Filtrar por categoría</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Todos los productos</option>
                                <?php foreach ($categorias as $p): ?>
                                    <option value="<?php echo $p['categoria'] ?>"
                                        <?php echo ($categoria === $p['categoria']) ? 'selected' : ''; ?>>
                                        <?php echo $p['categoria'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color:black; border:0px;">Filtrar</button>
                    </form>
                </article>

                <a class="btn btn-primary" href="agregarProducto.php">Agregar producto</a>
                
                <article>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Talle</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($arrayFiltrado as $p): ?>
                                    <tr>
                                        <td><?php echo ($p['id']); ?></td>
                                        <td><img src="./img/<?php echo ($p['imagen']); ?>" width="100px" alt="<?php echo ($p['nombre']); ?>" /></td>
                                        <td><?php echo ($p['nombre']); ?></td>
                                        <td><?php echo ($p['categoria']); ?></td>
                                        <td><?php echo ($p['talle']); ?></td>
                                        <td><?php echo ($p['precio']); ?></td>
                                        <td><?php echo ($p['stock']); ?></td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href='modificaciones_productos.php?id=<?php echo $p['id']; ?>'>Modificar</a>
                                            <!-- Enlace para eliminar con confirmación -->
                                            <a class="btn btn-danger btn-sm" href="lista_productos.php?id=<?php echo $p['id']; ?>" 
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                
                            </tbody>
                            <nav aria-label="Page navigation example" class="paginado">
                        <ul class="pagination">
                            <?php if($enlaces['anterior']): ?>
                                <li class="page-item"><a class="page-link" href="lista_productos.php?pag=<?php echo $enlaces['anterior'] ?>"> <<< </a></li>
                            <?php endif ?>
                            <li class="page-item"><a class="page-link" href="#"> Página actual: <?php echo $enlaces['actual'] ?> </a></li>
                            <?php if($enlaces['siguiente']): ?>
                                <li class="page-item"><a class="page-link" href="lista_productos.php?pag=<?php echo $enlaces['siguiente'] ?>"> >>> </a></li>
                            <?php endif ?>
                        </ul>
                    </nav>
                        </table>
                </article>
        </div>
        
    </section>
    <section class="respMovil">
        <h1 class="d-flex justify-content-center">Lista de Productos</h1>
        <?php foreach ($productos as $p):?>
          <article class="d-flex justify-content-center">
            <div class="card">
                <img src="./img/<?php echo $p['imagen']?>"  alt="echo $p['<?php echo $p['nombre']?>']">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $p['nombre']?></h5>
                    <p class="card-text">Precio: <?php echo $p['precio']?></p>
                    <p class="card-text">Stock: <?php echo $p['stock']?></p>
                    <p class="card-text">Talle: <?php echo $p['talle']?></p>
                    <p class="card-text">Categoria: <?php echo $p['categoria']?></p>
                    <div class="d-flex justify-content-center">
                    <a class="btn btn-warning btn-sm mx-1" href='modificaciones_productos.php?id=<?php echo $p['id']; ?>'>Modificar</a>
                     <!-- Enlace para eliminar con confirmación -->
                    <a class="btn btn-danger btn-sm mx-1" href="lista_productos.php?id=<?php echo $p['id']; ?>" 
                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                    </div>
                </div>
            </div>
        </article>   

        <?php endforeach?>

        <nav aria-label="Page navigation example" class="paginado">
                        <ul class="pagination">
                            <?php if($enlaces['anterior']): ?>
                                <li class="page-item"><a class="page-link" href="lista_productos.php?pag=<?php echo $enlaces['anterior'] ?>"> <<< </a></li>
                            <?php endif ?>
                            <li class="page-item"><a class="page-link" href="#"> Página actual: <?php echo $enlaces['actual'] ?> </a></li>
                            <?php if($enlaces['siguiente']): ?>
                                <li class="page-item"><a class="page-link" href="lista_productos.php?pag=<?php echo $enlaces['siguiente'] ?>"> >>> </a></li>
                            <?php endif ?>
                        </ul>
                    </nav>
    </section>
    </main>
    <footer>
        <?php require_once('layout/footer.php'); ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

