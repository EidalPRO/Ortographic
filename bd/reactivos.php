<?php
session_start();

include 'conexion_be.php';

if (isset($_POST['dato'])) {
    $miDato = $_POST['dato'];
    $miDificultad = $_POST['dato2'];

    //Consulta para obtener los reactivos repecto al tema ($miDato) y la dificultad ($miDificultad)
    $sql = "SELECT * FROM reactivos WHERE dificultad='$miDificultad' AND  tipo='$miDato'";
    $result = $conexion->query($sql);

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
        echo "No se encontraron resultados.";
    }

    $conexion->close();
} else {
    echo "No se recibió ningún dato.";
}
$conexion->close(); // Cerrar conexión a la base de datos