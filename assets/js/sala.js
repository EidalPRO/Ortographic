

const id_sala = document.getElementById('id-sala');


function generarCodigoSala() {
    const prefijo = "A0";
    const numeros = "0123456789";
    let codigoSala = prefijo;

    // Generar 3 números aleatorios
    for (let i = 0; i < 3; i++) {
        codigoSala += numeros.charAt(Math.floor(Math.random() * numeros.length));
    }

    return codigoSala;
}

const codigo = generarCodigoSala();
id_sala.innerText = "Código de la nueva sala: " + codigo;
// Asignar el código de sala al campo oculto
document.getElementById("codigo_sala").value = codigo;

document.getElementById('formulario').addEventListener('submit', function (event) {
    const nombreSala = document.getElementById('exampleInputEmail1').value;
    // Obtener todas las casillas de verificación de dificultad
    const dificultades = document.querySelectorAll('input[name^="dificultad"]');
    let seleccionada = false;

    // Verificar si al menos una casilla está marcada
    dificultades.forEach(function (dificultad) {
        if (dificultad.checked) {
            seleccionada = true;
        }
    });

    // Si ninguna casilla está marcada, evitar el envío del formulario
    if (!seleccionada || nombreSala.trim() === '') {
        event.preventDefault();
        Swal.fire({
            icon: "info",
            title: "Error",
            text: "Por favor, seleccione al menos una dificultad y proporcione un nombre para la sala."
        });
    }
});