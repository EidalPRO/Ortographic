document.addEventListener("DOMContentLoaded", function () {
    const contrasena1 = document.getElementById('exampleInputPassword1');
    const contrasena2 = document.getElementById('exampleInputPassword2');
    const botonAceptar = document.getElementById('boton-reg');

    function verificarContrasenas() {
        if (contrasena1.value !== '' || contrasena2.value !== '') {
            if (contrasena1.value !== contrasena2.value) {
                contrasena1.style.borderColor = 'red';
                contrasena2.style.borderColor = 'red';
                botonAceptar.disabled = true;
            } else {
                contrasena1.style.borderColor = 'green';
                contrasena2.style.borderColor = 'green';
                botonAceptar.disabled = false;
            }
        } else {
            contrasena1.style.borderColor = '';
            contrasena2.style.borderColor = '';
            botonAceptar.disabled = true;
        }
    }

    // Verificación inicial al cargar la página
    verificarContrasenas();

    // Event listeners para verificar mientras se escriben las contraseñas
    contrasena1.addEventListener('input', verificarContrasenas);
    contrasena2.addEventListener('input', verificarContrasenas);
});
