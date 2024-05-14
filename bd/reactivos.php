<?php
session_start();

include 'conexion_be.php';

if (isset($_POST['dato']) && isset($_POST['dato2'])) {
    $miDato = $_POST['dato'];
    $miDificultad = $_POST['dato2'];

    //Consulta para obtener los reactivos repecto al tema ($miDato) y la dificultad ($miDificultad)
    $sql = "SELECT * FROM reactivos WHERE dificultad='$miDificultad' AND  tipo='$miDato'";
    $result = $conexion->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            //Crear un array para almacenar los resultados de la consulta
            $data = array();

            //Recorrer los resultados y almacenarlos en el array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            //Devolver los resultados como JSON
            echo json_encode($data);
        } else {
            echo json_encode(array("success" => false, "message" => "No se encontraron resultados."));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Error en la consulta SQL: " . $conexion->error));
    }
} else {
    echo json_encode(array("success" => false, "message" => "No se recibieron datos válidos."));
}

// Cerrar conexión a la base de datos
$conexion->close();
