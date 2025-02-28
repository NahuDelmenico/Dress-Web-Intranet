<?php 

session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;


require_once('./consultas/conexion.php');
require_once ('./funciones/funciones.php');
require_once ('./consultas/consulta_usuarios.php');
require_once('./funciones/verifiicacion.php');

$usuario = $_POST['usuario'] ?? null;
$usuario = verif($usuario);

$contrasena = $_POST['contrasena'] ?? null;
$contrasena = verif($contrasena);

$errores = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($usuario)){
        $errores[] = "Ingrese el nombre de usuario"; 
    }
    if(empty($contrasena)){
        $errores[] = "Ingrese la contraseña"; 
    }

    $usuarioLogeado = getUsuarioLogeado($conexion,$usuario,$contrasena);
    
    if(empty($errores)){
    
        if($usuarioLogeado){

            if($usuarioLogeado['rol'] == 'Empleado' || $usuarioLogeado['rol'] == 'Administrador'){
            
                $_SESSION['usuario'] = $usuarioLogeado;
                header('Location: intranet.php');

            }else{
                $_SESSION['usuario'] = $usuarioLogeado;
                header('Location: index.php');
            }
        }else{
            $errores[] = "Usuario y o contraseña incorrectos";
        }
    }
}


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
        <section class="login">
            <div class="form-box">
                <h1 class="title">Inicio de Sesion</h1>
                <p class="subtitle">Ingrese su nombre de usuario y contraseña</p>

                
               
            
                    <?php if(!empty($errores)): ?>
                    <ul class="alert alert-danger" role="alert">
                        <?php foreach($errores as $e):?>
                            <li><?php echo $e ?></li>
                        <?php endforeach ?>    
                    </ul>    
                    <?php endif ?>  

                
                <form action="" class="form pb-1" method="POST">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Usuario">

                    <label for="contrasena">Contraseña</label>
                    <input type="password" id="contrasena" 
                   name="contrasena" placeholder="Contraseña">
                
                   <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary">Iniciar Sesion</button>
                        
                    </div>
                </form>
                <p class="d-flex justify-content-center">¿Aun no tinenes cuenta?</p>
                 <a href="registro.php" class="d-flex justify-content-center">Registrarte aqui</a>
               
                
            </div>
        </section>
    </main>
    <footer>
        <?php require_once('layout/footer.php')?> 
    </footer>
</body>
</html>


