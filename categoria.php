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
    <link rel="stylesheet" href="assets/css/tema.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <h6>Seleccione el tema a practicar</h6>
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
                        <a class="nav-link" href="estadisticas.php">Estadisticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true" href="selecionar_sala.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="temas">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t1">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen4.jpeg" class="img-fluid" alt="Acentuación">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Acentuación.</h5>
                                    <p class="card-text">Uso de tildes para palabras agudas, graves y esdrújulas según
                                        las normativas específicas del idioma.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t2">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen6.jpeg" class="img-fluid" alt="Puntuación">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Puntuación.</h5>
                                    <p class="card-text">Uso adecuado de signos de puntuación como punto, coma, punto y
                                        coma, etc., para separar y organizar oraciones y párrafos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t3">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen2.jpeg" class="img-fluid" alt="Uso de letras">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Uso de letras.</h5>
                                    <p class="card-text">Normas para el uso adecuado de las letras, como la grafía
                                        correcta de las palabras, uso de mayúsculas y minúsculas, etc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t4">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen5.jpeg" class="img-fluid" alt="Gramatica">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Gramatica en general.</h5>
                                    <p class="card-text">El uso de palabras inexistentes o mal escritas puede
                                        clasificarse como errores ortográficos o gramaticales dependiendo del contexto
                                        específico en el que se cometan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="assets/js/tema.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>