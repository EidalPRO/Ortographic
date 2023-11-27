<?php
session_start();

include 'conexion_be.php';


// Recibir datos enviados desde JavaScript
// $tiempoTranscurrido = $_POST['tiempoTotal'];
// $nuevoPorcentaje = $_POST['porcentajeEfectividad'];

$tiempoTranscurrido = 10.00;
$nuevoPorcentaje = 100;

$codigoSala = $_GET['codigo_sala'];
$usuario = $_GET['usuario_nombre'];

// Consulta SQL para actualizar los datos en la tabla Estadisticas
$consulta = "UPDATE Estadisticas SET tiempo_total_practica = $tiempoTranscurrido, tema_1_porcentaje = $nuevoPorcentaje WHERE codigo_sala = '$codigoSala' AND usuario_nombre = '$usuario'";

// Ejecutar la consulta
$resultado = $conexion->query($consulta);

$response = array();

if ($resultado) {
    // Actualización exitosa
    $response['success'] = true;
    $response['message'] = "Datos actualizados correctamente en la tabla Estadisticas.";
} else {
    // Error al actualizar
    $response['success'] = false;
    $response['message'] = "Error al actualizar datos: " . $conexion->error;
}

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
