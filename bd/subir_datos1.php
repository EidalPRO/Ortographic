<?php
session_start();

include 'conexion_be.php';

$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

$tiempoTranscurridoNuevo = $datos['tiempoTotal'] ?? null;
$porcentajeEfectividad = $datos['porcentajeEfectividad'] ?? null;
$tema = $datos['tema'] ?? null;
$dificultad = $datos['dificultad'] ?? null;
$tema2;

switch ($tema) {
    case 'tema_1_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema1_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema1_medio' : 'tema1_dificil';
        }
        break;
    case 'tema_2_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema2_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema2_medio' : 'tema2_dificil';
        }
        break;
    case 'tema_3_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema3_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema3_medio' : 'tema3_dificil';
        }
        break;
    case 'tema_4_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema4_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema4_medio' : 'tema4_dificil';
        }
        break;
}

if ($tema2 && $tiempoTranscurridoNuevo !== null && $porcentajeEfectividad !== null) {
    $nombreUsuario = $_SESSION['usuario'] ?? null;

    if ($nombreUsuario !== null) {
        // Obtener el código de sala del usuario
        $consultaCodigoSala = "SELECT codigo_sala FROM usuarioysala WHERE usuario = '$nombreUsuario'";
        $resultadoConsultaCodigo = $conexion->query($consultaCodigoSala);

        if ($resultadoConsultaCodigo && $resultadoConsultaCodigo->num_rows > 0) {
            $fila = $resultadoConsultaCodigo->fetch_assoc();
            $codigoSala = $fila['codigo_sala'];

            // Actualizar los datos en la tabla estadisticasbasicas
            $consultaActualizar = "UPDATE estadisticasbasicas SET $tema2 = $porcentajeEfectividad WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
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
            $response['message'] = "No se encontró el código de sala para este usuario.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Falta el nombre de usuario en la sesión.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Datos insuficientes para realizar la actualización.";
}

header('Content-Type: application/json');
echo json_encode($response);
