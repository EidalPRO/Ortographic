<?php
session_start();

include 'conexion_be.php';

$datosJSON = file_get_contents('php://input');
$datos = json_decode($datosJSON, true);

// $tiempoTranscurridoNuevo = $datos['tiempoTotal'] ?? null;
// $porcentajeEfectividad = $datos['porcentajeEfectividad'] ?? null;
// $tema = $datos['tema'] ?? null;
// $dificultad = $datos['dificultad'] ?? null;
// $df1 = $datos['df1'] ?? null;
// $df2 = $datos['df2'] ?? null;
// $df3 = $datos['df3'] ?? null;
// $tema2 = null;
// $logroObtenido = null;
// $logro = null;
// $logroTema = null;

$tiempoTranscurridoNuevo = $datos['tiempoTotal'] ?? null;
$porcentajeEfectividad = $datos['porcentajeEfectividad'] ?? null;
$tema = $datos['tema'] ?? null;
$dificultad = $datos['dificultad'] ?? null;
$df = 3;
$df1 = $datos['df1'] ?? null;
$df2 = $datos['df2'] ?? null;
$df3 = $datos['df3'] ?? null;
$tema2 = "";
$tema3 = "";
$logroConseguido = null;
$logro = null;
$logroTema = null;

switch ($tema) {
    case "tema_1_porcentaje":
        if ($dificultad == 'facil') {
            $tema2 = 'tema1_facil';
        } else if ($dificultad == 'medio') {
            $tema2 = 'tema1_medio';
        } else {
            $tema2 = 'tema1_dificil';
        }
        $tema3 = 'tema1';
        $logro = "logro1";
        $logroConseguido = "Maestro de la Acentuación";
        $logroTema = "Acentuación";
        break;
    case 'tema_2_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema2_facil';
        } else if ($dificultad == 'medio') {
            $tema2 = 'tema2_medio';
        } else {
            $tema2 = 'tema2_dificil';
        }
        $tema3 = 'tema2';
        $logro = "logro2";
        $logroTema = "Uso de letras";
        $logroConseguido = "Rey de las Letras";
        break;
    case 'tema_3_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema3_facil';
        } else if ($dificultad == 'medio') {
            $tema2 = 'tema3_medio';
        } else {
            $tema2 = 'tema3_dificil';
        }
        $tema3 = 'tema3';
        $logro = "logro3";
        $logroTema = "Concordancia";
        $logroConseguido = "Señor de la Concordancia";
        break;
    case 'tema_4_porcentaje':
        if ($dificultad == 'facil') {
            $tema2 = 'tema4_facil';
        } else if ($dificultad == 'medio') {
            $tema2 = 'tema4_medio';
        } else {
            $tema2 = 'tema4_dificil';
        }
        $tema3 = 'tema4';
        $logro = "logro4";
        $logroTema = "Gramatica general";
        $logroConseguido = "Experto en Gramática";
        break;
}


if ($tema2 !== null && $tiempoTranscurridoNuevo != null && $porcentajeEfectividad != null && $df != null) {

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

                if ($df === 1) {
                    $actualizar = "UPDATE estadisticas SET $tema = '$porcentajeEfectividad', tiempo_total_practica = '$tiempoActualizado' WHERE codigo_sala = '$codigoSala' AND usuario_nombre ='$nombreUsuario'";
                    $actualizarRes = $conexion->query($actualizar);
                    if ($actualizarRes) {
                        $response['success'] = true;
                        $response['message'] = "Datos actualizados correctamente en la tabla Estadisticas una dificultad.";
                    } else {
                        $response['success'] = false;
                        $response['message'] = "Error al actualizar datos: " . $conexion->error;
                    }
                } else if ($df >= 2) {
                    // Si hay dos o más dificultades, realizar las operaciones según el tema y las dificultades
                    $consultaBasica = "SELECT * FROM estadisticasbasicas WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$nombreUsuario'";
                    $resultadoBasico = $conexion->query($consultaBasica);
                    if ($resultadoBasico->num_rows > 0) {
                        // Array para almacenar los datos
                        $datosBasicos = $resultadoBasico->fetch_assoc();

                        $sumaEstadisticas = 0;
                        $countDificultades = 0;

                        if ($df1) {
                            $sumaEstadisticas += $datosBasicos[$tema3 . '_facil'];
                            $countDificultades++;
                        }

                        if ($df2) {
                            $sumaEstadisticas += $datosBasicos[$tema3 . '_medio'];
                            $countDificultades++;
                        }

                        if ($df3) {
                            $sumaEstadisticas += $datosBasicos[$tema3 . '_dificil'];
                            $countDificultades++;
                        }

                        // Calcular el promedio de los porcentajes
                        $promedioPorcentajes = $sumaEstadisticas / $countDificultades;

                        $actualizar = "UPDATE estadisticas SET $tema = '$promedioPorcentajes', tiempo_total_practica = '$tiempoActualizado' WHERE codigo_sala = '$codigoSala' AND usuario_nombre ='$nombreUsuario'";
                        $actualizarRes = $conexion->query($actualizar);
                        if ($actualizarRes) {
                            $response['success'] = true;
                            $response['message'] = "Datos actualizados correctamente en la tabla Estadisticas ".$countDificultades." dificultades. ";
                        } else {
                            $response['success'] = false;
                            $response['message'] = "Error al actualizar datos: " . $conexion->error;
                        }
                    }
                }
            } else {
                $response['success'] = false;
                $response['message'] = "No se encontró el código de sala para este usuario.";
            }
        } else {
            $response['success'] = false;
            $response['message'] = "No se encontró el código de sala para este usuario.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Falta el nombre de usuario en la sesión.";
        echo 'falta usuario';
    }
} else {
    $response['success'] = false;
    $response['message'] = "Datos insuficientes para realizar la actualización.";
    echo 'datos insuficuentes';
}

header('Content-Type: application/json');
echo json_encode($response);

$conexion->close(); // Cerrar conexión a la base de datos
