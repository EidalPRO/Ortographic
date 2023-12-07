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
    <link rel="stylesheet" href="assets/css/salas.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-3">

            </div>
            <div class="col-lg-4 col-md-6 d-flex flex-column">
                <div class="w-100 form">
                    <h3>Salas.</h3>
                    <form action="bd/salas.php" method="POST" class="formulario mb-5">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ingresa el ID de la sala</label>
                            <input type="text" class="form-control" autocomplete="off" name="sala" id="salaCod">
                        </div>
                        <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                if ($error === "sala_no_encontrado") {
                                    echo '
                                    <div class="alert alert-danger" role="alert">
                                        La sala ingresada no existe.
                                        </div>
                                    ';
                                }
                            }
                        ?>
                        <button type="submit" class="btn btn-secondary">Aceptar</button>
                    </form>
                </div>
                <div class="imagen mb-auto">
                    <img src="assets/imagenes/logoOrtographic.webp" alt="Logo Ortographic" width="70px">
                </div>
                <div class="unica">
                    <h3>Por ahora es sala unica con ID: A0123</h3>
                </div>

                <div class="regresar text-center">
                    <a href="index.php">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-3">

            </div>
        </div>
    </div>

    <script>
        // Obtener el valor del código de sala del formulario
        const codigoSala = document.getElementById('salaCod').value.trim();
       // Almacenar el código de sala en el Local Storage
        localStorage.setItem('codigoSala', codigoSala);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>