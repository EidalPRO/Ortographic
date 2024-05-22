<?php
session_start();

include 'conexion_be.php';

$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

$tiempoTranscurridoNuevo = $datos['tiempoTotal'] ?? null;
$porcentajeEfectividad = $datos['porcentajeEfectividad'] ?? null;
$tema = $datos['tema'] ?? null;
$dificultad = $datos['dificultad'] ?? null;
$df1 = $datos['df1'] ?? null;
$df2 = $datos['df2'] ?? null;
$df3 = $datos['df3'] ?? null;
$tema2 = null;
$logroObtenido = null;
$logro = null;
$logroTema = null;

switch ($tema) {
    case 'tema_1_porcentaje':
        $logro = "logro1";
        $logroConseguido = "Maestro de la Acentuación";
        $logroTema = "Acentuación";
        if ($dificultad == 'facil') {
            $tema2 = 'tema1_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema1_medio' : 'tema1_dificil';
        }
        break;
    case 'tema_2_porcentaje':
        $logro = "logro2";
        $logroTema = "Uso de letras";
        $logroConseguido = "Rey de las Letras";
        if ($dificultad == 'facil') {
            $tema2 = 'tema2_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema2_medio' : 'tema2_dificil';
        }
        break;
    case 'tema_3_porcentaje':
        $logro = "logro3";
        $logroTema = "Concordancia";
        $logroConseguido = "Señor de la Concordancia";
        if ($dificultad == 'facil') {
            $tema2 = 'tema3_facil';
        } else {
            $tema2 = ($dificultad == 'medio') ? 'tema3_medio' : 'tema3_dificil';
        }
        break;
    case 'tema_4_porcentaje':
        $logro = "logro4";
        $logroTema = "Gramatica general";
        $logroConseguido = "Experto en Gramática";
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
            $consultaActualizar = "UPDATE estadisticasbasicas SET $tema2 = '$porcentajeEfectividad' WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
            $resultadoActualizar = $conexion->query($consultaActualizar);

            $consultaObtenerEstadisticas = "SELECT tiempo_total_practica FROM estadisticas WHERE usuario_nombre = '$nombreUsuario' AND codigo_sala = '$codigoSala'";
            $resultadoObtenerEstadisticas = $conexion->query($consultaObtenerEstadisticas);

            if ($resultadoObtenerEstadisticas->num_rows > 0) {
                $fila2 = $resultadoObtenerEstadisticas->fetch_assoc();
                $tiempoActual = $fila2['tiempo_total_practica'];
                $tiempoActualizado = $tiempoActual + $tiempoTranscurridoNuevo;

                $consultaBasica = "SELECT * FROM estadisticasbasicas WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
                $resultadoBasico = $conexion->query($consultaBasica);

                if ($resultadoBasico->num_rows > 0) {
                    // Array para almacenar los datos
                    $datosBasicos = $resultadoBasico->fetch_assoc();

                    $sumaEstadisticas = 0;

                    switch ($tema) {
                        case 'tema_1_porcentaje':
                            // Sumar los valores de los campos relacionados con el tema 1
                            $sumaEstadisticas = (($datosBasicos['tema1_facil'] + $datosBasicos['tema1_medio'] + $datosBasicos['tema1_dificil']) / 3);
                            break;
                        case 'tema_2_porcentaje':
                            // Sumar los valores de los campos relacionados con el tema 2
                            $sumaEstadisticas = (($datosBasicos['tema2_facil'] + $datosBasicos['tema2_medio'] + $datosBasicos['tema2_dificil']) / 3);
                            break;
                        case 'tema_3_porcentaje':
                            // Sumar los valores de los campos relacionados con el tema 3
                            $sumaEstadisticas = (($datosBasicos['tema3_facil'] + $datosBasicos['tema3_medio'] + $datosBasicos['tema3_dificil']) / 3);
                            break;
                        case 'tema_4_porcentaje':
                            // Sumar los valores de los campos relacionados con el tema 4
                            $sumaEstadisticas = (($datosBasicos['tema4_facil'] + $datosBasicos['tema4_medio'] + $datosBasicos['tema4_dificil']) / 3);
                            break;
                    }

                    $actualizar = "UPDATE estadisticas SET $tema = '$sumaEstadisticas', tiempo_total_practica = '$tiempoActualizado' WHERE codigo_sala = '$codigoSala' AND usuario_nombre ='$nombreUsuario'";
                    $actualizarRes = $conexion->query($actualizar);
                    if ($actualizarRes) {
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
                $response['message'] = "No se encontró el código de sala para este usuario.";
            }

            if ($resultadoActualizar) {
                $response['success'] = true;
                $response['message'] = "Datos actualizados correctamente en la tabla Estadisticas Basicas.";
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

$conexion->close(); // Cerrar conexión a la base de datos
