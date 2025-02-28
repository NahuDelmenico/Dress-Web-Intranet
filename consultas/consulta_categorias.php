<?php

function getCategorias(PDO $conexion){

    $consulta = $conexion->query('SELECT DISTINCT categoria FROM rusanco');
    $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    return $categorias;
}
function getRoles(PDO $conexion){

    $consulta = $conexion->query('SELECT DISTINCT rol FROM usuario');
    $roles = $consulta->fetchAll(PDO::FETCH_ASSOC);

    return $roles;
}
?>