<?php

include_once('funciones/verifiicacion.php');
include('consultas/conexion.php');
include('consultas/consulta_usuarios.php');


$nombre_usuario = filter_var($_POST['nombre_usuario'] ?? null, FILTER_SANITIZE_STRING);
$nombre_completo = filter_var($_POST['nombre_completo'] ?? null, FILTER_SANITIZE_STRING);
$contrasena = verif($_POST['contrasena'] ?? null);
$telefono = isset($_POST['telefono']) ? (int) verif($_POST['telefono']) : null;
$mail = filter_var($_POST['mail'] ?? null, FILTER_VALIDATE_EMAIL);
$imagen = $_FILES['imagen'] ?? null;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if( empty($nombre_usuario) ) {
         $errores[] = 'Usted debe ingresar un nombre de usuario'; 
    }
    
    if( empty($nombre_completo) ) { 
        $errores[] = 'Usted debe su nombre completo'; 
    }

    if( empty($contrasena) ) { 
        $errores[] = 'Usted debe ingresar una contraseña'; 
    }

    if (empty($telefono)) { 
        $errores[] = 'Usted debe ingresar un numero de telefono'; 
    }
    if (empty($mail)) { 
        $errores[] = 'Usted debe ingresar un mail'; 
    }
    
    


    // Verifica si la persona ya esta registrado ya está registrado
    if( getUsuarioByNombreUsuario($conexion, $nombre_usuario) ) { 
        $errores[] = 'Ya hay alguien con el nombre de usuario'; 
    }
    if( getUsuarioByNombreCompleto($conexion, $nombre_completo) ) { 
        $errores[] = 'La persona ya tiene un usuario registrado'; 
    }
    if( getUsuarioByMail($conexion, $mail) ) { 
        $errores[] = 'El mail ya se encuentra registrado con un usuario'; 
    }

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

        $rutaimg = "./img/usuarios/{$time}{$imagen['name']}";
        move_uploaded_file($imagen['tmp_name'], $rutaimg );
    
        addUsuario($conexion, [
            'nombre_usuario' => $nombre_usuario,
            'nombre_completo' => $nombre_completo,
            'contrasena' => $contrasena,
            'telefono' => $telefono,
            'mail' => $mail,
            'imagen' => $nombreImagen
        ]);

        header('Location: cuentaUsuario.php');
       
    
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
    
    <div class="container">
        <a href="login.php" class="btn btn-secondary my-3">volver</a>
        <h1> Registrate</h1>
        
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
                <label for="nombre_usuario" class="form-label"> Nombre de usuario </label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="Ingrese el nombre de usuario que desea" >
            </div>
            <div class="mb-3">
                <label for="nombre_completo" class="form-label"> Ingrese su nombre completo </label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" placeholder="Ingrese su nombre y apellido" >
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label"> Contraseña </label>
                <input type="text" name="contrasena" id="contrasena" class="form-control" placeholder="Ingrese el contraseña de la cuenta" >
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label"> Telefono </label>
                <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese su numero de telefono">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label"> Ingrese su mail </label>
                <input type="text" name="mail" id="mail" class="form-control" placeholder="Ingrese su mail" >
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label"> Foto de perfil </label>
                <input type="file" name="imagen" id="imagen" class="form-control" >
            </div>
            <button type="submit" name="agregarProducto" class="btn btn-primary">Crear cuenta</button>
        </form>
    </div>
    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
