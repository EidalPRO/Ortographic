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
    <?php
    include 'bd/conexion_be.php';
    // Verifica si el parámetro 'id' está presente en la URL
    if (isset($_GET['id'])) {
        // Obtiene el ID del usuario de la URL y lo limpia para evitar inyección de SQL
        $usuarioID = mysqli_real_escape_string($conexion, $_GET['id']);

        // Realiza una consulta para obtener la información del usuario utilizando el ID
        $sql = "SELECT * FROM Usuarios WHERE id_usuario = '$usuarioID'";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
        } else {
            echo "Usuario no encontrado";
        }
    } else {
        echo "ID de usuario no proporcionado";
    }
    ?>

    <a class="cta" href="index.php">
        <span>Regresar</span>
        <svg width="15px" height="10px" viewBox="0 0 13 10">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
        </svg>
    </a>
    <section class="tu-perfil">
        <div class="container">
            <div class="card">
                <div class="card__img"><svg xmlns="http://www.w3.org/2000/svg" width="100%">
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
                    </svg></div>
                <div class="card__avatar">
                    <a class="image-container">
                        <img src="bd/<?php echo $usuario['foto']; ?>" class="img-fluid rounded-start" alt="Foto de perfil" width="100px">
                    </a>
                </div>
                <div class="card__title">
                    <h5 class="card-title"><?php echo $usuario['nombre']; ?></h5>
                </div>
                <div class="card__subtitle">
                    <p class="card-text"><?php echo $usuario['descripcion']; ?></p>
                </div>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>