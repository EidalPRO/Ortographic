<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!--CSS-->
    <link rel="stylesheet" href="assets/css/tema.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - ¿Crees tener buena ortografía?</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light">
        <div class="container-fluid">
            <h6>Seleccione el tema a practicar</h6>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-toggler">
                <a class="navbar-brand" href="">
                    <img src="assets/imagenes/logoOrtographic.webp" width="50" alt="Logo Ortographic">
                </a>
                <ul class="navbar-nav d-flex justify-content-center align-items-center">
                    <li class="nav-item">
                        <button class="nav-link active queestion" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-question-circle"></i></button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="" id="sala">Sala: </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estadisticas.php">Estadisticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true" href="selecionar_sala.php">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="temas">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t1">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen4.jpeg" class="img-fluid" alt="Acentuación">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Acentuación.</h5>
                                    <p class="card-text">Uso de tildes para palabras agudas, graves y esdrújulas según
                                        las normativas específicas del idioma.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t2">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen6.jpeg" class="img-fluid" alt="Puntuación">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Uso de letras.</h5>
                                    <p class="card-text">Normas para el uso adecuado de las letras, como la grafía
                                        correcta de las palabras, uso de mayúsculas y minúsculas, etc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t3">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen2.jpeg" class="img-fluid" alt="Uso de letras">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Concordancia.</h5>
                                    <p class="card-text">Se trata de los errores de concordancia entre sustantivos y adjetivos, sujetos y predicados, así como entre género y número.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card" style="max-width: 500px;" id="t4">
                        <div class="row cartas-contenedor ">
                            <div class="col-4 imagen-carta">
                                <img src="assets/imagenes/temas/imagen5.jpeg" class="img-fluid" alt="Gramatica">
                            </div>
                            <div class="col-8 cuerpo-carta">
                                <div class="card-body carta">
                                    <h5 class="card-title">Gramatica en general.</h5>
                                    <p class="card-text">El uso de palabras inexistentes o mal escritas puede
                                        clasificarse como errores ortográficos o gramaticales dependiendo del contexto
                                        específico en el que se cometan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="modales">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <h4 class="modal-title fs-5" id="exampleModalLabel">Acerca de</h4>
                        <p>
                            Para comenzar a jugar, selecciona uno de los cuatro temas disponibles para practicar. Luego, elige la dificultad con la que deseas enfrentarte. <br>
                            El porcentaje de efectividad se calculará en función de las respuestas correctas que des en cada tema y en cada una de sus tres diferentes dificultades. Al completar los tres niveles (fácil, medio y difícil) de un tema, el porcentaje de efectividad de ese tema será del 100%.
                            <br><br>
                            ¡Diviértete aprendiendo!
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                            <span class="circle1"></span>
                            <span class="circle2"></span>
                            <span class="circle3"></span>
                            <span class="circle4"></span>
                            <span class="circle5"></span>
                            <span class="text">Cerrar</span>
                        </button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/estaditicas.js"></script>
    <script>
        t1.addEventListener("click", function() {
            mostrarDificultad('t1');
        });

        t2.addEventListener("click", function() {
            mostrarDificultad('t2');
        });

        t3.addEventListener("click", function() {
            mostrarDificultad('t3');
        });

        t4.addEventListener("click", function() {
            mostrarDificultad('t4');
        });

        function mostrarDificultad(tema) {
            Swal.fire({
                title: 'Selecciona la dificultad',
                input: 'select',
                inputOptions: {
                    'facil': 'Fácil',
                    'medio': 'Medio',
                    'dificil': 'Difícil'
                },
                inputPlaceholder: 'Selecciona una opción',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value !== '') {
                            resolve()
                        } else {
                            resolve('Debes seleccionar una opción')
                        }
                    })
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.setItem('tema', tema);
                    localStorage.setItem('dificultad', result.value); // Guardar la dificultad seleccionada en localStorage
                    window.location.href = "juego.php";
                }
            })
        }

        // Función para obtener parámetros de la URL
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        // Obtener los valores de los parámetros de la URL
        var codigo = getParameterByName('codigoSala');
        var ronda = getParameterByName('ronda');
        var logro = getParameterByName('logro');

        if (codigo !== null) {
            localStorage.setItem('codigoSala', codigo);
        } else {
            codigo = localStorage.getItem('codigoSala');
        }

        console.log(codigo)
        console.log(logro)
        var logroObtenido;

        // Llamar a la función en estadisticas.js pasando los valores de los parámetros
        if ((ronda !== null) && (logro !== null)) {
            enviarDatos();
        }

        function enviarDatos() {
            const datos = {
                tema: logro,
                codigo: codigo
            };

            const opciones = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            };

            fetch('bd/obtenerLogros.php', opciones)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        logroObtenido = data.logro;
                        console.log(`El logro ${logroObtenido} se actualizó correctamente.`);
                        // Hacer algo con el logro obtenido
                    } else {
                        console.error('Error al actualizar el logro.', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // console.log('Ronda:', ronda);
        // console.log('Logro:', logro);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>