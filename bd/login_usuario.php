<?php

session_start();

include 'conexion_be.php';

if (isset($_POST['accion']) && $_POST['accion'] === 'btn-login') {
    inicio_sesion($conexion);
} else if (isset($_POST['accion']) && $_POST['accion'] === 'btn-registro') {
    registro($conexion);
}


function inicio_sesion($conexion)
{
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //buscar contraseña encriptada mismo procedimiento
    $contrasena = hash('sha512', $contrasena);

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre='$usuario' 
                       and contrasena='$contrasena' ");


    if (mysqli_num_rows($validar_login) > 0) {
        $_SESSION['usuario'] = $usuario; //variable de sesion
        header("location: ../index.php");
        exit();
    } else {
        // Usuario o contraseña incorrectos, enviar mensaje al JavaScript
        header("location: ../inicio_sesion.php?error=usuario_no_encontrado");
        exit();
    }
}

function registro($conexion)
{
    // $ejecutar='';
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $correo = $_POST['correo'];

    // Encriptamiento de contraseña
    $contrasena = hash('sha512', $contrasena);

    // Guardamos datos en la tabla de usuarios
    $query = "INSERT INTO usuarios(nombre, correo, contrasena, foto, descripcion) VALUES('$usuario', '$correo', '$contrasena', 'perfiles/default.webp', '¿Qué miras?')";

    // Verificar que el usuario no se repita en la base de datos
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre='$usuario' ");

    if (mysqli_num_rows($verificar_usuario) > 0) {
        header("location: ../inicio_sesion.php?responce=usuario-existente");
        exit();
    }

    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        // Insertar un registro en la tabla de logros para el nuevo usuario
        $query_logros = "INSERT INTO logros (usuario, logroInicio) VALUES ('$usuario', 'completado')";
        $ejecutar_logros = mysqli_query($conexion, $query_logros);

        if ($ejecutar_logros) {
            header("location: ../inicio_sesion.php?responce=registro-exitoso");
        } else {
            header("location: ../inicio_sesion.php?responce=error-logros");
        }
    } else {
        header("location: ../inicio_sesion.php?responce=error");
    }

    mysqli_close($conexion);
}
