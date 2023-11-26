<?php
include 'conexion_be.php';

session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sala'])) {
        $codigo_sala = $_POST['sala'];

    
        $nombre_usuario = $_SESSION['usuario'];

        // Verificar si el usuario ya está en la sala
        $consulta_existencia = "SELECT * FROM Estadisticas WHERE usuario_nombre = '$nombre_usuario' AND codigo_sala = '$codigo_sala'";
        $resultado_existencia = $conexion->query($consulta_existencia);

        if ($resultado_existencia->num_rows > 0) {
            // Si el usuario ya está en la sala, redirigir a la página de temas
            header("location: ../categoria.php?codigo_sala=$codigo_sala");
            exit();
        } else {
            // Si el usuario no está en la sala, insertarlo en la tabla de Estadisticas
            $consulta = "SELECT * FROM Salas WHERE codigo_sala = '$codigo_sala'";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {
                // Si la sala existe, insertar al usuario en la tabla de Estadisticas
                $insertar_usuario = "INSERT INTO Estadisticas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $conexion->query($insertar_usuario);

                header("location: ../categoria.php?sala_id=$codigo_sala");
                exit();
            } else {
                // Si la sala no existe, mostrar un mensaje de error
                header("location: ../selecionar_sala.php?error=sala_no_encontrado");
                exit();
            }
        }
    }
}
?>
