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


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty($nombre)){

        $errores[] = 'Ustede debe ingresar un nombre';
    }

    if(empty($apellido)){

        $errores[] ='Ustede debe ingresar un apellido';
    }

    if(empty($mail)){

        $errores[] =  'Ustede debe ingresar un mail';
    }

    if(empty($telefono)){

        $errores[] = 'Ustede debe ingresar un numero de telefono';
    }
    if(empty($mensaje)){

        $errores[] = 'Ustede debe ingresar un el motivo de su consulta';
    }

    if(empty($errores)){
        header('Location: post_form.php');
    }
}

?>


<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>contacto</title>
    <?php require_once('layout/links.php')?>
</head>

<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>
    <main>
    
        <h1 id="contacto">Contacto</h1>
        <section id="form">
            <h2>Complea el formulario</h2>

            <?php
            
            if(!empty($errores)): ?>
            <ul class="alert alert-danger" role="alert">
                <?php foreach($errores as $e):?>
                    <ul><?php echo $e ?></ul>
                <?php endforeach ?>    
            </ul>    

            <?php endif ?>
                
            
            
            
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

                    <label for="mensaje">Motivo de contacto</label>
                    <textarea name="mensaje" id="mensaje" cols="30"></textarea>

                    <input type="submit">

                </form>
            </article>

            <?php echo $errores = '';?>
        </section>
    

    <section id="sucursales">

            <h2>Sucursales</h2>

        <div>
            <article id="iframe">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5523.426720319905!2d-58.383098475201194!3d-34.59786008966195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccacb0b1afcaf%3A0x8d53a5cf4f399e9c!2zR2FsZXLDrWFzIFBhY8OtZmljbw!5e0!3m2!1ses!2sar!4v1731278780183!5m2!1ses!2sar" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </article>

            <article id="direccion">
                    <ul>
                        <li>PALERMO - Calle Humboldt 2343, Palermo, CABA, Buenos Aires, Argentina.</li>
                        <li>CABALLITO - Calle José María Rodríguez 1945, Caballito, CABA, Buenos Aires, Argentina.</li>
                        <li>BALVANERA - Calle Bartolomé Mitre 1120, Balvanera, CABA, Buenos Aires, Argentina.</li>
                        <li>ALMAGRO - Calle Corrientes 3950, Almagro, CABA, Buenos Aires, Argentina.</li>
                        <li>FLORES - Calle Avellaneda 4200, Flores, CABA, Buenos Aires, Argentina.</li>
                    </ul>

            </article>
        </div>        
    </section>
    
    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>