document.getElementById("btn").addEventListener('click', function (event) {
    event.preventDefault();

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });
    swalWithBootstrapButtons.fire({
        title: "¿Esta segur@ que desea salir?",
        text: "Ten en cuenta que se perdera todo tu progreso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy segur@!",
        cancelButtonText: "No, cancelar!",

    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "categoria.php"
        }
    });

});

var op1 = document.getElementById("op1");
var op2 = document.getElementById("op2");
var op3 = document.getElementById("op3");
var mostrarReactivo = document.getElementById("mostrar-reactivo");

let reactivosAcento = [];

// Función para obtener los datos de la tabla desde PHP
function obtenerDatosTabla() {
    fetch('bd/reactivos.php')
        .then(response => response.json())
        .then(data => {

            // console.log(data);
            reactivosAcento = data;

            console.log(reactivosAcento);

            // console.log(reactivosAcento[3].id);
            // console.log(reactivosAcento[3].pregunta);
            iniciarJuego();
        })
        .catch(error => {
            console.error('Error al obtener datos:', error);
        });
}
window.onload = obtenerDatosTabla;
function iniciarJuego() {
    tiempoInicio = performance.now();
    cargarReactivo();

}

let numerosGenerados = [];
function generarNumeroUnico(min, max) {
    let nuevoNumero;
    do {
        nuevoNumero = Math.floor(Math.random() * (max - min + 1)) + min;
    } while (numerosGenerados.includes(nuevoNumero));
    numerosGenerados.push(nuevoNumero);
    return nuevoNumero;
}

var preg;
var res;
var d1;
var d2;
var fed;
var ora;
var posCorrect
var id
let preguntasMostradas = [];
let acerto = 0;

function cargarReactivo() {
    do {
        id = generarNumeroUnico(0, reactivosAcento.length - 1);
    } while (preguntasMostradas.includes(id));

    preguntasMostradas.push(id);

    var n = Math.floor(Math.random() * 3);
    posCorrect = (n == 1) ? 'I' : (n == 2) ? 'M' : 'D';

    console.log(n);
    console.log(posCorrect);

    console.log(id);

    preg = reactivosAcento[id].pregunta;
    res = reactivosAcento[id].respuesta;
    d1 = reactivosAcento[id].distractor_1;
    d2 = reactivosAcento[id].distracor_2;
    fed = reactivosAcento[id].feedback;
    ora = reactivosAcento[id].oracionCorrecta;

    mostrarReactivo.innerText = preg;
    if (posCorrect == 'I') {
        op1.innerText = res;
        if (Math.floor(Math.random() * 2) == 1) {
            op2.innerText = d1;
            op3.innerText = d2;
        } else {
            op2.innerText = d2;
            op3.innerText = d1;
        }
    } else if (posCorrect == 'M') {
        op2.innerText = res;
        if (Math.floor(Math.random() * 2) == 1) {
            op1.innerText = d1;
            op3.innerText = d2;
        } else {
            op1.innerText = d2;
            op3.innerText = d1;
        }
    } else {
        op3.innerText = res;
        if (Math.floor(Math.random() * 2) == 1) {
            op1.innerText = d1;
            op2.innerText = d2;
        } else {
            op1.innerText = d2;
            op2.innerText = d1;
        }
    }
}

op1.addEventListener("click", ganoI);
function ganoI() {
    if (posCorrect == 'I') {
        console.log("Ganaste");
        acerto++;
        cargarReactivo();
    } else {
        console.log("perdiste");
        cargarReactivo();
    }
    avanzarBarraProgreso()
}
op2.addEventListener("click", ganoM);
function ganoM() {
    if (posCorrect == 'M') {
        acerto++;
        console.log("Ganaste");
        cargarReactivo();
    } else {
        console.log("perdiste");
        cargarReactivo();
    }
    avanzarBarraProgreso()
}
op3.addEventListener("click", verificarGano);
function verificarGano() {
    if (posCorrect == 'D') {
        console.log("Ganaste");
        acerto++;
        cargarReactivo();
    } else {
        console.log("perdiste");
        cargarReactivo();
    }
    avanzarBarraProgreso()
}

function verificarFinJuego() {
    if (preguntasMostradas.length === reactivosAcento.length) {
        // alert("¡Todas las preguntas han sido mostradas!");
        return true;
    } else {
        return false;
    }
}

let preguntasRespondidas = 0;
var porcentajeEfectividad;

function avanzarBarraProgreso() {
    preguntasRespondidas++;
    const porcentaje = (preguntasRespondidas / reactivosAcento.length) * 100;

    const progressBar = document.querySelector('.progress-bar');
    progressBar.style.width = porcentaje + '%';
    progressBar.setAttribute('aria-valuenow', porcentaje);

    if (verificarFinJuego()) {
        porcentajeEfectividad = (acerto * 100) / reactivosAcento.length;
        progressBar.style.width = 100 + '%';
        progressBar.setAttribute('aria-valuenow', porcentaje);
        finalizarJuego()
        subirDatos()
        Swal.fire({
            icon: 'success',
            title: 'Preguntas completadas',
            text: `Este fue tu porsentaje de efectividad en Acentuación ${porcentajeEfectividad}% \n
            Tu tiempo total en responder las preguntas fue de ${tiempoTotal} segundos.`

        }).then(() => {
            window.location.href = 'categoria.php';
        });
    }
}
var tiempoTotal;

function finalizarJuego() {
    tiempoFinal = performance.now(); // Guarda el tiempo de finalización

    tiempoTotal = (tiempoFinal - tiempoInicio) / 1000; // Calcula la diferencia de tiempo

    // Convierte a segundos: tiempoTotal / 1000
}

// Función para obtener el valor de un parámetro de la URL por su nombre
function obtenerParametroURL(nombre) {
    const parametros = new URLSearchParams(window.location.search);
    return parametros.get(nombre);
}

// Obtener el código de la sala de la URL
const codigoSala = obtenerParametroURL('codigo_sala');



// Configuración para la solicitud POST
function subirDatos() {
    const datos = {
        tiempoTotal: tiempoTotal,
        porcentajeEfectividad: porcentajeEfectividad
    };

    const opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    };

    fetch('bd/subir_datos.php', opciones)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al enviar los datos.');
            }
            return response.json();
        })
        .then(data => {
            console.log('Datos enviados exitosamente:', data);
            // Hacer algo con la respuesta, si es necesario
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
