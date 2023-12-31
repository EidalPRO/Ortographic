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
    <link rel="stylesheet" href="assets/css/salas2.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <div class="container modo-contenedor d-flex">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Seleccione el modo de juego.</h3>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="submit" id="boton_global" href="bd/salas.php">
                            <i class="bi bi-controller"></i>
                        </a>
                    </div>
                    <p>Sala global</p>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cir d-flex flex-wrap align-items-center justify-content-center">
                        <a type="submit" id="boton_privado" href="">
                            <i class="bi bi-joystick"></i>
                        </a>
                    </div>
                    <p>Salas privadas</p>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

        localStorage.setItem('codigoSala', A0123);
        // document.getElementById('boton_global').addEventListener('click', function (event) {
        //     event.preventDefault();

        //     localStorage.setItem('codigoSala', A0123);
        // });

        //Esto se podra ocupar al implementar las salas privadas
        // // Obtener el valor del código de sala del formulario
        // const codigoSala = document.getElementById('salaCod').value.trim();
        // // Almacenar el código de sala en el Local Storage
        // localStorage.setItem('codigoSala', codigoSala);
    </script>
    <script>
         document.getElementById('boton_privado').addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                icon: "info",
                title: "Lo sentimos :(",
                text: "Por el momento solo contamos con una sala global, estamos trabajando en ello."
            }); //.then(() => {
            //     window.location.href = 'inicio_sesion.php';
            // });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>