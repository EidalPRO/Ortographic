document.addEventListener('DOMContentLoaded', function () {
    // addEventListener para asegurarnos de que el DOM esté completamente cargado

    document.getElementById('buscarUsuarios').addEventListener('input', function() {
        // Obtener el valor del campo de búsqueda
        var busqueda = this.value;


        // solicitud AJAX con fetch
        fetch('bd/buscarUsuarios.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'busqueda=' + busqueda,
        })
        .then(response => response.text())
        .then(data => {
            // Actualizar la lista de usuarios con la respuesta del servidor
            document.getElementById('listaUsuarios').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

