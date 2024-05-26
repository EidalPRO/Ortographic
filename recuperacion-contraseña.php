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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--CSS-->
    <link rel="stylesheet" href="assets/css/recupera.css">
    <link rel="shortcut icon" href="assets/imagenes/logoOrtographic.webp" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Ortographic - Recuperar contraseña.</title>
</head>

<body>
    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    include 'bd/conexion_be.php';

    $usuario = null;
    $id;

    // Código de ahut0: dev-8vexa1obtiqt2r3z

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtener el correo electrónico ingresado por el usuario
        $correo = $_POST["email"];

        // Consulta preparada para evitar la inyección SQL
        $obtenerCorreo = $conexion->prepare("SELECT id_usuario, nombre, correo FROM usuarios WHERE correo = ?");
        $obtenerCorreo->bind_param("s", $correo);
        $obtenerCorreo->execute();
        $resultado = $obtenerCorreo->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $usuario = $fila['nombre'];
            $id = $fila['id_usuario'];
            // Generar un código de verificación de 5 caracteres (mayúsculas y números)
            $caracteres = 'ABCDEPRSVX0123456789';
            $codigo = substr(str_shuffle($caracteres), 0, 5);

            $guardarCodigo = $conexion->prepare("UPDATE usuarios SET codigo = ? WHERE correo = ? AND nombre = ?");
            $guardarCodigo->bind_param("sss", $codigo, $correo, $usuario);
            $guardarCodigo->execute();

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp-mail.outlook.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'soporte.ortographic@outlook.com';
                $mail->Password   = 'Ortographic27';
                $mail->Port       = 587;
                $mail->setFrom('soporte.ortographic@outlook.com', 'Soporte técnico de Ortographic');
                $mail->addAddress($correo, $usuario);
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body    = 'Hola, este es tu código de recuperación generado para la recuperación de tu contraseña: <br><br>' . $codigo . '. Por favor, ingresa el código en la página de <a href="localhost/ortographic/recuperacion-contraseña.php?id=' . $usuario . '">Recuperación de contraseña</a>';
                $mail->send();
                // echo 'Mensaje enviado';
                header("Location: recuperacion-contraseña.php?id=$usuario");
                exit();
            } catch (Exception $e) {
                echo "No se pudo enviar el mensaje. Error del correo: {$mail->ErrorInfo}";
            }
        } else {
            echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Correo electrónico no válido.",
                                text: "No se encontró ningún usuario registrado con ese correo electrónico.",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "inicio_sesion.php";
                                }
                            });
                        </script>';
            exit();
        }
    }

    ?>


    <div class="container">
        <div class="popup">
            <form class="form" action="bd/nueva-contraseña.php" method="POST">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 34 34" height="34" width="34">
                        <path stroke-linejoin="round" stroke-width="2.5" stroke="#115DFC" d="M7.08385 9.91666L5.3572 11.0677C4.11945 11.8929 3.50056 12.3055 3.16517 12.9347C2.82977 13.564 2.83226 14.3035 2.83722 15.7825C2.84322 17.5631 2.85976 19.3774 2.90559 21.2133C3.01431 25.569 3.06868 27.7468 4.67008 29.3482C6.27148 30.9498 8.47873 31.0049 12.8932 31.1152C15.6396 31.1838 18.3616 31.1838 21.1078 31.1152C25.5224 31.0049 27.7296 30.9498 29.331 29.3482C30.9324 27.7468 30.9868 25.569 31.0954 21.2133C31.1413 19.3774 31.1578 17.5631 31.1639 15.7825C31.1688 14.3035 31.1712 13.564 30.8359 12.9347C30.5004 12.3055 29.8816 11.8929 28.6437 11.0677L26.9171 9.91666"></path>
                        <path stroke-linejoin="round" stroke-width="2.5" stroke="#115DFC" d="M2.83331 14.1667L12.6268 20.0427C14.7574 21.3211 15.8227 21.9603 17 21.9603C18.1772 21.9603 19.2426 21.3211 21.3732 20.0427L31.1666 14.1667"></path>
                        <path stroke-width="2.5" stroke="#115DFC" d="M7.08331 17V8.50001C7.08331 5.82872 7.08331 4.49307 7.91318 3.66321C8.74304 2.83334 10.0787 2.83334 12.75 2.83334H21.25C23.9212 2.83334 25.2569 2.83334 26.0868 3.66321C26.9166 4.49307 26.9166 5.82872 26.9166 8.50001V17"></path>
                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" stroke="#115DFC" d="M14.1667 14.1667H19.8334M14.1667 8.5H19.8334"></path>
                    </svg>
                </div>
                <div class="note">
                    <label class="title">Ingresa el código de verificación</label>
                    <span class="subtitle">Se envio un correo al correo que proporcionaste al regisrtrarte. <br>
                        Revisa tu Correo Electronico o si no lo encuentras en recibidos, verifica en el apartado de SPAM</span>
                </div>

                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="text" name="contrasena" placeholder="Nueva contraseña" required class="input_field" id="con1">
                <input placeholder="Ingresa el código" title="Ingresa el código" name="codigo" type="text" class="input_field" required>
                <?php
                if (isset($_GET['respuesta'])) {




                    switch ($_GET['respuesta']) {
                        case 'codigo-invalido':
                            echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Código no válido.",
                                    text: "El código ingresado no es valido o esta vencido.",
                                });
                            </script>';
                            break;
                        case 'exito':
                            echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Contraseña cambiada con exito.",
                                text: "La contraseña se cambio exitosamente, inicia sesión con tu nueva contraseña.",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "inicio_sesion.php";
                                }
                            });
                        </script>';
                            break;

                        case 'error-consulta':
                            echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Algo salío mal.",
                                text: "Intentalo nuevamente.",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "inicio_sesion.php";
                                }
                            });
                        </script>';
                            break;
                    }
                }
                ?>

                <span>Minimo 8 caracteres</span>
                <button class="submit" id="btn" disabled>Aceptar</button>
                <a href="inicio_sesion.php" class="text-center">Regresar</a>
            </form>
        </div>
    </div>


    <script>
        const botonAceptar = document.getElementById('btn');
        const contrasena1 = document.getElementById('con1');

        function verificarContrasenas() {
            if (contrasena1.value !== '') {
                if (contrasena1.value.length >= 8) {
                    contrasena1.style.backgroundColor = 'rgba(0, 255, 0, 0.2)'; // Verde con opacidad reducida
                    botonAceptar.disabled = false;
                } else {
                    contrasena1.style.backgroundColor = 'rgba(255, 0, 0, 0.2)'; // Rojo con opacidad reducida
                    botonAceptar.disabled = true;
                }
            } else {
                contrasena1.style.backgroundColor = ''; // Restablecer el color de fondo
                botonAceptar.disabled = true;
            }
        }

        verificarContrasenas();

        contrasena1.addEventListener('input', verificarContrasenas);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>