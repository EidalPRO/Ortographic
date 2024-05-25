document.addEventListener("DOMContentLoaded", function () {
    const contrasena1 = document.getElementById('con1');
    const contrasena2 = document.getElementById('con2');
    const botonAceptar = document.getElementById('boton-reg');
    const user = document.getElementById('user');
    const correo = document.getElementById('correo');

    function verificarContrasenas() {
        if (contrasena1.value !== '' || contrasena2.value !== '') {
            if (contrasena1.value.length >= 8) {
                contrasena1.style.color = 'green';
            } else {
                contrasena1.style.color = 'red';
            }
            if (contrasena1.value === contrasena2.value) {
                contrasena2.style.color = 'green';
                if (user.value !== '' && correo.value !== '') {
                    botonAceptar.disabled = false;
                }
            } else {
                contrasena2.style.color = 'red';
                botonAceptar.disabled = true;
            }
        } else {
            contrasena1.style.color = '';
            contrasena2.style.color = '';
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

const btnSignIn = document.getElementById("sign-in"),
    btnSignUp = document.getElementById("sign-up"),
    containerFormRegister = document.querySelector(".register"),
    containerFormLogin = document.querySelector(".login");

btnSignIn.addEventListener("click", e => {
    containerFormRegister.classList.add("hide");
    containerFormLogin.classList.remove("hide")
})


btnSignUp.addEventListener("click", e => {
    containerFormLogin.classList.add("hide");
    containerFormRegister.classList.remove("hide")
})