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
    <link rel="stylesheet" href="assets/css/reactivos.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic game</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75"
                    aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-body">
                    <p id="mostrar-reactivo"></p>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-outline-dark" id="op1"></button>
            </div>
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-outline-dark" id="op2"></button>
            </div>
            <div class="col-md-4 col-12">
                <button type="button" class="btn btn-outline-dark" id="op3"></button>
            </div>
            <div class="col-12">
                <img src="assets/imagenes/Grammi.webp" alt="Grammi">
            </div>
            <div class="col-12 icono-contenedor">
                <a class="btn btn-secondary" href="categoria.php" id="btn">
                    <i class="bi bi-house"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/juego.js"></script>
</body>

</html>