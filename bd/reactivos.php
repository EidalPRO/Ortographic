<?php

session_start();

include 'conexion_be.php';

if(isset($_POST['dato'])) {
    $miDato = $_POST['dato'];

    // Consulta SQL para obtener datos según el valor recibido
    $sql = "SELECT * FROM $miDato";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // Crear un array para almacenar los resultados de la consulta
        $data = array();

        // Recorrer los resultados y almacenarlos en el array
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Devolver los resultados como JSON
        echo json_encode($data);
    } else {
        echo "No se encontraron resultados.";
    }

    $conexion->close();
} else {
    echo "No se recibió ningún dato.";
}
?>
