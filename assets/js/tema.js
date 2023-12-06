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


const t1 = document.getElementById('t1');
const t2 = document.getElementById('t2');
const t3 = document.getElementById('t3');
const t4 = document.getElementById('t4');

t1.addEventListener("click", function () {
    localStorage.setItem('tema', 't1');
    window.location.href = "juego.php";
});

t2.addEventListener("click", function () {
    localStorage.setItem('tema', 't2');
    window.location.href = "juego.php";
});

t3.addEventListener("click", function() {
    localStorage.setItem('tema', 't3');
    window.location.href = "juego.php";
});

t4.addEventListener("click", function() {
    localStorage.setItem('tema', 't4');
    window.location.href = "juego.php";
});