<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/jugar.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/imagenes/logoOrtographic.webp" width="50" alt="Logo Ortographic">
            </a>
            <p id="contador"></p>
            <!-- <p class="nav-item text-center" aria-current="page" id="sala_id">Sala: </p> -->
            <a class="nav-item" aria-disabled="true" href="" id="salir">Salir</a>
        </div>
    </nav>

    <div class="container progreso">
        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 0"></div>
        </div>
    </div>


    <div class="container-fluid conten">
        <div class="contariner d-flex reac">
            <div class="row">
                <div class="col-12 preg-contenedor">
                    <h3 class="preg" id="mostrar-reactivo"></h3>
                </div>
                <div class="col-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 res">
                                <div class="p">
                                    <p>1</p>
                                </div>
                                <button class="btn btn-light" id="op1"></button>
                            </div>
                            <div class="col-12 res">
                                <div class="p">
                                    <p>2</p>
                                </div>
                                <button class="btn btn-light" id="op2"></button>
                            </div>
                            <div class="col-12 res">
                                <div class="p">
                                    <p>3</p>
                                </div>
                                <button class="btn btn-light" id="op3"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/jugar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>