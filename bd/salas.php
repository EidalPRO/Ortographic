<?php
include 'conexion_be.php';

session_start();

if (isset($_POST['accion']) && $_POST['accion'] === 'nuevo') {
    nuevaSala($conexion);
} else {
    salaExistente($conexion);
}


function salaExistente($conexion)
{
    //ESTE CODIGO SE PUEDE UTILIZAR AL AGREGAR LAS SALAS PRIVADAS
    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sala'])) {
        $codigo_sala = $_POST['sala'];
        $nombre_usuario = $_SESSION['usuario'];

        // Verificar si el usuario ya está en la sala
        $consulta_existencia_estadisticas = "SELECT * FROM estadisticas WHERE usuario_nombre = '$nombre_usuario' AND codigo_sala = '$codigo_sala'";
        $resultado_existencia_estadisticas = $conexion->query($consulta_existencia_estadisticas);

        if ($resultado_existencia_estadisticas->num_rows > 0) {
            // Si el usuario ya está en la sala, redirigir a la página de temas
            $update_usuarioYsala = "UPDATE usuarioysala SET codigo_sala = '$codigo_sala' WHERE usuario = '$nombre_usuario'";
            $res = $conexion->query($update_usuarioYsala);
            header("location: ../categoria.php?codigoSala=$codigo_sala");
            exit();
        } else {
            // Si el usuario no está en la sala, insertarlo en la tabla de Estadisticas
            $consulta_sala_existente = "SELECT * FROM salas WHERE codigo_sala = '$codigo_sala'";
            $resultado_sala_existente = $conexion->query($consulta_sala_existente);

            if ($resultado_sala_existente->num_rows > 0) {
                $consulta_existencia_usuarioEnSala = "SELECT * FROM usuarioysala WHERE usuario = '$nombre_usuario'";
                $resultado_existencia_usuarioEnSala = $conexion->query($consulta_existencia_usuarioEnSala);

                if (!($resultado_existencia_usuarioEnSala->num_rows > 0)) {
                    $insert_usuarioYsala = "INSERT INTO usuarioysala (usuario, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                    $rest = $conexion->query($insert_usuarioYsala);
                } else {
                    $update_usuarioYsala = "UPDATE usuarioysala SET codigo_sala = '$codigo_sala' WHERE usuario = '$nombre_usuario'";
                    $res = $conexion->query($update_usuarioYsala);
                }


                // Si la sala existe, insertar al usuario en la tabla de Estadisticas
                $insertar_usuario_estadisticas = "INSERT INTO estadisticas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $insertar_usuario_estadisticas2 = "INSERT INTO estadisticasbasicas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $conexion->query($insertar_usuario_estadisticas);
                $conexion->query($insertar_usuario_estadisticas2);



                header("location: ../categoria.php?codigoSala=$codigo_sala");
                exit();
            } else {
                // Si la sala no existe, mostrar un mensaje de error
                header("location: ../selecionar_sala.php?error=sala_no_encontrada");
                exit();
            }
        }
    } else {

        $codigo_sala = 'A0123';
        $nombre_usuario = $_SESSION['usuario'];

        // Verificar si el usuario ya está en la sala
        $consulta_existencia_estadisticas = "SELECT * FROM estadisticas WHERE usuario_nombre = '$nombre_usuario' AND codigo_sala = '$codigo_sala'";
        $resultado_existencia_estadisticas = $conexion->query($consulta_existencia_estadisticas);

        if ($resultado_existencia_estadisticas->num_rows > 0) {
            // Si el usuario ya está en la sala, redirigir a la página de temas
            $update_usuarioYsala = "UPDATE usuarioysala SET codigo_sala = '$codigo_sala' WHERE usuario = '$nombre_usuario'";
            $res = $conexion->query($update_usuarioYsala);
            header("location: ../categoria.php?codigoSala=$codigo_sala");
            exit();
        } else {
            // Si el usuario no está en la sala, insertarlo en la tabla de Estadisticas
            $consulta_sala_existente = "SELECT * FROM salas WHERE codigo_sala = '$codigo_sala'";
            $resultado_sala_existente = $conexion->query($consulta_sala_existente);

            if ($resultado_sala_existente->num_rows > 0) {
                // Si la sala existe, insertar al usuario en la tabla de Estadisticas
                $insertar_usuario_estadisticas = "INSERT INTO estadisticas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $insertar_usuario_estadisticas2 = "INSERT INTO estadisticasbasicas (usuario_nombre, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $conexion->query($insertar_usuario_estadisticas);
                $conexion->query($insertar_usuario_estadisticas2);

                $insert_usuarioYsala = "INSERT INTO usuarioysala (usuario, codigo_sala) VALUES ('$nombre_usuario', '$codigo_sala')";
                $rest = $conexion->query($insert_usuarioYsala);

                header("location: ../categoria.php?codigoSala=$codigo_sala");
                exit();
            } else {
                // Si la sala no existe, mostrar un mensaje de error
                header("location: ../selecionar_sala.php?error=sala_no_encontrado");
                exit();
            }
        }
    }
    // }
}


function nuevaSala($conexion)
{
    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir el código de sala
        $codigo_sala = $_POST["codigo"];

        // Verificar si el código de sala ya existe en la base de datos
        $consulta_existencia_codigo = "SELECT codigo_sala FROM salas WHERE codigo_sala = '$codigo_sala'";
        $resultado_existencia_codigo = $conexion->query($consulta_existencia_codigo);

        if ($resultado_existencia_codigo->num_rows > 0) {
            // Si el código de sala ya existe, mostrar un mensaje de error y salir del script
            header("location: ../selecionar_sala.php?error=sala_existente");
            exit();
        } else {
            // Recibir el nombre de la sala
            $nombre_sala = $_POST["sala"];
            $nombre_usuario = $_SESSION['usuario'];

            // Inicializar variables para cada dificultad
            $df1 = "";
            $df2 = "";
            $df3 = "";

            // Asignar valor a las variables de dificultad según lo seleccionado en el formulario
            if (isset($_POST["dificultad1"])) {
                $df1 = "true";
            } else {
                $df1 = "false";
            }
            if (isset($_POST["dificultad2"])) {
                $df2 = "true";
            } else {
                $df2 = "false";
            }
            if (isset($_POST["dificultad3"])) {
                $df3 = "true";
            } else {
                $df3 = "false";
            }

            // Insertar la nueva sala en la base de datos
            $nuevaSala = "INSERT INTO salas (codigo_sala, nombre_sala, administrador) VALUES ('$codigo_sala', '$nombre_sala', '$nombre_usuario')";
            $ejecutarNuevaSala = $conexion->query($nuevaSala);

            if ($ejecutarNuevaSala) {
                // Redirigir a categoria.php con los parámetros
                header("Location: ../categoria.php?codigoSala=$codigo_sala&df1=$df1&df2=$df2&df3=$df3");
                exit();
            } else {
                echo "Error al crear la sala: " . $conexion->error;
            }
        }
    }
}
