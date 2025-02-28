<?php

if (!empty($_POST["clientemodi"])) {
    if (!empty($_POST["nombre_usuario"]) and !empty($_POST["nombre_completo"]) and !empty($_POST["contrasena"]) and !empty($_POST["telefono"]) and !empty($_POST["mail"])) {
   
        $id = $_POST["id"];
        $nombre_usuario = $_POST["nombre_usuario"];
        $nombre_completo = $_POST["nombre_completo"];
        $contrasena = $_POST["contrasena"];
        $telefono = $_POST["telefono"];
        $mail = $_POST["mail"];

        $imagen = $_FILES['imagen'];
        $time = time();
        $path = $imagen['name']; 
        $ruta = "{$time}{$path}";

        $sql = $conexion->query("UPDATE usuario SET nombre_usuario='$nombre_usuario', nombre_completo='$nombre_completo', contrasena='$contrasena', telefono='$telefono', mail='$mail', imagen='$ruta' WHERE id=$id");

        if ($sql) {

            echo "Se modificó correctamente.";
            header("location:./cuentaUsuario.php"); 
        } else {
            echo "Hubo un error al modificar los datos.";
        }
    } else {
        echo "Campos vacíos.";
    }
}
?>