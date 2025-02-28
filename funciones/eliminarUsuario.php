<?php
if(!empty($_GET["id"])){
    $id = $_GET["id"];

    $sql = $conexion->query("DELETE FROM usuario WHERE id = $id");

    if ($sql) {
        header("Location: lista_usuarios.php");
        exit(); 
    } else {
        echo '<div>Error al eliminar el usuario.</div>';
    }
}
?>