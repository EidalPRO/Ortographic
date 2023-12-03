<?php

session_start();

include 'conexion_be.php';

$sql = "SELECT * FROM reactivosuso";
$resultado = $conexion->query($sql);

$datos_reactivos = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $datos_reactivos[] = $fila;
    }
}

// Convertir los datos a formato JSON y enviarlos al cliente
echo json_encode($datos_reactivos);
?>
