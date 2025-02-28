<?php 

if(!empty($_POST["MODIFICACION"])){
    if(!empty($_POST["nombre"])  and !empty($_POST["talle"]) and !empty($_POST["precio"]) and !empty($_POST["stock"])){
        $id=$_POST["id"];
        $nombre=$_POST["nombre"];
        $talle=$_POST["talle"];
        $precio=$_POST["precio"];
        $stock=$_POST["stock"];

        $sql=$conexion->query(" update rusanco set nombre='$nombre', talle='$talle', precio=$precio, stock=$stock where id=$id ");
        if($sql){
           
            echo "Se modifico correctamente";
            header("location:./lista_productos.php");
        }else{
            echo "No se modifico correctamente";
        }      
    }else{
        echo "campos vacios";
    }
}

?>