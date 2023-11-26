document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.formulario');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('bd/registro_usuarios.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(result => {
                if (result === 'exito') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Inicio de sesión exitosa',
                        text: '¡Ahora puedes disfrutar de ortographic sin limitaciones!'
                    }).then(() => {
                        window.location.href = 'login.html';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '¡Usuario y/o contraseña incorrecta!'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});