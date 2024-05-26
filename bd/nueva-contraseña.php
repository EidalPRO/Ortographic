<?php

include 'conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoIngresado = $_POST['codigo'];
    $contrasena = $_POST['contrasena'];
    $id = 'Eidal';

    // Consultar la base de datos para obtener el código generado previamente
    $respuestaConsulta = $conexion->prepare("SELECT codigo FROM usuarios WHERE nombre = ?");
    $respuestaConsulta->bind_param("s", $id);
    $respuestaConsulta->execute();
    $resultado = $respuestaConsulta->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $codigoGenerado = $fila['codigo'];

        // Verificar si el código ingresado coincide con el código generado previamente
        if ($codigoIngresado === $codigoGenerado) {
            // Hash de la contraseña
            $contrasenaHash = hash('sha512', $contrasena);

            // Actualizar la contraseña en la base de datos
            $subirContrasena = $conexion->prepare("UPDATE usuarios SET contrasena = ?, codigo = 'vencido' WHERE nombre = ?");
            $subirContrasena->bind_param("ss", $contrasenaHash, $id);
            $subirContrasena->execute();

            // Redirigir a la página de éxito
            header("Location: ../recuperacion-contraseña.php?respuesta=exito&id=$id");
            exit();
        } else {
            // Redirigir a la página con error de código inválido
            header("Location: ../recuperacion-contraseña.php?respuesta=codigo-invalido&id=$id");
            exit();
        }
    } else {
        // Redirigir a la página con error de consulta
        header("Location: ../recuperacion-contraseña.php?respuesta=error-consulta&id=$id");
        exit();
    }
}
