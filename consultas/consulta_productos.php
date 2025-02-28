<?php

function getProductos(PDO $conexion){

    $consulta  =   $conexion->query('SELECT * FROM rusanco');
    $productos   =    $consulta->fetchAll(PDO::FETCH_ASSOC);

    return $productos;
}


function getProductoByNombre(PDO $conexion, $nombre)
{

    $consulta = $conexion->prepare('
        SELECT id, nombre, categoria
        FROM rusanco
        WHERE nombre = :nombre
    ');

    $consulta->bindValue(':nombre', $nombre);

    $consulta->execute();

    $producto = $consulta->fetch(PDO::FETCH_ASSOC);

    return $producto;

}

function addProducto(PDO $conexion, array $data)
{
    // Corregimos la consulta SQL. Usamos parámetros en lugar de concatenar valores.
    $consulta = $conexion->prepare('
        INSERT INTO rusanco (nombre, categoria, talle, precio, stock, imagen) 
        VALUES (:nombre, :categoria, :talle, :precio, :stock, :imagen)
    ');

    // Vinculamos los valores de las variables a los parámetros de la consulta.
    $consulta->bindValue(':nombre', $data['nombre']);
    $consulta->bindValue(':categoria', $data['categoria']);
    $consulta->bindValue(':talle', $data['talle']);
    $consulta->bindValue(':precio', $data['precio']);
    $consulta->bindValue(':stock', $data['stock']);
    $consulta->bindValue(':imagen', $data['imagen']);

    // Ejecutamos la consulta
    $consulta->execute();
}




?>