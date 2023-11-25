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
        echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Usuario y/o contraseña incorrecta.",
                });
            </script>
        ';
        exit();
    }

?>