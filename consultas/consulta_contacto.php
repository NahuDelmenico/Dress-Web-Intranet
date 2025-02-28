<?php

function getContactos(PDO $conexion){

    $consulta  =   $conexion->query('SELECT * FROM contacto');
    $contactos   =    $consulta->fetchAll(PDO::FETCH_ASSOC);

    return $contactos ;
}


?>