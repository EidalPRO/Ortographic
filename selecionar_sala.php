<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/salas2.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - Donde las letras se vuelven tu juego.</title>
</head>

<body>

    <div class="container modo-contenedor d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Seleccione el modo de juego.</h3>
                </div>
                <div class="col-12 col-md-4">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="submit" id="boton_global" href="bd/salas.php">
                            <i class="bi bi-controller"></i>
                        </a>
                    </div>
                    <p>Sala global</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="boton_privado">
                            <i class="bi bi-joystick"></i>
                        </a>
                    </div>
                    <p>Salas privadas</p>
                </div>
                <div class="col-12 col-md-4">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="submit" href="index.php">
                            <i class="bi bi-box-arrow-left"></i>
                        </a>
                    </div>
                    <p>Regresar</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tools">
                        <div class="circle">
                            <span class="red box"></span>
                        </div>
                        <div class="circle">
                            <span class="yellow box"></span>
                        </div>
                        <div class="circle">
                            <span class="green box"></span>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <h3 class="modal-title fs-5" id="staticBackdropLabel">Salas privadas</h3>
                            <h5>Disfruta jugando en una sala privada con tus amigos, puedes crear una sala privada o unirte a una utilizando su id.</h5>
                            <br>
                            <div class="col-12 col-lg-6">
                                <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" id="ing" href="">
                                        <i class="bi bi-cloud-plus"></i>
                                    </a>
                                </div>
                                <p>Crear una sala</p>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="col-12 col-lg-6">
                                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                                        <a type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" id="exis" href="">
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </a>
                                    </div>
                                    <p>Ingresar a una sala existente</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <span class="circle1"></span>
                        <span class="circle2"></span>
                        <span class="circle3"></span>
                        <span class="circle4"></span>
                        <span class="circle5"></span>
                        <span class="text">Regresar</span>
                    </button>
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tools">
                        <div class="circle">
                            <span class="red box"></span>
                        </div>
                        <div class="circle">
                            <span class="yellow box"></span>
                        </div>
                        <div class="circle">
                            <span class="green box"></span>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Sala nueva</h3>

                    <h4 class="mt-3" id="id-sala">Código de la nueva sala: </h4>
                    <span>El código se vuelve único en el momento de la creación de la sala.</span>

                    <form action="bd/salas.php" method="post" enctype="multipart/form-data" class="mt-5" id="formulario">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre de la sala:</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sala">
                        </div>

                        <div class="mb-3">
                            <label for="dificultad">Selecciona las dificultades que quieres para esta sala:</label>
                            <div>
                                <input type="checkbox" id="facil" name="dificultad1" value="Facil">
                                <label for="facil">Fácil</label>
                            </div>
                            <div>
                                <input type="checkbox" id="medio" name="dificultad2" value="Medio">
                                <label for="medio">Medio</label>
                            </div>
                            <div>
                                <input type="checkbox" id="dificil" name="dificultad3" value="Dificil">
                                <label for="dificil">Difícil</label>
                            </div>
                        </div>
                        <input type="hidden" name="accion" value="nuevo">
                        <input type="hidden" name="codigo" value="" id="codigo_sala">

                        <button type="submit" class="btn btn-primary" id="btn-submit"><span class="circle1"></span>
                            <span class="circle2"></span>
                            <span class="circle3"></span>
                            <span class="circle4"></span>
                            <span class="circle5"></span>
                            <span class="text">Aceptar</span>
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <span class="circle1"></span>
                        <span class="circle2"></span>
                        <span class="circle3"></span>
                        <span class="circle4"></span>
                        <span class="circle5"></span>
                        <span class="text">Cancelar</span>
                    </button>
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="tools">
                        <div class="circle">
                            <span class="red box"></span>
                        </div>
                        <div class="circle">
                            <span class="yellow box"></span>
                        </div>
                        <div class="circle">
                            <span class="green box"></span>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <h3 class="modal-title fs-5" id="staticBackdropLabel">Sala existente</h3>
                    <h5>Ingresa el id de la sala</h5>
                    <form action="bd/salas.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <!-- <label for="exampleInputEmail1" class="form-label">Email address</label> -->
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sala">
                        </div>
                        <button type="submit" class="btn btn-primary"><span class="circle1"></span>
                            <span class="circle2"></span>
                            <span class="circle3"></span>
                            <span class="circle4"></span>
                            <span class="circle5"></span>
                            <span class="text">Aceptar</span>
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <span class="circle1"></span>
                        <span class="circle2"></span>
                        <span class="circle3"></span>
                        <span class="circle4"></span>
                        <span class="circle5"></span>
                        <span class="text">Cancelar</span>
                    </button>
                    <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error === "sala_no_encontrada") {
            echo '
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Parece que la sala no existe, verifica que el id sea correcto y intentalo de nuevo."
                         });
                    </script>
                ';
        } else if ($error === 'sala_existente') {
            echo '
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Este código de sala ya existe intente de nuevo."
                         });
                    </script>
                ';
        }
    }
    ?>

    <script src="assets/js/sala.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>