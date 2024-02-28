<?php
session_start();
include 'conexion_be.php';

// Obtener el nombre de usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Inicializar la variable de imagen
$imagen = '';

// Verificar si se ha enviado un archivo
if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $rutaProvisional = $file["tmp_name"];
    $size = $file["size"];
    $carpeta = "perfiles/";

    // Verificar el tipo y tamaño del archivo
    if ($tipo != 'image/jpg' && $tipo != 'image/JPG' && $tipo != 'image/png' && $tipo != 'image/jpeg') {
        // echo "Error, el archivo no es una imagen.";
        header("location: ../miPerfil.php?archivoErroneo");
        exit;
    } else if ($size > 50 * 1024 * 1024) {
        // echo "Error, el tamaño máximo de la imagen es de 50MB";
        header("location: ../miPerfil.php?archivoPesado");
        exit;
    }

    // Generar la ruta de destino
    $src = $carpeta . $nombre;

    // Mover el archivo a la carpeta de destino
    var_dump(file_exists($rutaProvisional), $rutaProvisional);
    // move_uploaded_file($rutaProvisional, $src);
    $rutaCarpeta = __DIR__ . DIRECTORY_SEPARATOR . "perfiles/";
    if (!file_exists($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    $src = $rutaCarpeta . DIRECTORY_SEPARATOR . $nombre;
    move_uploaded_file($rutaProvisional, $src);
    // Actualizar la variable de imagen con la ruta relativa
    $imagen = "perfiles/" . DIRECTORY_SEPARATOR . $nombre;

   

    // Actualizar la columna 'foto' en la base de datos
    $query = mysqli_query($conexion, "UPDATE usuarios SET foto = '$imagen' WHERE nombre = '$nombreUsuario'");

    if ($query) {
        header("location: ../miPerfil.php?exito");
    } else {
        // echo "Error al actualizar datos en la base de datos: " . mysqli_error($conexion);
        header("location: ../miPerfil.php?error");
    }
} else {
    // echo "Error, no se ha enviado ninguna imagen.";
    header("location: ../miPerfil.php?error");
}

// Cerrar la conexión
$conexion->close();
?>
