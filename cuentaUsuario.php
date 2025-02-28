<?php
session_start();
$usuarioLogeado = $_SESSION['usuario'] ?? null;


if(!$usuarioLogeado){
    header('Location: login.php');
}

require_once ('./consultas/conexion.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once('layout/links.php')?>
</head>
<body>
    <header>
        <?php require_once('layout/nav.php')?> 
    </header>
    
    <main>
    <section class="d-flex justify-content-center">
        <article>
            <div >
                
                    <img class="rounded-circle d-flex justify-content-center" style="max-width: 400px; max-heigth: 400px;" src="./img/usuarios/<?php echo $usuarioLogeado['imagen']?>"  alt="imagen del usuario"/>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary w-25 d-flex justify-content-center my-4 " href='edicionCliente.php?id=<?php echo $usuarioLogeado['id']; ?>'>Editar</a>
                    </div>
                <div class="flex-column rounded my-4"  style="background-color: #e7e7e7;"> 
                    <p>Nombre de usuario: <?php echo $usuarioLogeado['nombre_usuario']?></p>
                    <p>Nombre Completo: <?php echo $usuarioLogeado['nombre_completo']?></p>
                    <p>Telefono: <?php echo $usuarioLogeado['telefono']?></p>
                    <p>Mail: <?php echo $usuarioLogeado['mail']?></p>
                    <p>Contraseña: <?php echo $usuarioLogeado['contrasena']?></p>
                </div>
            </div>
            <div class="d-flex justify-content-center my-4" >
                <a class="btn btn-primary mx-1" href='edicionCliente.php?id=<?php echo $usuarioLogeado['id']; ?>'>Modificar</a>
                <a class="btn btn-primary mx-1" href='cerrarSesion.php'>Cerrar Sesion</a>
            </div>
        </article>
    </section>

    </main>
    <footer>
        <?php require_once('layout/footer.php')?> 
    </footer>
</body>
</html>