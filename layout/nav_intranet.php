    <section class="nav justify-content-center">
            <article>
                <nav class="bg-primary rounded-pill my-3" >
                    <ul class="nav justify-content-center">
                        <li class="nav-item"><a class="nav-link text-white" href="intranet.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="lista_productos.php">Lista de productos</a></li>
                        <?php if($usuarioLogeado['rol']=="Administrador"):?>
                        <li class="nav-item"><a class="nav-link text-white" href="lista_usuarios.php">Lista de usuairos</a></li>
                        <?php endif?>
                        <li class="nav-item"><a class="nav-link text-white" href="cerrarSesion.php">Cerrar Sesion</a></li>
                    </ul>
                </nav>
            </article>
        </section>