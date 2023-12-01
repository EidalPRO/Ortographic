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
    <link rel="stylesheet" href="assets/css/categoria.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic game</title>
</head>

<body>
    <div class="container">
        <div class="row navx">
            <div class="col-4"> 
                <h5  id="sala" class="text-bg-secondary p-3">Sala: </h5>
            </div>
            <div class="col-4">
                <a href="estadisticas.php" class="btn btn-secondary esta">
                    <i class="bi bi-folder2-open"></i>
                    Estadisticas
                </a>
            </div>
            <div class="col-4">
                <div class="regresar text-center">
                    <a href="selecionar_sala.php">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="titulo-contenedor">
            <h3 class="text-center">Seleccione el tema a practicar.</h3>
        </div>
    </div>
        

    <div class="container">
        <div class="card-group ">
            <div class="card">
            <div class="imagen-contenedor">
                <img src="assets/imagenes/acento.webp" class="card-img-top" alt="...">
            </div>
                <div class="card-body">
                    <h5 class="card-title">Acentuación</h5>
                    <p class="card-text text-center">Uso de tildes para palabras agudas, graves y esdrújulas según las normativas específicas del idioma.</p>
                </div>
                <a href="acentos.php" class="btn btn-outline-dark">Comenzar</a>
            </div>
            <div class="card ">
            <div class="imagen-contenedor">
                <img src="assets/imagenes/puntuacion.webp" class="card-img-top" alt="...">
            </div>
                <div class="card-body">
                    <h5 class="card-title">Puntuación</h5>
                    <p class="card-text text-center">Uso adecuado de signos de puntuación como punto, coma, punto y coma, etc., para separar y organizar oraciones y párrafos.</p>
                </div>
                <a href="punto.php" class="btn btn-outline-dark">Comenzar</a>
            </div>
            <div class="card ">
            <div class="imagen-contenedor let">
                <img src="assets/imagenes/uso.webp" class="card-img-top" alt="...">
            </div>
                <div class="card-body">
                    <h5 class="card-title">Uso de letras</h5>
                    <p class="card-text text-center">Normas para el uso adecuado de las letras, como la grafía correcta de las palabras, uso de mayúsculas y minúsculas, etc.</p>
                </div>
                <a href="usoLetras.php" class="btn btn-outline-dark ">Comenzar</a>
            </div>
            <div class="card ">
                <div class="imagen-contenedor">
                    <img src="assets/imagenes/grama.webp" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gramatica en general</h5>
                    <p class="card-text text-center">El uso de palabras inexistentes o mal escritas puede clasificarse como errores ortográficos o gramaticales dependiendo del contexto específico en el que se cometan.</p>
                </div>
                <a href="gramatica.php" class="btn btn-outline-dark">Comenzar</a>
            </div>
        </div>
    </div>

    

    <script src="assets/js/categoria.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>