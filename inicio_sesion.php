<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <div class="container formulario-contenedor">
        <h3>Bienvenido de vuelta.</h3>
        <form action="bd/login_usuario.php" method="POST" >
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario">
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena">
            </div>
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error === "usuario_no_encontrado") {
                        echo '
                            <div class="alert alert-danger" role="alert">
                                Usuario y/o contraseña incorrecta!
                            </div>
                        ';
                    }
                }
            ?>
            <button type="submit" class="btn btn-secondary">Aceptar</button>
        </form>
        <div class="nueva-cuenta text-center">
            <p class="d-inline-block">¿No tienes cuenta?</p>
            <a href="registro_usuario.html">Crea una aquí</a>
        </div>
        <div class="imagen mb-auto">
            <img src="assets/imagenes/logoOrtographic.webp" alt="Logo Ortographic" width="70px">
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>