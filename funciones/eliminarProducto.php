<?php

if(!empty($_GET["id"])){
    $id=$_GET["id"];

    $sql=$conexion->query("DELETE FROM rusanco WHERE id=$id");
    if($sql){
        header("Location: lista_productos.php");
        exit(); 
    }else{
        echo '<div>no eliminado</div>';
    }
}
?>



