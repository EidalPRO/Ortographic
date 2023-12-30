
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
    <link rel="stylesheet" href="assets/css/index2.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>
    
    <div class="hero">
        <div class="container-fluid text-center img-contenedor">
            <img src="assets/imagenes/hero-orto.webp" class="img-fluid" alt="Ortographic">
        </div>
        <h1 class="text-center">Ortographic</h1>
        <p class="text-center">¿Crees tener buena ortografía?</p>
    </div>

    <section class="navegacion">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <?php
                        session_start();
                        if (isset($_SESSION['usuario'])) {
                            echo '<a href="">
                                    <i class="bi bi-person"></i>
                                </a>';
                        } else {
                            echo '<a href="sesion_inicio.php"><i class="bi bi-person-check"></i></a>';
                        }
                        ?>
                    </div>
                    <?php if (!isset($_SESSION['usuario'])) { ?>
                     <p>Iniciar sesión</p>
                    <?php } else { ?>
                        <p><?php echo $_SESSION['usuario']; ?></p>
                    <?php } ?>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <?php if (!isset($_SESSION['usuario'])) { ?>
                        <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                            <a href="registro_usuario.html">
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
                <!-- <div class="col-6 col-md-4 col-lg-2">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a href="">
                            <i class="bi bi-joystick"></i>
                        </a>
                    </div>
                    <p>Salas privadas</p>
                </div> -->
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

    <section id="manual">
        <div class="container">
            <h1>Manuales de usuario.</h1>
            <div class="container manual-contenedor ">
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
                                <h5 class="card-title">Autor 3</h5>
                                <p class="card-text">Yazmím Maldonado López.</p>
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
                                <p class="card-text">Elva Yuridia Morales Luis.</p>
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
                                <p class="card-text">Roberto Ruiz Mendoza.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        //aqui la alerta y verificcion
        document.getElementById('boton_practicar').addEventListener('click', function (event) {
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
                window.location.href = 'sesion_inicio.php';
            });
        <?php } ?>
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>