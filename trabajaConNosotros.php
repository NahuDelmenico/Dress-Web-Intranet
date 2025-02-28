<?php   

session_start();
$usuarioLogeado = $_SESSION['usuario'] ?? null;

require_once('./consultas/conexion.php');
require_once("funciones/verifiicacion.php");

$nombre = $_POST['nombre'] ?? null;
$nombre = verif($nombre);

$apellido= $_POST['apellido'] ?? null;
$apellido= verif($apellido);

$mail = $_POST['email'] ?? null;
$mail = filter_var($mail, FILTER_VALIDATE_EMAIL);

$telefono = $_POST['telefono'] ?? null;
$telefono = verif($telefono);

$mensaje = $_POST['mensaje'] ?? null;
$mensaje = verif($mensaje);

$errores = [];

$file = $_FILES['file'] ?? null; 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty($nombre)){

        $errores[] = 'Ustede debe ingresar un nombre';
    }

    if(empty($apellido)){

        $errores[] = 'Ustede debe ingresar un apellido ';
    }

    if(empty($mail)){

        $errores[] = 'Ustede debe ingresar un mail ';
    }

    if(empty($telefono)){

        $errores[] =  'Ustede debe ingresar un numero de telefono';
    }
    if(empty($mensaje)){

        $errores[] =   'Ustede debe ingresar un el motivo de su consulta ';
    }


    if ($file && $file['error'] > 0) {
        $errores[] = "Ingrese su curriculum";
    }
    
    if ($file && $file['error'] == 0 ) {
         
        $pathinfo = pathinfo($file['name']);
        
        $extension = $pathinfo['extension'];

        $extensiones= ['pdf', 'docx', 'jpg'];

        if( !in_array( $extension, $extensiones) )
        {
            $errores[] = 'Usted debe cargar un curriculum con formato pdf, docx o jpg';
        }
    }

    if(empty($errores)){

        $time = time();
        $curriculum = "./docs/{$time}{$file['name']}";

        move_uploaded_file( $file['tmp_name'], $curriculum );

        header('Location: post_cv.php');
    } 
    

    
}






?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once('layout/links.php')?>
</head>
<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>
    <main>
    <h1  class="trabajaConNosotros">Trabaja con nosotros</h1>
    <?php
            
            if(!empty($errores)): ?>
            <ul class="alert alert-danger" role="alert">
                <?php foreach($errores as $e):?>
                    <ul><?php echo $e ?></ul>
                <?php endforeach ?>    
            </ul>    

            <?php endif ?>
    <section id="form">
            <article>
                <form action="" method="post" enctype="multipart/form-data" >
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre">

                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido">

                    <label for="telefono">Telefono</label>
                    <input type="number" name="telefono" id="telefono" placeholder="Numero de telefono">

                    <label for="email">Corre Electronico</label>
                    <input type="email" name="email" id="email" placeholder="Correo electronico">

                    <label for="mensaje">Presentacion</label>
                    <textarea name="mensaje" id="mensaje" cols="30" placeholder="Consulta"></textarea>

                    <label for="file">Adjunte su Curriculum</label>
                    <input type="file" name="file" id="file">

                    <input type="submit">

                </form>
            </article>
        </section>
    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>   
</body>
</html>