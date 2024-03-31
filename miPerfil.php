
<?php
    session_start();
    include 'bd/conexion_be.php';

    if(!isset($_SESSION['usuario'])) {
        header("location: index.php");
    }

    // nombre de usuario de la sesión
    $nombreUsuario = $_SESSION['usuario'];

    // información del usuario
    $queryUsuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombre = '$nombreUsuario'");
    $usuario = mysqli_fetch_assoc($queryUsuario);

$conexion->close();
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
        <link rel="stylesheet" href="assets/css/miPerfil.css">
        <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
        <title>Ortographic - Donde las letras se vuelven tu juego.</title>
    </head>
<body>
    

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <a class="navbar-brand" href="">
                    <img src="assets/imagenes/logoOrtographic.webp" width="50" alt="Logo Ortographic">
                </a>
                <ul class="navbar-nav d-flex justify-content-center align-items-center">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="">Estadisticas</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true" href="index.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="miPerfil">
        <div class="container">
            <div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4">
                    <a>
                        <img src="bd/<?php echo $usuario['foto']; ?>" class="img-fluid rounded-start" alt="Foto de perfil">
                    <a/>
                    <button type="button" class="btn btn-outline-dark" id="btn-subirImg" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <!--este es el boton para abirir el modal -->
                        <i class="bi bi-upload"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="formSubirImagen" action="bd/subirImagen.php" method="post" enctype="multipart/form-data"> 
                                    <!-- Campo oculto para enviar el parámetro adicional -->
                                    <input type="hidden" name="accion" value="btn-subirImg">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5" id="exampleModalLabel">Nueva foto de perfil.</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="inputImagen" class="form-label">Seleccione una imagen.</label>
                                            <input class="form-control" type="file" name="foto" required>
                                        </div>
                                        <p><b>Nota:</b> La imagen se subirá con un ancho de 250px y no debe pesar más de 50 MB.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Subir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-12 ">
                    <div class="card-body">
                      <h4>Nombre de usuario. </h4>
                      <br>
                      <h4 class="card-title"><?php echo $usuario['nombre']; ?></h4>
                      <p class="card-text"><?php echo $usuario['descripcion']; ?></p>
                      <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                      <div class="botdes">
                          <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            Editar descripción
                          </button>
                      </div>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="staticBackdropLabel">Ingrese una descripcion.</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="descripcionForm" action="bd/subirImagen.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="accion" value="btn-descripcion">
                                        <div class="modal-body">
                                            <p><b>Nota:</b> La descripción no debe rebasar los 100 caracteres.</p>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción:</label>
                                                <textarea type="text" class="form-control" id="descripcion" name="descripcion" maxlength="100" required></textarea>
                                            </div>
                                            <!-- Mensaje de error para mostrar cuando se encuentran palabras prohibidas -->
                                            <div id="errorDescripcion" class="text-danger"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Aceptar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                       </div>
                       <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                if ($error === "descripcion_prohibida") {
                                    echo '
                                        <br>
                                        <div class="alert alert-danger" role="alert">
                                            Evite poner palabras ofencivas!
                                        </div>
                                    ';
                                }
                            }
                            // } else if (isset($_GET['exito'])) {
                            //     $exito = $_GET['exito'];
                            //     if ($exito === "todo_bien") {
                            //         echo '
                            //             <div class="alert alert-danger" role="alert">
                            //                 TodoBIen!
                            //             </div>
                            //         ';
                            //     }
                            // }
                        ?>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <!-- logros -->
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
                                <!-- La lista de usuarios se mostrará aquí -->
                            </ul>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
    <script src="assets/js/miPerfil.js"></script>
</body>
</html>