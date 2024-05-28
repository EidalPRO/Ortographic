<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="assets/css/estadisticas.css">
    <link rel="stylesheet" href="assets/css/loader.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - Donde las letras se vuelven tu juego.</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <a class="navbar-brand" href="#">
                    <img src="assets/imagenes/logoOrtographic.webp" width="50" alt="Logo Ortographic">
                </a>
                <ul class="navbar-nav d-flex justify-content-center align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="" id="sala">Sala: </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true" href="categoria.php">Regresar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="table-responsive est">
        <!-- Tabla general -->
        <h5 class='text-center'>Estadísticas generales</h5>
        <div class='table-responsive'>
            <?php
            include 'bd/conexion_be.php';

            $nombreUsuario = $_SESSION['usuario'] ?? null;

            if ($nombreUsuario !== null) {
                // Consulta para obtener el código de sala del usuario
                $consultaCodigoSala = "SELECT codigo_sala FROM usuarioysala WHERE usuario = '$nombreUsuario'";
                $resultadoConsultaCodigo = $conexion->query($consultaCodigoSala);

                if ($resultadoConsultaCodigo->num_rows > 0) {
                    $fila = $resultadoConsultaCodigo->fetch_assoc();
                    $codigoSala = $fila['codigo_sala'];

                    $salaDificultad = "SELECT facil, medio, dificil FROM salas WHERE codigo_sala = '$codigoSala'";
                    $resultadoSala = $conexion->query($salaDificultad);

                    if ($resultadoSala) {
                        // Verificar si hay al menos una fila de resultados
                        if ($resultadoSala->num_rows > 0) {
                            // Obtener los datos de las dificultades
                            $filaRes = $resultadoSala->fetch_assoc();
                            $df1 = $filaRes["facil"];
                            $df2 = $filaRes["medio"];
                            $df3 = $filaRes["dificil"];

                            // Obtener los datos de la tabla Estadisticas para la sala específica
                            $consulta = "SELECT * FROM estadisticas WHERE codigo_sala = '$codigoSala'";
                            $resultado = $conexion->query($consulta);

                            if ($resultado->num_rows > 0) {
                                echo "<table border='1' class='table table-light table-striped'>";
                                echo "<thead><tr><th scope='col'>Usuario</th><th scope='col'>Acentuación</th><th scope='col'>Uso de letras</th><th scope='col'>Concordancia</th><th scope='col'>Gramatica en general</th><th scope='col'>Tiempo de uso</th></tr></thead>";
                                echo "<tbody>";
                                while ($fila = $resultado->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $fila['usuario_nombre'] . "</th>";
                                    echo "<td>" . $fila['tema_1_porcentaje'] . "%</td>";
                                    echo "<td>" . $fila['tema_2_porcentaje'] . "%</td>";
                                    echo "<td>" . $fila['tema_3_porcentaje'] . "%</td>";
                                    echo "<td>" . $fila['tema_4_porcentaje'] . "%</td>";
                                    echo "<td>" . $fila['tiempo_total_practica'] . " Segundos</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "No se encontraron registros para esta sala.";
                            }

                            // Consulta para obtener los datos de estadisticasbasicas
                            $consultaBasica = "SELECT * FROM estadisticasbasicas WHERE codigo_sala = '$codigoSala'";
                            $resultadoBasico = $conexion->query($consultaBasica);

                            if ($resultadoBasico->num_rows > 0) {
                                // Array para almacenar los datos
                                $datosBasicos = array();

                                while ($fila = $resultadoBasico->fetch_assoc()) {
                                    $datosBasicos[] = $fila;
                                }

                                // Contar el número de dificultades activas
                                $numDificultades = ($df1 === "true" ? 1 : 0) + ($df2 === "true" ? 1 : 0) + ($df3 === "true" ? 1 : 0);

                                if ($numDificultades > 1) {
                                    // Mostrar estadísticas por dificultad solo si hay más de una dificultad
                                    // Verificar si df1 es true
                                    if ($df1 === "true") {
                                        // Mostrar tabla de dificultad Fácil
                                        echo "<h5 class='text-center'>Estadísticas de todos los temas en su dificultad fácil.</h5>";
                                        echo "<table border='1' class='table table-light table-striped'>";
                                        echo "<thead><tr><th scope='col'>Usuario</th><th scope='col'>Acentuación</th><th scope='col'>Uso de letras</th><th scope='col'>Concordancia</th><th scope='col'>Gramatica en general</th></tr></thead>";
                                        echo "<tbody class='text-center'>";
                                        foreach ($datosBasicos as $datos) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $datos['usuario_nombre'] . "</th>";
                                            echo "<td>" . $datos['tema1_facil'] . "%</td>";
                                            echo "<td>" . $datos['tema2_facil'] . "%</td>";
                                            echo "<td>" . $datos['tema3_facil'] . "%</td>";
                                            echo "<td>" . $datos['tema4_facil'] . "%</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    }

                                    // Verificar si df2 es true
                                    if ($df2 === "true") {
                                        // Mostrar tabla de dificultad Medio
                                        echo "<h5 class='text-center'>Estadísticas de todos los temas en su dificultad medio.</h5>";
                                        echo "<table border='1' class='table table-light table-striped'>";
                                        echo "<thead><tr><th scope='col'>Usuario</th><th scope='col'>Acentuación</th><th scope='col'>Uso de letras</th><th scope='col'>Concordancia</th><th scope='col'>Gramatica en general</th></tr></thead>";
                                        echo "<tbody class='text-center'>";
                                        foreach ($datosBasicos as $datos) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $datos['usuario_nombre'] . "</th>";
                                            echo "<td>" . $datos['tema1_medio'] . "%</td>";
                                            echo "<td>" . $datos['tema2_medio'] . "%</td>";
                                            echo "<td>" . $datos['tema3_medio'] . "%</td>";
                                            echo "<td>" . $datos['tema4_medio'] . "%</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    }

                                    // Verificar si df3 es true
                                    if ($df3 === "true") {
                                        // Mostrar tabla de dificultad Difícil
                                        echo "<h5 class='text-center'>Estadísticas de todos los temas en su dificultad difícil.</h5>";
                                        echo "<table border='1' class='table table-light table-striped'>";
                                        echo "<thead><tr><th scope='col'>Usuario</th><th scope='col'>Acentuación</th><th scope='col'>Uso de letras</th><th scope='col'>Concordancia</th><th scope='col'>Gramatica en general</th></tr></thead>";
                                        echo "<tbody class='text-center'>";
                                        foreach ($datosBasicos as $datos) {
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $datos['usuario_nombre'] . "</th>";
                                            echo "<td>" . $datos['tema1_dificil'] . "%</td>";
                                            echo "<td>" . $datos['tema2_dificil'] . "%</td>";
                                            echo "<td>" . $datos['tema3_dificil'] . "%</td>";
                                            echo "<td>" . $datos['tema4_dificil'] . "%</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";
                                    }
                                }
                            } else {
                                echo "No se encontraron registros de estadísticas básicas para esta sala.";
                            }
                        } else {
                            echo "No se encontró el código de sala para este usuario.";
                        }
                    } else {
                        echo "No hay usuario registrado en la sesión.";
                    }
                } else {
                    // No se encontraron resultados para el código de sala especificado
                    // Puedes manejar esta situación según tu lógica de aplicación
                }
            } else {
                // Hubo un error al ejecutar la consulta SQL
                echo "Error al ejecutar la consulta: " . $conexion->error;
            }

            $conexion->close(); // Cerrar conexión a la base de datos
            ?>
        </div>
    </div>
    <section class="loader" id="loader">
        <svg xmlns="http://www.w3.org/2000/svg" height="200px" width="200px" viewBox="0 0 200 200" class="pencil">
            <defs>
                <clipPath id="pencil-eraser">
                    <rect height="30" width="30" ry="5" rx="5"></rect>
                </clipPath>
            </defs>
            <circle transform="rotate(-113,100,100)" stroke-linecap="round" stroke-dashoffset="439.82" stroke-dasharray="439.82 439.82" stroke-width="2" stroke="currentColor" fill="none" r="70" class="pencil__stroke" style="color: white;"></circle>
            <g transform="translate(100,100)" class="pencil__rotate">
                <g fill="none">
                    <circle transform="rotate(-90)" stroke-dashoffset="402" stroke-dasharray="402.12 402.12" stroke-width="30" stroke="hsl(223,90%,50%)" r="64" class="pencil__body1"></circle>
                    <circle transform="rotate(-90)" stroke-dashoffset="465" stroke-dasharray="464.96 464.96" stroke-width="10" stroke="hsl(223,90%,60%)" r="74" class="pencil__body2"></circle>
                    <circle transform="rotate(-90)" stroke-dashoffset="339" stroke-dasharray="339.29 339.29" stroke-width="10" stroke="hsl(223,90%,40%)" r="54" class="pencil__body3"></circle>
                </g>
                <g transform="rotate(-90) translate(49,0)" class="pencil__eraser">
                    <g class="pencil__eraser-skew">
                        <rect height="30" width="30" ry="5" rx="5" fill="hsl(223,90%,70%)"></rect>
                        <rect clip-path="url(#pencil-eraser)" height="30" width="5" fill="hsl(223,90%,60%)"></rect>
                        <rect height="20" width="30" fill="hsl(223,10%,90%)"></rect>
                        <rect height="20" width="15" fill="hsl(223,10%,70%)"></rect>
                        <rect height="20" width="5" fill="hsl(223,10%,80%)"></rect>
                        <rect height="2" width="30" y="6" fill="hsla(223,10%,10%,0.2)"></rect>
                        <rect height="2" width="30" y="13" fill="hsla(223,10%,10%,0.2)"></rect>
                    </g>
                </g>
                <g transform="rotate(-90) translate(49,-30)" class="pencil__point">
                    <polygon points="15 0,30 30,0 30" fill="hsl(33,90%,70%)"></polygon>
                    <polygon points="15 0,6 30,0 30" fill="hsl(33,90%,50%)"></polygon>
                    <polygon points="15 0,20 10,10 10" fill="hsl(223,10%,10%)"></polygon>
                </g>
            </g>
        </svg>
    </section>

    <script src="assets/js/loader.js"></script>
    <script src="assets/js/estadisticas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>