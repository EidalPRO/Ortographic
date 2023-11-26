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
    <div class="titulo-contenedor">
        <h2 class="text-center">Seleccione el tema a practicar.</h2>
    </div>

    <div class="container">
        <div class="card-group">
            <div class="card">
                <img src="assets/imagenes/logoOrtographic.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text text-center">Descripcion breve.</p>
                </div>
                <a href="#" class="btn btn-outline-dark">Comenzar</a>
            </div>
            <div class="card">
                <img src="assets/imagenes/logoOrtographic.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text text-center">Descripcion breve</p>
                </div>
                <a href="#" class="btn btn-outline-dark">Comenzar</a>
            </div>
            <div class="card">
                <img src="assets/imagenes/logoOrtographic.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text text-center">Descripcion breve</p>
                </div>
                <a href="#" class="btn btn-outline-dark">Comenzar</a>
            </div>
            <div class="card">
                <img src="assets/imagenes/logoOrtographic.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text text-center">Descripcion breve.</p>
                </div>
                <a href="#" class="btn btn-outline-dark">Comenzar</a>
            </div>
        </div>
    </div>

    <div class="regresar text-center">
        <a href="index.php">
            <i class="bi bi-box-arrow-left"></i>
        </a>
    </div>

    <script src="assets/js/categoria.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>