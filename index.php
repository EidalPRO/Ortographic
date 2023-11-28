                <?php
                    session_start();
                    $session_iniciada = isset($_SESSION['usuario']);
                    $nombre_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';

                    $inicio_sesion_display = $session_iniciada ? 'style="display: none;"' : '';
                    $registro_display = $session_iniciada ? 'style="display: none;"' : '';


                    $cerrar_sesion_display = $session_iniciada ? '' : 'style="display: none;"';
                ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic game</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <img src="assets/imagenes/logoOrtographic.webp" width="50" alt="Logo Ortographic" class="Logo-index">
                <ul class="navbar-nav d-flex justify-content-center align-items-center">
                    <!-- Nombre de usuario -->
                    <li class="nav-item">
                    <?php if ($nombre_usuario !== '') { ?>
                        <span class="navbar-text ml-auto">
                            Bienvenido, <?php echo $nombre_usuario; ?>
                        </span>
                    <?php } ?>
                    </li>
                    <li class="nav-item" <?=$inicio_sesion_display ?>>
                        <a class="nav-link" aria-current="page" href="sesion_inicio.php">Iniciar sesión</a>
                    </li>
                    <li class="nav-item" <?=$registro_display ?>>
                        <a class="nav-link" href="registro_usuario.html">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bd/cerrar_sesion.php" id="logout-link" <?=$cerrar_sesion_display
                            ?>>Cerrar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manuales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Galeria de fotos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="creditos.html">Creditos</a>
                    </li>
                    <li class="nav-link">
                        <a class="nav-link" href="bd/cerrar_sesion.php" id="logout-link" style="display: none;">Cerrarsesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="hero align-items-strethc" id="hero">
        <div class="hero-principal d-flex flex-column justify-content-center align-items-center">
            <img src="assets/imagenes/logoOrtographic.webp" alt="Logo Ortographic" class="hero-imagen">
            <h1>Ortographic</h1>
            <h2>¿Crees tener buena ortografía?</h2>
            <img src="assets/imagenes/Grammi.webp" alt="Grammi" class="grammi">
            <img src="assets/imagenes/Queest.webp" alt="Queest" class="queest">
            <button type="submit" class="btn btn-outline-dark" name="boton_practicar">Empezar a practicar</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
       // Escucha el evento click del botón "Empezar a practicar"
       document.querySelector('[name="boton_practicar"]').addEventListener('click', function (event) {
            // Evita la acción por defecto del botón (si es un botón dentro de un formulario)
            event.preventDefault();

            // Verifica si la sesión está iniciada
            <?php if (isset($_SESSION['usuario'])) { ?>
                // Si la sesión está iniciada, redirige a categoria.php
                window.location.href = "selecionar_sala.php";
            <?php } else { ?>
                Swal.fire({
                    icon: "info",
                    title: "Inicia sesión",
                    text: "Debes iniciar sesión para tener una mejor experiencia del juego.",
                }).then(function () {
                    window.location.href = "sesion_inicio.php";
                });
            <?php } ?>
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>