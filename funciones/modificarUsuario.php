<?php 

if (!empty($_POST["MODIFICACION"])) {
    if (!empty($_POST["nombre_usuario"]) && !empty($_POST["nombre_completo"]) && !empty($_POST["contrasena"]) && !empty($_POST["telefono"]) && !empty($_POST["mail"]) && !empty($_POST["rol"] && !empty($_FILES["imagen"]) )) {
        
        $id = $_POST["id"];
        $nombre_usuario = $_POST["nombre_usuario"];
        $nombre_completo = $_POST["nombre_completo"];
        $contrasena = $_POST["contrasena"];
        $telefono = $_POST["telefono"];
        $mail = $_POST["mail"];
        $rol = $_POST["rol"];

        $imagen = $_FILES['imagen'];
        $time = time();
        $path = $imagen['name']; 
        $ruta = "{$time}{$path}";

        $sql = $conexion->query("UPDATE usuario SET nombre_usuario='$nombre_usuario', nombre_completo='$nombre_completo', contrasena='$contrasena', telefono=$telefono, mail='$mail', rol='$rol', imagen ='$ruta' WHERE id=$id");

        if ($sql) {

            echo "Se modificó correctamente.";
            header("location: ./lista_usuarios.php");
        } else {
            echo "Hubo un error al modificar los datos.";
        }
    } else {
        echo "Campos vacíos.";
    }
}
?>