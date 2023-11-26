<?php
    include 'conexion_be.php';

    $ejecutar;
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Encriptamiento de contraseña
    $contrasena = hash('sha512', $contrasena);

    // Guardamos datos en la tabla 
    $query = "INSERT INTO usuarios(nombre, contrasena) VALUES('$usuario', '$contrasena')";

    // Verificar que el usuario no se repita en la base de datos
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre='$usuario' ");

    
    if(mysqli_num_rows($verificar_usuario) > 0) {
        echo "existe"; // Usuario ya existe en la base de datos
        exit(); 
    }

    $ejecutar = mysqli_query($conexion, $query);

    if($ejecutar) {
        echo "exito"; // Registro exitoso
    } else {
        echo "error"; // Error al registrar usuario
    }

    mysqli_close($conexion);
?>
