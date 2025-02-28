<?php

session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
}elseif($usuarioLogeado['rol']== 'Empleado'){
    header('Location:intranet.php');
}

require_once('consultas/conexion.php');
require_once("funciones/verifiicacion.php");
include "consultas/conexion.php";
$id = $_GET["id"];

$sql = $conexion->query("SELECT * FROM usuario WHERE id=$id");

$errores = [];
$imagen = $_FILES['imagen'] ?? null;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar si hay errores en los campos del formulario
    if (empty($_POST['nombre_usuario'])) {
        $errores[] = 'El nombre de usuario es obligatorio';
    }

    if (empty($_POST['nombre_completo'])) {
        $errores[] = 'El nombre completo es obligatorio';
    }

    if (empty($_POST['telefono'])) {
        $errores[] = 'El número de teléfono es obligatorio';
    }

    if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico es obligatorio y debe ser válido';
    }

    if ($imagen && $imagen['error'] > 0) {
        $errores[] = 'Hubo un error al cargar la imagen';
    } 
    if ($imagen && $imagen['error'] == 0) {
        $pathinfo = pathinfo($imagen['name']);
        $extension = $pathinfo['extension'];
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $extensionesPermitidas)) {
            $errores[] = 'La imagen debe tener uno de los siguientes formatos: jpg, jpeg, png, webp';
        }



    }
    if (empty($errores)) {


            $time = time();

            $imagenPath = "./img/usuarios/{$time}{$imagen['name']}";


            move_uploaded_file($imagen['tmp_name'], $imagenPath);


    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once('./layout/links.php') ?>
</head>
<body>
    <header>
        <?php include_once('./layout/nav.php') ?>
    </header>
    <main>
    <div class="container">
            <h1>Modificar usuario: <?php echo $id;?></h1>
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <?php
                include "./funciones/clientemodifica.php";

                while($datos = $sql->fetchObject()) {
                ?>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre del usuario</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" placeholder="Ingrese nombre de perfil" value="<?php echo $datos->nombre_usuario; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre y apellido</label>
                        <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" placeholder="Ingrese el nombre y apellido" value="<?php echo $datos->nombre_completo; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input type="text" name="contrasena" id="contrasena" class="form-control" placeholder="Ingrese la nueva contraseña" value="<?php echo $datos->contrasena; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el nuevo numero de telefono" value="<?php echo $datos->telefono; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="mail" class="form-label">Mail</label>
                        <input type="text" name="mail" id="mail" class="form-control" placeholder="Ingrese el nuevo mail" value="<?php echo $datos->mail; ?>">
                    </div>
                        
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Foto de perfil</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" value="<?php echo $datos->imagen; ?>">
                    </div>
                <button href="index.php" type="submit" name="clientemodi" class="btn btn-primary" value="ok">Modificar cuenta</button>
                <?php } ?>
            </form>
        </div>
    </main>
    <footer>
       <?php include_once('./layout/footer.php') ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>