<?php 
session_start();

$_SESSION['usuario'] = null;

header('Location: login.php');
?>