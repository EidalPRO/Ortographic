<?php

session_start();
include 'conexion_be.php';


if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];

    // Realiza la consulta en la base de datos
    $sql = "SELECT * FROM Usuarios WHERE nombre LIKE '%$busqueda%'";
    $resultado = $conexion->query($sql);

    // Muestra la lista de usuarios
    while ($fila = $resultado->fetch_assoc()) {
        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
        echo $fila['nombre'];
        echo '<a href="index.php?id=' . $fila['nombre'] . '" class="btn btn-info btn-sm">Ver perfil</a>';
        echo '</li>';
    }
}

$conexion->close();
