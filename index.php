<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/index2.css">
    <link rel="stylesheet" href="assets/css/miPerfil.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Ortographic - Donde las letras se vuelven tu juego.</title>
</head>

<body>

    <div class="hero">
        <div class="container-fluid text-center img-contenedor">
            <img src="assets/imagenes/hero-orto.webp" class="img-fluid" alt="Ortographic">
        </div>
        <h1 class="text-center">Ortographic</h1>
        <p class="text-center">Donde las letras se vuelven tu juego.</p>
    </div>

    <section class="navegacion">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <?php
                        session_start();
                        if (isset($_SESSION['usuario'])) {
                            echo '<a type="button"  data-bs-toggle="modal" data-bs-target="#MiPerfil">
                                    <i class="bi bi-person"></i>
                                    </a>
                                ';
                        } else {
                            echo '<a href="inicio_sesion.php"><i class="bi bi-person-check"></i></a>';
                        }
                        ?>
                    </div>
                    <?php if (!isset($_SESSION['usuario'])) { ?>
                        <p>Iniciar sesión</p>
                    <?php } else { ?>
                        <!-- <p><?php echo $_SESSION['usuario']; ?></p> -->
                        <p>Mi perfil</p>
                    <?php } ?>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <?php if (!isset($_SESSION['usuario'])) { ?>
                        <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                            <a href="inicio_sesion.php">
                                <i class="bi bi-person-add"></i>
                            </a>
                        </div>
                        <p>Registrarse</p>
                    <?php } else { ?>
                        <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                            <a href="bd/cerrar_sesion.php">
                                <i class="bi bi-person-dash"></i>
                            </a>
                        </div>
                        <p>Cerrar sesión</p>
                    <?php } ?>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="submit" id="boton_practicar" href="selecionar_sala.php">
                            <i class="bi bi-controller"></i>
                        </a>
                    </div>
                    <p>Practicar</p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a href="#galeria">
                            <i class="bi bi-archive"></i>
                        </a>
                    </div>
                    <p>Galería de fotos</p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir  d-flex flex-wrap align-items-center justify-content-center">
                        <a href="#manual">
                            <i class="bi bi-question-lg"></i>
                        </a>
                    </div>
                    <p>Manual de usuario</p>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir  d-flex flex-wrap align-items-center justify-content-center">
                        <a href="#creditos">
                            <i class="bi bi-credit-card-2-front"></i>
                        </a>
                    </div>
                    <p>Creditos</p>
                </div>
            </div>
        </div>
    </section>

    <?php
    //  session_start();
    include 'bd/conexion_be.php';
    if (isset($_SESSION['usuario'])) {

        // nombre de usuario de la sesión
        $nombreUsuario = $_SESSION['usuario'];

        // información del usuario
        $queryUsuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'");
        $usuario = mysqli_fetch_assoc($queryUsuario);

        $conexion->close();
    }
    ?>
    
    <section class="mi-perfil">
        <div class="modal fade" id="MiPerfil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content perfil-contenedor">
                    <div class="modal-body">
                        <div class="card">
                            <button class="btn-close" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i>
                            </button>
                            <div class="card__img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%">
                                    <rect fill="#ffffff" width="540" height="450"></rect>
                                    <defs>
                                        <linearGradient id="a" gradientUnits="userSpaceOnUse" x1="0" x2="0" y1="0" y2="100%" gradientTransform="rotate(222,648,379)">
                                            <stop offset="0" stop-color="#ffffff"></stop>
                                            <stop offset="1" stop-color="#FC726E"></stop>
                                        </linearGradient>
                                        <pattern patternUnits="userSpaceOnUse" id="b" width="300" height="250" x="0" y="0" viewBox="0 0 1080 900">
                                            <g fill-opacity="0.5">
                                                <polygon fill="#444" points="90 150 0 300 180 300"></polygon>
                                                <polygon points="90 150 180 0 0 0"></polygon>
                                                <polygon fill="#AAA" points="270 150 360 0 180 0"></polygon>
                                                <polygon fill="#DDD" points="450 150 360 300 540 300"></polygon>
                                                <polygon fill="#999" points="450 150 540 0 360 0"></polygon>
                                                <polygon points="630 150 540 300 720 300"></polygon>
                                                <polygon fill="#DDD" points="630 150 720 0 540 0"></polygon>
                                                <polygon fill="#444" points="810 150 720 300 900 300"></polygon>
                                                <polygon fill="#FFF" points="810 150 900 0 720 0"></polygon>
                                                <polygon fill="#DDD" points="990 150 900 300 1080 300"></polygon>
                                                <polygon fill="#444" points="990 150 1080 0 900 0"></polygon>
                                                <polygon fill="#DDD" points="90 450 0 600 180 600"></polygon>
                                                <polygon points="90 450 180 300 0 300"></polygon>
                                                <polygon fill="#666" points="270 450 180 600 360 600"></polygon>
                                                <polygon fill="#AAA" points="270 450 360 300 180 300"></polygon>
                                                <polygon fill="#DDD" points="450 450 360 600 540 600"></polygon>
                                                <polygon fill="#999" points="450 450 540 300 360 300"></polygon>
                                                <polygon fill="#999" points="630 450 540 600 720 600"></polygon>
                                                <polygon fill="#FFF" points="630 450 720 300 540 300"></polygon>
                                                <polygon points="810 450 720 600 900 600"></polygon>
                                                <polygon fill="#DDD" points="810 450 900 300 720 300"></polygon>
                                                <polygon fill="#AAA" points="990 450 900 600 1080 600"></polygon>
                                                <polygon fill="#444" points="990 450 1080 300 900 300"></polygon>
                                                <polygon fill="#222" points="90 750 0 900 180 900"></polygon>
                                                <polygon points="270 750 180 900 360 900"></polygon>
                                                <polygon fill="#DDD" points="270 750 360 600 180 600"></polygon>
                                                <polygon points="450 750 540 600 360 600"></polygon>
                                                <polygon points="630 750 540 900 720 900"></polygon>
                                                <polygon fill="#444" points="630 750 720 600 540 600"></polygon>
                                                <polygon fill="#AAA" points="810 750 720 900 900 900"></polygon>
                                                <polygon fill="#666" points="810 750 900 600 720 600"></polygon>
                                                <polygon fill="#999" points="990 750 900 900 1080 900"></polygon>
                                                <polygon fill="#999" points="180 0 90 150 270 150"></polygon>
                                                <polygon fill="#444" points="360 0 270 150 450 150"></polygon>
                                                <polygon fill="#FFF" points="540 0 450 150 630 150"></polygon>
                                                <polygon points="900 0 810 150 990 150"></polygon>
                                                <polygon fill="#222" points="0 300 -90 450 90 450"></polygon>
                                                <polygon fill="#FFF" points="0 300 90 150 -90 150"></polygon>
                                                <polygon fill="#FFF" points="180 300 90 450 270 450"></polygon>
                                                <polygon fill="#666" points="180 300 270 150 90 150"></polygon>
                                                <polygon fill="#222" points="360 300 270 450 450 450"></polygon>
                                                <polygon fill="#FFF" points="360 300 450 150 270 150"></polygon>
                                                <polygon fill="#444" points="540 300 450 450 630 450"></polygon>
                                                <polygon fill="#222" points="540 300 630 150 450 150"></polygon>
                                                <polygon fill="#AAA" points="720 300 630 450 810 450"></polygon>
                                                <polygon fill="#666" points="720 300 810 150 630 150"></polygon>
                                                <polygon fill="#FFF" points="900 300 810 450 990 450"></polygon>
                                                <polygon fill="#999" points="900 300 990 150 810 150"></polygon>
                                                <polygon points="0 600 -90 750 90 750"></polygon>
                                                <polygon fill="#666" points="0 600 90 450 -90 450"></polygon>
                                                <polygon fill="#AAA" points="180 600 90 750 270 750"></polygon>
                                                <polygon fill="#444" points="180 600 270 450 90 450"></polygon>
                                                <polygon fill="#444" points="360 600 270 750 450 750"></polygon>
                                                <polygon fill="#999" points="360 600 450 450 270 450"></polygon>
                                                <polygon fill="#666" points="540 600 630 450 450 450"></polygon>
                                                <polygon fill="#222" points="720 600 630 750 810 750"></polygon>
                                                <polygon fill="#FFF" points="900 600 810 750 990 750"></polygon>
                                                <polygon fill="#222" points="900 600 990 450 810 450"></polygon>
                                                <polygon fill="#DDD" points="0 900 90 750 -90 750"></polygon>
                                                <polygon fill="#444" points="180 900 270 750 90 750"></polygon>
                                                <polygon fill="#FFF" points="360 900 450 750 270 750"></polygon>
                                                <polygon fill="#AAA" points="540 900 630 750 450 750"></polygon>
                                                <polygon fill="#FFF" points="720 900 810 750 630 750"></polygon>
                                                <polygon fill="#222" points="900 900 990 750 810 750"></polygon>
                                                <polygon fill="#222" points="1080 300 990 450 1170 450"></polygon>
                                                <polygon fill="#FFF" points="1080 300 1170 150 990 150"></polygon>
                                                <polygon points="1080 600 990 750 1170 750"></polygon>
                                                <polygon fill="#666" points="1080 600 1170 450 990 450"></polygon>
                                                <polygon fill="#DDD" points="1080 900 1170 750 990 750"></polygon>
                                            </g>
                                        </pattern>
                                    </defs>
                                    <rect x="0" y="0" fill="url(#a)" width="100%" height="100%"></rect>
                                    <rect x="0" y="0" fill="url(#b)" width="100%" height="100%"></rect>
                                </svg>
                            </div>
                            <div class="card__avatar">
                                <a class="image-container">
                                    <img src="bd/<?php echo $usuario['foto']; ?>" class="img-fluid rounded-start" alt="Foto de perfil" width="100px">
                                </a>
                                <button type="button" class="btn btn-outline-dark" id="btn-subirImg" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <dfn title="Nueva foto de perfil.">
                                        <i class="bi bi-upload"></i>
                                    </dfn>
                                </button>
                            </div>
                            <div class="card__title">
                                <h5 class="card-title"><?php echo $usuario['nombre']; ?></h5>
                            </div>
                            <div class="card__subtitle mb-4 text-center">
                                <p class="card-text"><?php echo $usuario['descripcion']; ?></p>
                                <a href="" class="text-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    Editar descripcion
                                </a>
                            </div>
                            <div class="container mb-5">
                                <div class="row">
                                    <div class="col-12 col-md-6 text-center">
                                        <p>Logros Obtenidos</p>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="formGroupExampleInput" class="form-label">Buscar usuarios</label>
                                                <input type="text" class="form-control" id="buscarUsuarios" placeholder="Ingresa el nombre de Usuario" aria-label="First name">
                                            </div>
                                            <div class="col-12">
                                                <ul class="list-group" id="listaUsuarios">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>  -->
                </div>
            </div>
        </div>
    </section>

    <section id="modales">
        <div class="modal-foto-de-perfil">

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="formSubirImagen" action="bd/subirImagen.php" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="accion" value="btn-subirImg">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="staticBackdropLabel">Nueva foto de perfil.</h3>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="inputImagen" class="form-label">Seleccione una imagen.</label>
                                    <input class="form-control" type="file" name="foto" required>
                                </div>
                                <p><b>Nota:</b> La imagen se subirá con un ancho de 250px y no debe pesar más de 50 MB.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#MiPerfil">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-descripcion">

            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="staticBackdropLabel">Cambiar descripción.</h3>

                        </div>
                        <form id="descripcionForm" action="bd/subirImagen.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="accion" value="btn-descripcion">
                            <div class="modal-body">
                                <p><b>Nota:</b> La descripción no debe rebasar los 100 caracteres.</p>

                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción:</label>
                                    <textarea type="text" class="form-control" id="descripcion" name="descripcion" maxlength="100" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#MiPerfil">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error === "en-foto") {
                echo '
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Algo salio mal, vuelva a intentarlo mas tarde."
                            });
                        </script>
                    ';
            } else if ($error === 'archivoErroneo') {
                echo '
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Formato incorrecto.",
                                text: "Asegurate de seleccionar una imagen con el formato correcto (png, jpg, jpeg)."
                            });
                        </script>
                    ';
            } else if ($error === 'archivoPesado') {
                echo '
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Imagen muy pesada.",
                                text: "Asegurate de seleccionar una imagen que no rebase los 50 MB."
                            });
                        </script>
                    ';
            } else if ($error === 'descripcion_prohibida') {
                echo '
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "Descrpición ofensiva.",
                                text: "Evite poner palabras ofensivas en la descripción."
                            });
                        </script>
                    ';
            }
        } else if (isset($_GET['exito'])) {
            $exito = $_GET['exito'];
            if ($exito === "en-foto") {
                echo '
                        <script>
                            Swal.fire({
                                icon: "success",
                                title: "Foto subida con exito.",
                                text: "Puedes verla entrando nuevamente a tu perfil."
                            });
                        </script>
                    ';
            } else if ($exito === 'descripcionExitosa') {
                echo '
                        <script>
                            Swal.fire({
                                icon: "success",
                                title: "Descripción aceptada.",
                                text: "Puedes verla entrando nuevamente a tu perfil."
                            });
                        </script>
                    ';
            }
        }
        ?>
    </section>

    <section id="manual">
        <div class="container">
            <h1>Manual de usuario.</h1>
            <h5>Descarga nustro manual.</h5>
            <div class="container manual-contenedor ">
                <div class="container">
                    <div class="row">
                        <!-- <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-secondary" id="m1">
                                <i class="bi bi-journal-arrow-down"></i>
                                Manual de instalación.
                            </button>
                        </div> -->
                        <div class="col-12 col-md-6">
                            <button type="button" class="btn btn-secondary" id="m2">
                                <i class="bi bi-journal-arrow-down"></i>
                                Manual de usuario.
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="galeria">
        <div class="container">
            <h1>Galería de fotos.</h1>
            <div class="container galeria-contenedor ">
                <div class="icono text-center">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h2 class="text-center">Sección <br> En construcción...</h2>
                <p class="text-center">Estamos trabajando en ello. </p>
                <div class="text-center">
                    <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer id="creditos">
        <div class="container">
            <div class="text-center m-5">
                <h3>Equipo de trabajo.</h3>
            </div>
            <div class="container d-flex footer-contenedor">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card equipo">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-top icono-footer text-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Autor 1</h5>
                                <p class="card-text">Eidal Marquez Ambrosio.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card equipo">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-top icono-footer text-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Autor 2</h5>
                                <p class="card-text">Maia Michelle Morales Ramíres.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card equipo">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-top icono-footer text-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Asesor técnico</h5>
                                <p class="card-text">Roberto Ruiz Mendoza.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card equipo">
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-top icono-footer text-center">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Asesor metodológico</h5>
                                <p class="card-text">Elva Yuridia Morales Luis.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="assets/imagenes/logoOrtographic.webp" alt="Logo Ortographic" class="footer-icono">
            </div>
        </div>
        <div class="derechos-autor text-center">© 2023 Copyright DGETI - CBTis No. 150.</div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        //aqui la alerta y verificcion
        document.getElementById('boton_practicar').addEventListener('click', function(event) {
            event.preventDefault();

            <?php if (isset($_SESSION['usuario'])) { ?>
                // Si la sesión está iniciada, redirige a la página de selección de sala
                window.location.href = "selecionar_sala.php";
            <?php } else { ?>
                // Si la sesión no está iniciada, muestra una alerta
                Swal.fire({
                    icon: "info",
                    title: "Inicia sesión",
                    text: "Debes iniciar sesión para tener una mejor experiencia del juego."
                }).then(() => {
                    window.location.href = 'inicio_sesion.php';
                });
            <?php } ?>
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>