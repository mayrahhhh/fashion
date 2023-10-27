<?php
//incluye el archivo de las funciones
include("funciones.php");

// Obtenemos los datos del usuario y la contraseña de la URL
$a = $_GET['id_usuario'];
$b = $_GET['contraseña'];

echo iniciarSesion($a, $b);
?>
<a href="funciones.php?id_usuario=<?php echo=$a; ?>">vaya</a>
