<?php

if(!empty($_GET["id"])){
    $id=$_GET["id"];

    $sql=$conexion->query("delete from contacto where id=$id");
    if($sql==1){
        echo '<div>Producto eliminado correctamente</div>';
    }else{
        echo '<div>no eliminado</div>';
    }
}
?>