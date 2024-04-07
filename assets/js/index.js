document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('buscarUsuarios').addEventListener('input', function() {
        var busqueda = this.value;

        if (busqueda.trim() === '') {
            document.getElementById('listaUsuarios').innerHTML = '';
            return;
        }

        fetch('bd/buscarUsuarios.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'busqueda=' + busqueda,
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === '') {
                // Si la respuesta está vacía, mostrar un mensaje de "No se encontraron usuarios"
                document.getElementById('listaUsuarios').innerHTML = '<p>No se encontraron usuarios</p>';
            } else {
                // Si la respuesta contiene usuarios, mostrar la lista de usuarios
                document.getElementById('listaUsuarios').innerHTML = data;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

// document.getElementById('m1').addEventListener('click', function (event) {
//     window.location.href = "assets/pdf/manual_instalacion_ort.pdf";
// });

document.getElementById('m2').addEventListener('click', function (event) {
    window.location.href = "assets/pdf/Manual_usuario_ort.pdf";
});


