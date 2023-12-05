window.onload = () => {
    obtenerCodigoSala();
}

const codigoSala = localStorage.getItem('codigoSala');


function obtenerCodigoSala() {
    fetch(`bd/obtener_codigo_sala.php?codigo_sala=${codigoSala}`)
        .then(response => response.text()) // Usar response.text() para obtener el código de sala como texto
        .then(codigoSala => {
            const codigoSalaElement = document.getElementById('sala');
            codigoSalaElement.innerText = "Sala: " + codigoSala;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
