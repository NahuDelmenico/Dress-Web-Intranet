<?php 

try{
    $conexion = new PDO('mysql:host=localhost;dbname=rusanco;charset=utf8', 'root', '');

}catch(PDOException $a){

    header('Location: paginaerror.php');
    exit;
}

?>