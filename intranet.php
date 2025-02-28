<?php 
session_start();
$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
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
        <?php require_once('layout/nav.php')?> 
    </header>

    <main>
        
    <?php require_once('layout/nav_intranet.php') ?>
    <section class="d-flex justify-content-center">
        <article>
            <h1>Bienvenido <?php echo $usuarioLogeado['nombre_usuario'] ?></h1>
    
        </article>
    </section>
    <section class="d-flex justify-content-center">
        <article>
            <div >
                
                    <img class="rounded-circle d-flex justify-content-center" style="max-width: 400px; max-heigth: 400px;" src="./img/usuarios/<?php echo $usuarioLogeado['imagen']?>"  alt="imagen del usuario"/>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary w-25 d-flex justify-content-center my-4" href='modificar_usuario.php?id=<?php echo $usuarioLogeado['id']; ?>'>Editar</a>
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
                <a class="btn btn-primary" href='modificar_usuario.php?id=<?php echo $usuarioLogeado['id']; ?>'>Modificar</a>
            </div>
        </article>
    </section>

    </main>
    
    <footer>
        <?php require_once('layout/footer.php')?> 
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>