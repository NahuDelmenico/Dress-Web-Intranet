<?php 


$usuarioLogeado = $_SESSION['usuario'] ?? null;



?>


<section id="navegador">
    <div>
        <article class="logo">
            <a href="index.php">
                <figure>
                    <img src="img/logo_rusanco.png" alt="Logo rusanco">
                </figure>
            </a>
        </article>
    </div>
    <div>
        <article class="boton">
            
            <div class="menu">
            <button><a href="#navbar_mobile">MENU</a></button>
                <nav id="navbar_mobile">
                    <ul>
                        <li><a href="./index.php">HOME</a></li>
                        <li><a href="./productos.php">PRODUCTOS</a></li>
                        <li><a href="./sobreNosotros.php">SOBRE NOSOTROS</a></li>
                        <li><a href="./contacto.php">CONTACTO</a></li>
                        <li><a href="./trabajaConNosotros.php">TRABAJA CON NOSOTROS</a></li>
                        
                        <?php if($usuarioLogeado):?>
                            <?php if($usuarioLogeado['rol'] == 'Empleado' ||$usuarioLogeado['rol'] == 'Administrador'):?>
                                <li class="logoSesion"><a href="intranet.php"><img src=".\img\inicioSesion.png" alt="Inicio Sesion"><?php echo $usuarioLogeado['nombre_usuario']?></a></li>
                            <?php else: ?>
                                <li class="logoSesion"><a href="cuentaUsuario.php"><img src=".\img\inicioSesion.png" alt="Inicio Sesion"><?php echo $usuarioLogeado['nombre_usuario']?></a></li>
                            <?php endif ?>
                        <?php else: ?>
                        <li class="logoSesion"><a href="login.php"><img src=".\img\inicioSesion.png" alt="Inicio Sesion"></a></li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </article>
    </div>
</section>