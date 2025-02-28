<?php

session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
}

include('funciones/verifiicacion.php');
include('consultas/conexion.php');
include('consultas/consulta_productos.php');


$nombre = filter_var($_POST['nombre'] ?? null, FILTER_SANITIZE_STRING);
$categoria = verif($_POST['categoria'] ?? null);
$talle = verif($_POST['talle'] ?? null);

$precio = isset($_POST['precio']) ? (int) verif($_POST['precio']) : null;
$stock = isset($_POST['stock']) ? (int) verif($_POST['stock']) : null;
$imagen = $_FILES['imagen'] ?? null;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if( empty($nombre) ) {
         $errores[] = 'Usted debe ingresar un nombre'; 
    }
    if( empty($categoria) ) { $errores[] = 'Usted debe ingresar un la categoria del producto'; 
    }
    if( empty($talle) ) { 
        $errores[] = 'Usted debe ingresar un talle'; 
    }
    if (empty($precio) || $precio <= 0) { 
        $errores[] = 'Usted debe ingresar un precio mayor a 0'; 
    }
    if (empty($stock) || $stock <= 0) { 
        $errores[] = 'Usted debe ingresar un stock mayor a 0'; 
    }


    // Verifica si el nombre ya está registrado
    if( getProductoByNombre($conexion, $nombre) ) { 
        $errores[] = 'El nombre ya se encuentra registrado'; 
    }

    // Verifica el archivo
    if( $imagen && $imagen['error'] > 0 ) { 
        $errores[] = 'Usted debe ingresar una imagen'; 
    }
    if( $imagen && $imagen['error'] == 0 )
    {
        $pathinfo = pathinfo($imagen['name']);

        $extension = $pathinfo['extension'];
        
        $extensiones_validas = ['jpg', 'png', 'webp', 'jpeg'];

        if(!in_array( $extension, $extensiones_validas) ) { 
            $errores[] = 'Usted debe cargar una imagen con formato jpg, png, webp o jpeg';
         }
    }

  
    if (empty($errores)) {
   
        $time = time();
        
        $nombreImagen = "{$time}{$imagen['name']}";

        $rutaimg = "./img/{$time}{$imagen['name']}";
        move_uploaded_file($imagen['tmp_name'], $rutaimg );
    
        addProducto($conexion, [
            'nombre' => $nombre,
            'categoria' => $categoria,
            'talle' => $talle,
            'precio' => $precio,
            'stock' => $stock,
            'imagen' => $nombreImagen
        ]);

        header('Location: lista_productos.php');
       
    
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require_once('./layout/links.php') ?>
</head>
<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>
    <main>
    <?php require_once('layout/nav_intranet.php') ?>
    <div class="container">
        <h1> Agregar Producto </h1>

        <!-- Mostrar los errores aquí -->
        <?php if(!empty($errores)): ?>
            <ul class="alert alert-danger" role="alert">
                <?php foreach($errores as $e): ?>
                    <li><?php echo $e ?></li>
                <?php endforeach ?>    
            </ul>    
        <?php endif ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label"> Nombre del producto </label>
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese nombre" >
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label"> Categoría </label>
                <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Ingrese la categoria del producto" >
            </div>
            <div class="mb-3">
                <label for="talle" class="form-label"> Talle del producto </label>
                <input type="text" name="talle" id="talle" class="form-control" placeholder="Ingrese el talle del producto" >
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label"> Precio </label>
                <input type="number" name="precio" id="precio" class="form-control" placeholder="Ingrese el precio">
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label"> Stock </label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Ingrese el stock del producto" >
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label"> Imagen del Producto </label>
                <input type="file" name="imagen" id="imagen" class="form-control" >
            </div>
            
            <button type="submit" name="agregarProducto" class="btn btn-primary">Agregar Producto</button>
        </form>
    </div>
    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
