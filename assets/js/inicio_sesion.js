document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.formulario');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('bd/login_usuario.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.text())
            .then(result => {
                if (result === 'error'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '¡Usuario y/o contraseña incorrecta!'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '¡Algo salio mal!'
                    }).then(() => {
                        window.location.href = 'index.html';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});