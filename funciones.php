<?php

$a = $_GET['id_usuarios'];
$b = $_GET['contraseña'];


function iniciarSesion($id_usuarios,$contraseña) {
    $salida = ""; // Inicialización de la variable
    $conexion = mysqli_connect("localhost", "root", "root", "proyecto"); // Conexión a la base de datos

    if ($conexion === false) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    if (isset($_POST["id_usuarios"]) && isset($_POST["contraseña"])) {
        $id_usuarios = $_POST["id_usuarios"];
        $contraseña = $_POST["contraseña"];
        
    } else {

   
    $sql = "SELECT * FROM tb_usuarios WHERE id_usuarios = '$id_usuarios'";//buscamos el usuario en la base de datos
    $resultado = mysqli_query($conexion, $sql);//ejeciuta una consulta

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $contraseña = $fila["contraseña"];

        if (password_verify($id_usuarios, $contraseña)) {
            // Iniciamos la sesión
            session_start();
            $_SESSION["id_usuarios"] = $id_usuarios;
            $_SESSION["contraseña"] =$contraseña;

            //el usuario si existe en la base de datos
        } else {
            $salida = "inicio de sesión exitoso";
        }
    } else {
        // El usuario no existe en la base de datos 
        $salida = "El usuario no se encuentra";
    }

    $conexion->close(); // Cierre de la conexión
    return $salida;
}

}

  