<?php

session_start();

include 'conexion_be.php';

$nombreUsuario = $_SESSION['usuario'] ?? null;


$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

$tema = $datos['tema'] ?? null;
$codigoSala = 'A0123';

$logroConseguido = null;
$logro = null;
$logroTema = null;
$logroFinal = null;

// Verificar si se recibió el parámetro logro
if ($tema !== null) {

    switch ($tema) {
        case 'tema_1_porcentaje':
            $logro = "logro1";
            $logroConseguido = "Maestro de la Acentuación";
            $logroTema = "Acentuación";
            break;
        case 'tema_2_porcentaje':
            $logro = "logro2";
            $logroTema = "Uso de letras";
            $logroConseguido = "Rey de las Letras";
            break;
        case 'tema_3_porcentaje':
            $logro = "logro3";
            $logroTema = "Concordancia";
            $logroConseguido = "Señor de la Concordancia";
            break;
        case 'tema_4_porcentaje':
            $logro = "logro4";
            $logroTema = "Gramatica general";
            $logroConseguido = "Experto en Gramática";
            break;
    }


    // Verificar si el usuario ya tiene el logro completado en la tabla de logros
    $consultaLogro = "SELECT $logro FROM logros WHERE usuario = '$nombreUsuario'";
    $resultadoLogro = $conexion->query($consultaLogro);

    if ($resultadoLogro && $resultadoLogro->num_rows > 0) {
        $filaLogro = $resultadoLogro->fetch_assoc();
        $estadoLogro = $filaLogro[$logro];

        // Si el logro no está completado, actualizarlo a 'completado'
        if ($estadoLogro !== 'completado') {

            $consultaBasica = "SELECT * FROM estadisticasbasicas WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
            $resultadoBasico = $conexion->query($consultaBasica);

            if ($resultadoBasico->num_rows > 0) {
                $datosBasicos = $resultadoBasico->fetch_assoc();

                // Calcular la suma de estadísticas según el tema
                switch ($tema) {
                    case 'tema_1_porcentaje':
                        $sumaEstadisticas = ($datosBasicos['tema1_facil'] + $datosBasicos['tema1_medio'] + $datosBasicos['tema1_dificil']) / 3;
                        break;
                    case 'tema_2_porcentaje':
                        $sumaEstadisticas = ($datosBasicos['tema2_facil'] + $datosBasicos['tema2_medio'] + $datosBasicos['tema2_dificil']) / 3;
                        break;
                    case 'tema_3_porcentaje':
                        $sumaEstadisticas = ($datosBasicos['tema3_facil'] + $datosBasicos['tema3_medio'] + $datosBasicos['tema3_dificil']) / 3;
                        break;
                    case 'tema_4_porcentaje':
                        $sumaEstadisticas = ($datosBasicos['tema4_facil'] + $datosBasicos['tema4_medio'] + $datosBasicos['tema4_dificil']) / 3;
                        break;
                }

                // Verificar si la suma de estadísticas es igual a 100
                if ($sumaEstadisticas == 100) {
                    // Actualizar el logro a 'completado'
                    $consultaActualizarLogro = "UPDATE logros SET $logro = 'completado' WHERE usuario = '$nombreUsuario'";
                    $conexion->query($consultaActualizarLogro);

                    // Verificar si la actualización fue exitosa
                    if ($conexion->affected_rows > 0) {
                        $response['success'] = true;
                        $response['logro'] = $logro;
                        $response['logroTema'] = $logroTema;
                    } else {
                        $response['success'] = false;
                        $response['message'] = "No se pudo actualizar el logro '$logroConseguido' para el usuario '$nombreUsuario'.";
                    }
                } else {
                    $response['success'] = false;
                    $response['message'] = "La suma de estadísticas para el tema '$logroTema' no es igual a 100.";
                }
            } else {
                $response['success'] = false;
                $response['message'] = "No se encontraron estadísticas básicas para el usuario '$nombreUsuario' con codigo de sala '$codigoSala'.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "El logro '$logroConseguido' ya está completado para el usuario '$nombreUsuario'.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "No se encontró el logro '$logroConseguido' para el usuario '$nombreUsuario'.";
    }
} else {
    // Enviar una respuesta de error si el parámetro logro no está presente
    http_response_code(400); // Código de error 400 Bad Request
    $response['success'] = false;
    $response['message'] = "Error: No se recibió el parámetro logro.";
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión a la base de datos si es necesario
$conexion->close();
