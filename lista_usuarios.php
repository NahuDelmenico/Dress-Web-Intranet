<?php 
session_start();

$usuarioLogeado = $_SESSION['usuario'] ?? null;

if(!$usuarioLogeado){
    header('Location: login.php');
}elseif($usuarioLogeado['rol']== 'Empleado'){
    header('Location:intranet.php');
}


require_once('./consultas/conexion.php');
require_once('./funciones/funciones.php');
require_once('./consultas/consulta_usuarios.php');
require_once('./consultas/consulta_categorias.php');
require_once('./funciones/paginado.php');

// Obtener todos los usuarios
$usuarios = getUsuarios($conexion);

// Filtrado por rol
$roles = getRoles($conexion);
$rol = $_GET['rol'] ?? null;
$arrayFiltrado = getUsuariosFiltrado($usuarios, $rol);  // Aplicamos el filtro aquí

// Paginación
$pagina_actual = $_GET['pag'] ?? 1;
$cuantos_por_pagina = 6;
$cantidad = count($arrayFiltrado);  // Usamos los usuarios filtrados para la paginación

// Paginador de usuarios
$arrayFiltrado = paginador_usuario($arrayFiltrado, $pagina_actual, $cuantos_por_pagina);
$enlaces = paginador_enlaces($cantidad, $pagina_actual, $cuantos_por_pagina);

$usuarios = $arrayFiltrado;
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado usuairos</title>
    <?php require_once('./layout/links.php'); ?>
</head>
<body>
    <?php 
    include "consultas/conexion.php";
    include "funciones/eliminarUsuario.php";  
    ?>
    <header>
        <?php require("layout/nav.php"); ?>
    </header>
    <main>

    <?php require_once('layout/nav_intranet.php') ?>
        
    <section class="d-md-flex justify-content-center d-none">
        <article style="width: 80%">
            
            <h1>Lista de usuarios</h1>
            
            <a href="agregarUsuario.php" class="btn btn-primary "> Agregar usuario </a>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto de perfil</th>
                        <th>Nombre del usuario</th>
                        <th>Nombre y apellido</th>
                        <th>Contraseña</th>
                        <th>Telefono</th>
                        <th>Mail</th>
                        <th>Rol</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $p): ?>
                        <tr>
                            <td><?php echo ($p['id']); ?></td>
                            <td><img src="./img/usuarios/<?php echo ($p['imagen']); ?>"  alt="imagen del usuario" width="100px"/></td>
                            <td><?php echo ($p['nombre_usuario']); ?></td>
                            <td><?php echo ($p['nombre_completo']); ?></td>
                            <td><?php echo ($p['contrasena']); ?></td>
                            <td><?php echo ($p['telefono']); ?></td>
                            <td><?php echo ($p['mail']); ?></td>
                            <td><?php echo ($p['rol']); ?></td>
                            
                            <td>
                                <a class="btn btn-warning btn-sm" href='modificar_usuario.php?id=<?php echo $p['id']; ?>'>Modificar</a>
                                <!-- Enlace para eliminar con confirmación -->
                                <a class="btn btn-danger btn-sm" href="lista_usuarios.php?id=<?php echo $p['id']; ?>" 
                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <nav aria-label="Page navigation example" class="paginado">
                        <ul class="pagination">
                            <?php if($enlaces['anterior']): ?>
                                <li class="page-item"><a class="page-link" href="lista_usuarios.php?pag=<?php echo $enlaces['anterior']; ?>"> <<< </a></li>
                            <?php endif ?>
                            <li class="page-item"><a class="page-link" href="#"> Página actual: <?php echo $enlaces['actual']; ?> </a></li>
                            <?php if($enlaces['siguiente']): ?>
                                <li class="page-item"><a class="page-link" href="lista_usuarios.php?pag=<?php echo $enlaces['siguiente']; ?>"> >>> </a></li>
                            <?php endif ?>
                        </ul>
                    </nav>
            </table>
        </article>
    </section>
    <section class="respMovil">
        <h1 class="d-flex justify-content-center">Lista de Productos</h1>
        <?php foreach ($usuarios as $p):?>
          <article class="d-flex justify-content-center">
            <div class="card">
                <img src="./img/usuarios/<?php echo $p['imagen']?>"  alt="Foto de Perfil">
                <div class="card-body">
                    <h2 class="card-title d-flex justify-content-center"><?php echo $p['nombre_usuario']?></h5>
                    <p class="card-text ">Nombre completo: <?php echo $p['nombre_completo']?></p>
                    <p class="card-text">Telefon: <?php echo $p['telefono']?></p>
                    <p class="card-text">Mail: <?php echo $p['mail']?></p>
                    <p class="card-text">Rol: <?php echo $p['rol']?></p>
                    <div class="d-flex justify-content-center">
                    <a class="btn btn-warning btn-sm mx-1" href='modificar_usuario.php?id=<?php echo $p['id']; ?>'>Modificar</a>
                     <!-- Enlace para eliminar con confirmación -->
                    <a class="btn btn-danger btn-sm mx-1" href="lista_usuarios.php?id=<?php echo $p['id']; ?>" 
                    onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                    </div>
                </div>
            </div>
        </article>   

        <?php endforeach?>
    </section>
    </main>
    <footer>
        <?php require_once('layout/footer.php'); ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>