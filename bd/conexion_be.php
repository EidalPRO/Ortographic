<?php

    $BD_PORT = "localhost";
    $BD_USER = "root";
    $BD_CON = "";
    $BD_NAME = "Ortographic_bd";

    $conexion = mysqli_connect($BD_PORT, $BD_USER, $BD_CON, $BD_NAME);

    // Verificar conexion
    if($conexion) {
        echo 'Conectado exitosamente a la base de datos ';
    } else {
        echo 'No se ha podido conectar a la base de datos. ';
    }

?>