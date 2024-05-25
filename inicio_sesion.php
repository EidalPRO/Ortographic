<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/login2.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <title>Ortographic - Donde las letras se vuelven tu juego.</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="bd/login_usuario.php" method="POST" class="formulario">
                <h3>Nueva cuenta</h3>
                <!-- <span>or use your email for registeration</span> -->
                <input type="text" placeholder="Nombre de usuario" name="usuario" id="user">
                <input type="email" placeholder="Correo electronico" name="correo" id="correo">
                <input type="password" placeholder="Contraseña" name="contrasena" id="con1">
                <input type="password" placeholder="Confirmar contraseña" name="contrasena2" id="con2">
                <span id="con1" class="form-text" style="font-size: 18px;">
                    Al menos 8 caracteres.
                </span>
                <input type="hidden" name="accion" value="btn-registro">
                <button id="boton-reg" disabled>Registrarse</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="bd/login_usuario.php" method="POST">
                <h3>Iniciar sesión</h3>
                <!-- <span>or use your email password</span> -->
                <input type="text" placeholder="Nombre de usuario" name="usuario">
                <input type="password" placeholder="Contraseña" name="contrasena">
                <input type="hidden" name="accion" value="btn-login">
                <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error === "usuario_no_encontrado") {
                        echo '
                            <div class="alert alert-danger" role="alert">
                                <p>Usuario y/o contraseña incorrecta!</p>
                            </div>
                        ';
                    }
                } else if (isset($_GET['responce'])) {
                    $error = $_GET['responce'];
                    if ($error === "usuario-existente") {
                        echo '
                            <div class="alert alert-warning" role="alert">
                                <p>El usuario ya existe!</p>
                            </div>
                        ';
                    } else if ($error === "registro-exitoso") {
                        echo '
                            <div class="alert alert-success" role="alert">
                                <p>Registro exitoso!</p>
                            </div>
                        ';
                    } else if ($error === "error") {
                        echo '
                            <div class="alert alert-danger" role="alert">
                                <p>Algo salio mal!</p>
                            </div>
                        ';
                    }
                }
                ?>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button>Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h3>Bienvenido a Ortographic!</h3>
                    <p>Registrate para poder poner en practica tu ortografía.</p>
                    <button class="hidden" id="login">Iniciar sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h3>Bienvenido de vuelta!</h3>
                    <p>Inicia sesión para poder poner en practica tu ortografía.</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/registro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>