
<?php
    session_start();
    if(!isset($_SESSION['usuario'])) {
        header("location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/estadisticas.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
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

                    // Obtener los datos de la tabla Estadisticas para la sala específica
                    $consulta = "SELECT * FROM estadisticas WHERE codigo_sala = '$codigoSala'";
                    $resultado = $conexion->query($consulta);

                    if ($resultado->num_rows > 0) {
                        echo "<table border='1' class='table table-light table-striped'>";
                        echo "<thead><tr><th scope='col'>Usuario</th><th scope='col'>Acentuación</th><th scope='col'>Puntuación</th><th scope='col'>Uso de letras</th><th scope='col'>Gramatica en general</th><th scope='col'>Tiempo de uso</th></tr></thead>";

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
                } else {
                    echo "No se encontró el código de sala para este usuario.";
                }
            } else {
                echo "No hay usuario registrado en la sesión.";
            }

            $conexion->close(); // Cerrar conexión a la base de datos
        ?>
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <a href="categoria.php" class="btn btn-outline-dark ">
                    <i class="bi bi-box-arrow-left"></i>
                    Regresar
                </a>
            </div>
        </div>
    </div> -->

    <script src="assets/js/tema.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>