<?php

// Obtenemos los datos del usuario y la contraseña de la URL
$id_usuario = $_GET['id_usuario'];
$contraseña = $_GET['contraseña'];

function iniciarSesion($id_usuario, $contraseña) {
    $salida = ""; // Inicializa la variable
    $conexion = mysqli_connect("localhost", "root", "root", "bd_proyecto"); // Establece la conexión a la base de datos
    if (!$conexion) {
        return "Error en la conexión a la base de datos: " . mysqli_connect_error();
    }
    
    // Evita la inyección SQL utilizando consultas preparadas
    $sql = "SELECT * FROM tb_usuarios WHERE id_usuarios = ? AND contraseña = ?";
    $sql = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($sql, "ss", $id_usuario, $contraseña);
    mysqli_stmt_execute($sqls);
    $resultado = mysqli_stmt_get_result($stmt);
    
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $salida .= $fila['id_usuarios'] . " ";
        $salida .= $fila['nombre_usuario'] . " ";
        $salida .= $fila['contraseña'] . " ";
    }
    
    if (empty($salida)) {
        return "El usuario o la contraseña no son válidos";
    }
    
    session_start();
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['contraseña'] = $contraseña;
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    return "Inicio de sesión exitoso";
}

// Llama a la función de inicio de sesión
$mensaje = iniciarSesion($id_usuario, $contraseña);
echo $mensaje;
?>
