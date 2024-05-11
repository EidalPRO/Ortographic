<?php
session_start();
include 'conexion_be.php';

$nombreUsuario = $_SESSION['usuario'] ?? null;

if ($nombreUsuario !== null) {
    // Consulta para obtener el código de sala del usuario
    $consultaCodigoSala = "SELECT codigo_sala FROM usuarioysala WHERE usuario = '$nombreUsuario'";
    $resultadoConsulta = $conexion->query($consultaCodigoSala);

    if ($resultadoConsulta->num_rows > 0) {
        $fila = $resultadoConsulta->fetch_assoc();
        $codigoSala = $fila['codigo_sala'];
        echo $codigoSala;
    } else {
        echo "No se encontró el código de sala para este usuario.";
    }
} else {
    echo "Falta el nombre de usuario en la sesión.";
}
$conexion->close(); // Cerrar conexión a la base de datos
