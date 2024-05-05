<?php
include 'conexion_be.php';

session_start();

//ESTE CODIGO SE PUEDE UTILIZAR AL AGREGAR LAS SALAS PRIVADAS
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['sala'])) {
    $codigo_sala = $_POST['sala'];
    $nombre_usuario = $_SESSION['usuario'];

    // Verificar si el usuario ya está en la sala
    $consulta_existencia_estadisticas = "SELECT * FROM estadisticas WHERE usuario_nombre = '$nombre_usuario' AND codigo_sala = '$codigo_sala'";
    $resultado_existencia_estadisticas = $conexion->query($consulta_existencia_estadisticas);

    if ($resultado_existencia_estadisticas->num_rows > 0) {
        // Si el usuario ya está en la sala, redirigir a la página de temas
        $update_usuarioYsala = "UPDATE usuarioysala SET codigo_sala = '$codigo_sala' WHERE usuario = '$nombre_usuario'";
        $res = $conexion->query($update_usuarioYsala);
        header("location: ../categoria.php?codigo_sala=$codigo_sala");
        exit();
    } else {
        // Si el usuario no está en la sala, insertarlo en la tabla de Estadisticas
        $consulta_sala_existente = "SELECT * FROM salas WHERE codigo_sala = '$codigo_sala'";
        $resultado_sala_existente = $conexion->query($consulta_sala_existente);

        if ($resultado_sala_existente->num_rows > 0) {
            // Si la sala existe, insertar al usuario en la tabla de Estadisticas
            $insertar_usuario_estadisticas = "INSERT INTO estadisticas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
            $conexion->query($insertar_usuario_estadisticas);

            $insert_usuarioYsala = "INSERT INTO usuarioysala (usuario, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
            $rest = $conexion->query($insert_usuarioYsala);

            header("location: ../categoria.php?sala_id=$codigo_sala");
            exit();
        } else {
            // Si la sala no existe, mostrar un mensaje de error
            header("location: ../selecionar_sala.php?error=sala_no_encontrada");
            exit();
        }
    }
} else {

    $codigo_sala = 'A0123';
    $nombre_usuario = $_SESSION['usuario'];

    // Verificar si el usuario ya está en la sala
    $consulta_existencia_estadisticas = "SELECT * FROM estadisticas WHERE usuario_nombre = '$nombre_usuario' AND codigo_sala = '$codigo_sala'";
    $resultado_existencia_estadisticas = $conexion->query($consulta_existencia_estadisticas);

    if ($resultado_existencia_estadisticas->num_rows > 0) {
        // Si el usuario ya está en la sala, redirigir a la página de temas
        $update_usuarioYsala = "UPDATE usuarioysala SET codigo_sala = '$codigo_sala' WHERE usuario = '$nombre_usuario'";
        $res = $conexion->query($update_usuarioYsala);
        header("location: ../categoria.php?codigo_sala=$codigo_sala");
        exit();
    } else {
        // Si el usuario no está en la sala, insertarlo en la tabla de Estadisticas
        $consulta_sala_existente = "SELECT * FROM salas WHERE codigo_sala = '$codigo_sala'";
        $resultado_sala_existente = $conexion->query($consulta_sala_existente);

        if ($resultado_sala_existente->num_rows > 0) {
            // Si la sala existe, insertar al usuario en la tabla de Estadisticas
            $insertar_usuario_estadisticas = "INSERT INTO estadisticas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
            $insertar_usuario_estadisticas2 = "INSERT INTO estadisticasbasicas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
            $conexion->query($insertar_usuario_estadisticas);
            $conexion->query($insertar_usuario_estadisticas2);

            $insert_usuarioYsala = "INSERT INTO usuarioysala (usuario, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
            $rest = $conexion->query($insert_usuarioYsala);

            header("location: ../categoria.php?sala_id=$codigo_sala");
            exit();
        } else {
            // Si la sala no existe, mostrar un mensaje de error
            header("location: ../selecionar_sala.php?error=sala_no_encontrado");
            exit();
        }
    }
}
// }
