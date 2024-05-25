<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - Donde las letras se vuelven tu juego.</title>
</head>

<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido a Ortographic</h2>
                <p>Regístrate para poder poner en práctica tu ortografía.</p>
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error === "usuario_no_encontrado") {
                        echo '
                            <div class="alert alert-danger " role="alert" style="height: 30px">
                                <p>Usuario y/o contraseña incorrecta!</p>
                            </div>
                        ';
                    }
                } else if (isset($_GET['responce'])) {
                    $error = $_GET['responce'];
                    if ($error === "usuario-existente") {
                        echo '
                            <div class="alert alert-warning" role="alert" style="height: 30px">
                                <p>El usuario ya existe!</p>
                            </div>
                        ';
                    } else if ($error === "registro-exitoso") {
                        echo '
                            <div class="alert alert-success " role="alert" style="height: 30px">
                                <p>Registro exitoso!</p>
                            </div>
                        ';
                    } else if ($error === "error") {
                        echo '
                            <div class="alert alert-danger" role="alert" style="height: 30px">
                                <p>Algo salio mal!</p>
                            </div>
                        ';
                    }
                }
                ?>
                <input type="button" value="Iniciar Sesión" id="sign-in">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>
                
                <!-- <p>Regístrate para poder poner en práctica tu ortografía.</p> -->
                <form class="form form-register" action="bd/login_usuario.php" method="POST" novalidate>
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" placeholder="Nombre de usuario" name="usuario" id="user">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" placeholder="Correo electrónico" name="correo" id="correo">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="contrasena" id="con1">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Confirmar contraseña" name="contrasena2" id="con2">
                        </label>
                        <span id="con1" class="form-text" style="font-size: 12px;">Al menos 8 caracteres.</span>
                    </div>

                    <input type="hidden" name="accion" value="btn-registro">
                    <input type="submit" value="Registrarse" id="boton-reg" disabled>

                </form>
            </div>
        </div>
    </div>


    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para unirte a nuestra comunidad por favor Inicia Sesión con tus datos</p>
                <input type="button" value="Registrarse" id="sign-up">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <!-- <p>o Iniciar Sesión con una cuenta</p> -->
                <form class="form form-login" novalidate action="bd/login_usuario.php" method="POST">
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="text" placeholder="Nombre de usuario" name="usuario">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" placeholder="Contraseña" name="contrasena">
                        </label>
                    </div>


                    <input type="hidden" name="accion" value="btn-login">
                    <input type="submit" value="Iniciar Sesión">

                </form>
            </div>
        </div>
    </div>
    ¿
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/registro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>