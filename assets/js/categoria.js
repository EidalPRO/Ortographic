window.onload = () => {
    obtenerCodigoSala(); // Llamar a la función para obtener el código de sala
}

function obtenerCodigoSala() {
    fetch('bd/obtener_codigo_sala.php') // Reemplaza 'obtener_codigo_sala.php' con tu ruta correcta
        .then(response => response.text()) // Usar response.text() para obtener el código de sala como texto
        .then(codigoSala => {
            const codigoSalaElement = document.getElementById('sala');
            codigoSalaElement.innerText = "Sala: " + codigoSala; // Mostrar el código de sala en el elemento h5
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
