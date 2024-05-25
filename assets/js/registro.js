document.addEventListener("DOMContentLoaded", function () {
    const contrasena1 = document.getElementById('con1');
    const contrasena2 = document.getElementById('con2');
    const botonAceptar = document.getElementById('boton-reg');
    const user = document.getElementById('user');
    const correo = document.getElementById('correo');

    function verificarContrasenas() {
        if (contrasena1.value !== '' || contrasena2.value !== '') {
            if (contrasena1.value.length >= 8 && contrasena1.value === contrasena2.value) {
                contrasena1.style.backgroundColor = '#00ff2223';
                contrasena2.style.backgroundColor = '#00ff2223';
                if (user.value !== '' && correo.value !== '') {
                    botonAceptar.disabled = false;
                }
            } else {
                contrasena1.style.backgroundColor = '#ff000042';
                contrasena2.style.backgroundColor = '#ff000042';
                botonAceptar.disabled = true;
            }
        } else {
            contrasena1.style.backgroundColor = '';
            contrasena2.style.backgroundColor = '';
            botonAceptar.disabled = true;
        }
    }

    // Verificación inicial al cargar la página
    verificarContrasenas();

    // Event listeners para verificar mientras se escriben las contraseñas
    contrasena1.addEventListener('input', verificarContrasenas);
    contrasena2.addEventListener('input', verificarContrasenas);
    user.addEventListener('input', verificarContrasenas);
    correo.addEventListener('input', verificarContrasenas);
});

const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});