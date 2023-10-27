<?php
//datos para la url
$a = $_GET['id_usuarios'];
$b = $_GET['contraseña'];
//incluye el archivo de las funciones
include("funciones.php");



//nombtre de la funcion
echo iniciarSesion($a, $b);
?>

