<?php

    include 'conexion_be.php';


    $ejecutar;
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //Encriptamiento de contraseña
    $contrasena = hash('sha512', $contrasena);

    
    //guardamos datos en la tabla 
    $query = "INSERT INTO usuarios(nombre, contrasena) VALUES('$usuario', '$contrasena')";
    
    //Verificar que el usuario no se repita en la base de datos
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre='$usuario' ");
    
    if(mysqli_num_rows($verificar_usuario) > 0) {
        //un mensaje de error
        exit(); // Sale del script PHP
    }

    $ejecutar = mysqli_query($conexion, $query);


    if($ejecutar) {
        //si se registro con exito
    } else {
        //en caso de error
    }

    mysqli_close($conexion);

?>