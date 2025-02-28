<?php

session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
}


require_once('consultas/conexion.php');
require_once("funciones/verifiicacion.php");
include "consultas/conexion.php";
$id = $_GET["id"];

$sql = $conexion->query("SELECT * FROM rusanco WHERE id=$id");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificacion producto</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <?php require_once('layout/links.php') ?>
</head>

<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>

    <main>
    <?php require_once('layout/nav_intranet.php') ?>
        <div class="container">
            <h1>Modificar Producto: <?php echo $id;?></h1>
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <?php
                include "./funciones/modificarProducto.php";
                while($datos = $sql->fetchObject()) {
                ?>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del producto</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre" value="<?php echo $datos->nombre; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="talle" class="form-label">Talle del producto</label>
                        <input type="text" name="talle" id="talle" class="form-control" placeholder="Ingrese el talle del producto" value="<?php echo $datos->talle; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" placeholder="Ingrese el precio" value="<?php echo $datos->precio; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="Ingrese el stock del producto" value="<?php echo $datos->stock; ?>">
                    </div>
                    
                <?php } ?>
                <button type="submit" name="MODIFICACION" class="btn btn-primary" value="ok">Modificar Producto</button>
            </form>
        </div>
    </main>

    <footer>
        <?php require_once('layout/footer.php') ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

