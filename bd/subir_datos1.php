<?php
session_start();

include 'conexion_be.php';

$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

$tiempoTranscurridoNuevo = $datos['tiempoTotal'] ?? null;
$porcentajeEfectividad = $datos['porcentajeEfectividad'] ?? null;
$tema = $datos['tema'] ?? null;

$nombreUsuario = $_SESSION['usuario'] ?? null;

if ($nombreUsuario !== null) {
    // Consulta para obtener el código de sala del usuario
    $consultaCodigoSala = "SELECT codigo_sala FROM usuarioysala WHERE usuario = '$nombreUsuario'";
    $resultadoConsultaCodigo = $conexion->query($consultaCodigoSala);

    if ($resultadoConsultaCodigo->num_rows > 0) {
        $fila = $resultadoConsultaCodigo->fetch_assoc();
        $codigoSala = $fila['codigo_sala'];

        $consultaTiempoExistente = "SELECT tiempo_total_practica FROM estadisticas WHERE usuario_nombre = '$nombreUsuario' AND codigo_sala = '$codigoSala'";
        $resultadoTiempoExistente = $conexion->query($consultaTiempoExistente);

        if ($resultadoTiempoExistente->num_rows > 0) {
            $filaTiempo = $resultadoTiempoExistente->fetch_assoc();
            $tiempoTotalExistente = $filaTiempo['tiempo_total_practica'];

            // Sumar el tiempo existente con el nuevo tiempo
            $tiempoTotalActualizado = $tiempoTotalExistente + $tiempoTranscurridoNuevo;

            // Consulta para actualizar los datos en la tabla Estadisticas
            $consultaActualizar = "UPDATE estadisticas SET tiempo_total_practica = $tiempoTotalActualizado, $tema = $porcentajeEfectividad WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
            $resultadoActualizar = $conexion->query($consultaActualizar);

            if ($resultadoActualizar) {
                $response['success'] = true;
                $response['message'] = "Datos actualizados correctamente en la tabla Estadisticas.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error al actualizar datos: " . $conexion->error;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "No se encontró el tiempo total de práctica para este usuario.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No se encontró el código de sala para este usuario.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Falta el nombre de usuario en la sesión.";
}

header('Content-Type: application/json');
echo json_encode($response);
