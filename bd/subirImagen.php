<?php
session_start();
include 'conexion_be.php';

$palabrasProhibidas = array(
    'ofensiva', 'grosera', 'puto', 'puta', 'verga', 'zorra', 'pendejo', 'pendeja',
    'pene', 'sexo', 'nazi', 'pela', 'pelas', 'mierda', 'caca', 'kaka', 'popo',
    'pendejos', 'putos', 'putas', 'ramera', 'Puto', 'Puta', 'Pendejo', 'Pendeja',
    'Pendejos', 'Putos', 'Verga', 'Pene'
);


if(isset($_POST['accion']) && $_POST['accion'] === 'btn-subirImg') {
    subirImagen($conexion);
} else if (isset($_POST['accion']) && $_POST['accion'] === 'btn-descripcion'){
    subirDescripcion($conexion, $palabrasProhibidas);
}



function subirDescripcion($conexion, $palabrasProhibidas) {
    $nombreUsuario = $_SESSION['usuario'];
    
    // Obtener la descripción enviada por el formulario
    $descripcion = $_POST['descripcion'];
    
    // Verificar si la descripción contiene palabras prohibidas
    if (contienePalabrasProhibidas($descripcion, $palabrasProhibidas)) {
        header("location: ../index.php?error=descripcion_prohibida");
        exit; // Detener la ejecución del script
    } else {
        // Actualizar la descripción en la base de datos
        $query = mysqli_query($conexion, "UPDATE usuarios SET descripcion = '$descripcion' WHERE nombre = '$nombreUsuario'");
        
        if ($query) {
            header("location: ../index.php?exito=descripcionExitosa");
        }
    
        // Cerrar la conexión
        $conexion->close();
    }
    
}

function contienePalabrasProhibidas($texto, $palabrasProhibidas) {
    foreach ($palabrasProhibidas as $palabra) {
        if (stripos($texto, $palabra) !== false) {
            return true;
        }
    }
    return false;
}

function subirImagen($conexion) { 
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
            header("location: ../index.php?error=archivoErroneo");
            exit;
        } else if ($size > 50 * 1024 * 1024) {
            // echo "Error, el tamaño máximo de la imagen es de 50MB";
            header("location: ../index.php?error=archivoPesado");
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
            header("location: ../index.php?exito=en-foto");
        } else {
            // echo "Error al actualizar datos en la base de datos: " . mysqli_error($conexion);
            header("location: ../index.php?error=en-foto");
        }
    } else {
        // echo "Error, no se ha enviado ninguna imagen.";
        header("location: ../index.php?error-no-existe-imagen");
    }
    // Cerrar la conexión
    $conexion->close();
}


?>