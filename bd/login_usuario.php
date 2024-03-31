<?php

    session_start();

    include 'conexion_be.php';

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

   //buscar contraseña encriptada mismo procedimiento
   $contrasena = hash('sha512', $contrasena);

   $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre='$usuario' 
                   and contrasena='$contrasena' ");

    
    if(mysqli_num_rows($validar_login) > 0) {
        $_SESSION['usuario'] = $usuario; //variable de sesion
        header("location: ../index.php");
        exit();
    } else {
        // Usuario o contraseña incorrectos, enviar mensaje al JavaScript
        header("location: ../inicio_sesion.php?error=usuario_no_encontrado");
        exit();
    }

?>