<?php

function getUsuarios(PDO $conexion){

    $consulta  =   $conexion->query('SELECT * FROM `usuario`');
    $usuarios   =    $consulta->fetchAll(PDO::FETCH_ASSOC);

    return $usuarios;
}

function getUsuarioLogeado(PDO $conexion, $usuario, $contrasena) {
    
    $consulta = $conexion->prepare('SELECT * FROM `usuario` WHERE nombre_usuario = :usuario AND contrasena = :contrasena');
 
    $consulta->bindValue(':usuario', $usuario);
    $consulta->bindValue(':contrasena', $contrasena);

    $consulta->execute();

    
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

    
    if ($usuario) {
        return $usuario;
    } else {
        return null; 
    }
}



function getUsuarioByNombreUsuario(PDO $conexion, $nombre_usuario)
{
    $consulta = $conexion->prepare('
        SELECT id, nombre_usuario 
        FROM usuario
        WHERE nombre_usuario = :nombre_usuario
    ');

    $consulta->bindValue(':nombre_usuario', $nombre_usuario);

    $consulta->execute();

    $usuario_nombre = $consulta->fetch(PDO::FETCH_ASSOC);

    return $usuario_nombre;
}

// Función getUsuarioByNombreCompleto
function getUsuarioByNombreCompleto(PDO $conexion, $nombre_completo)
{
    $consulta = $conexion->prepare('
        SELECT id, nombre_completo 
        FROM usuario
        WHERE nombre_completo = :nombre_completo
    ');

    $consulta->bindValue(':nombre_completo', $nombre_completo);

    $consulta->execute();

    $completo_nombre = $consulta->fetch(PDO::FETCH_ASSOC);

    return $completo_nombre;
}

// Función getUsuarioByMail
function getUsuarioByMail(PDO $conexion, $mail)
{
    $consulta = $conexion->prepare('
        SELECT id, mail 
        FROM usuario
        WHERE mail = :mail
    ');

    $consulta->bindValue(':mail', $mail);

    $consulta->execute();

    $email = $consulta->fetch(PDO::FETCH_ASSOC);

    return $email;
}

function addUsuario(PDO $conexion, array $data)
{
    $consulta = $conexion->prepare('
        INSERT INTO usuario (nombre_usuario, nombre_completo, contrasena, telefono, mail, rol, imagen) 
        VALUES (:nombre_usuario, :nombre_completo, :contrasena, :telefono, :mail, "Cliente", :imagen)
    ');

    
    $consulta->bindValue(':nombre_usuario', $data['nombre_usuario']);
    $consulta->bindValue(':nombre_completo', $data['nombre_completo']);
    $consulta->bindValue(':contrasena', $data['contrasena']);
    $consulta->bindValue(':telefono', $data['telefono']);
    $consulta->bindValue(':mail', $data['mail']);
    $consulta->bindValue(':imagen', $data['imagen']);

    $consulta->execute();
}
?>