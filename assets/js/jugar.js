document.getElementById("salir").addEventListener('click', function (event) {
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

const op1 = document.getElementById("op1");
const op2 = document.getElementById("op2");
const op3 = document.getElementById("op3");
const mostrarReactivo = document.getElementById("mostrar-reactivo");
const contador = document.getElementById("contador");
var preg;
var res;
var d1;
var d2;
var fed;
var ora;
var posCorrect;
var id;
var acerto = 0;
let preguntasRespondidas = 1;
var porcentajeEfectividad;
var porcentajeNivel;
var tiempoTotal;
var tema;
var temaPorsentaje;
var miDificultad;
let preguntasMostradas = [];
let reactivos = [];
let numerosGenerados = [];
var df1 = (localStorage.getItem('df1') === 'true') ? true : false;
var df2 = (localStorage.getItem('df2') === 'true') ? true : false;
var df3 = (localStorage.getItem('df3') === 'true') ? true : false;


// Función para obtener los datos de la tabla desde PHP
function obtenerDatos() {
    // Obtenemos el valor de localStorage
    var miDato = localStorage.getItem('tema');
    miDificultad = localStorage.getItem('dificultad');
    switch (miDato) {
        case "t1":
            tema = "acentuacion";
            temaPorsentaje = "tema_1_porcentaje";
            break;
        case "t2":
            tema = "letras";
            temaPorsentaje = "tema_2_porcentaje";
            break;
        case "t3":
            tema = "concordancia";
            temaPorsentaje = "tema_3_porcentaje";
            break;
        case "t4":
            tema = "gramaticaGeneral";
            temaPorsentaje = "tema_4_porcentaje";
            break;
    }

    fetch('bd/reactivos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'dato=' + tema + '&dato2=' + miDificultad // Aquí enviamos tanto el tema como la dificultad
    })
        .then(response => response.json())
        .then(data => {

            // console.log(data);

            reactivos = data;

            iniciarJuego();
        })
        .catch(error => {
            console.log('Error al obtener datos:', error);
        });
}
window.onload = obtenerDatos;

function iniciarJuego() {
    tiempoInicio = performance.now();
    cargarReactivo();
}

function generarNumeroUnico(min, max) {
    let nuevoNumero;
    do {
        nuevoNumero = Math.floor(Math.random() * (max - min + 1)) + min;
    } while (numerosGenerados.includes(nuevoNumero));
    numerosGenerados.push(nuevoNumero);
    return nuevoNumero;
}

function cargarReactivo() {
    if (verificarFinJuego()) {
        // progressBar.style.width = 100 + '%';
        porcentajeEfectividad = (acerto * 100) / reactivos.length;
        porcentajeEfectividad = Number(porcentajeEfectividad.toFixed(2));
        // progressBar.setAttribute('aria-valuenow', porcentaje);

        finalizarJuego();
        var dificultades = (df1 ? 1 : 0) + (df2 ? 1 : 0) + (df3 ? 1 : 0);

        subirDatosUno(tiempoTotal, porcentajeEfectividad, miDificultad, dificultades, df1, df2, df3);
    } else {


        do {
            id = generarNumeroUnico(0, reactivos.length - 1);
        } while (preguntasMostradas.includes(id));

        preguntasMostradas.push(id);

        var n = Math.floor(Math.random() * 3);
        posCorrect = (n == 1) ? 'I' : (n == 2) ? 'M' : 'D';

        preg = reactivos[id].pregunta;
        res = reactivos[id].respuesta;
        d1 = reactivos[id].distractor_1;
        d2 = reactivos[id].distractor_2;
        fed = reactivos[id].feedback;
        ora = reactivos[id].oracionCorrecta;

        contador.innerText = preguntasMostradas.length + "/" + reactivos.length;
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
}

op1.addEventListener("click", ganoI);
function ganoI() {
    if (posCorrect == 'I') {
        mostrarRespuestaCorrecta();
    } else {
        mostrarRespuestaIncorrecta();
    }
}
op2.addEventListener("click", ganoM);
function ganoM() {
    if (posCorrect == 'M') {
        mostrarRespuestaCorrecta();
    } else {
        mostrarRespuestaIncorrecta();
    }
}
op3.addEventListener("click", verificarGano);
function verificarGano() {
    if (posCorrect == 'D') {
        mostrarRespuestaCorrecta();
    } else {
        mostrarRespuestaIncorrecta();
    }
}

function mostrarRespuestaCorrecta() {
    acerto++;
    Swal.fire({
        icon: 'success',
        title: 'Respuesta correcta. ',
        html: `<p>${ora}</p>` + '<br>' + `<p>${fed}</p>`,
        confirmButtonText: 'Continuar',
        padding: '1rem',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            cargarReactivo();

            avanzarBarraProgreso();
        }
    });
}

// Función para mostrar SweetAlert de respuesta incorrecta
function mostrarRespuestaIncorrecta() {
    Swal.fire({
        icon: 'error',
        title: 'Respuesta incorrecta. ',
        html: `<p>${ora}</p>` + '<br>' + `<p>${fed}</p>`,
        confirmButtonText: 'Continuar',
        padding: '1rem',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            cargarReactivo();
            avanzarBarraProgreso();
        }
    });
}

function avanzarBarraProgreso() {
    preguntasRespondidas++;
    const porcentaje = (preguntasRespondidas / reactivos.length) * 100;
    const progressBar = document.querySelector('.progress-bar');
    progressBar.style.width = (porcentaje) + '%';
    progressBar.setAttribute('aria-valuenow', porcentaje);
}

function verificarFinJuego() {
    return (preguntasMostradas.length === reactivos.length) ? true : false;
}

function finalizarJuego() {
    tiempoFinal = performance.now(); // Guarda el tiempo de finalización

    tiempoTotal = (tiempoFinal - tiempoInicio) / 1000; // Calcula la diferencia de tiempo
    // Convierte a segundos: tiempoTotal / 1000
    // Limita el tiempo total a dos decimales y muestra solo las cuatro cifras significativas
    tiempoTotal = Number(tiempoTotal.toFixed(2));
}

// Función para subir datos al servidor
function subirDatosUno(tiempoTotal, porcentajeEfectividad, miDificultad, df, df1, df2, df3) {
    const datos = {
        tiempoTotal: tiempoTotal,
        porcentajeEfectividad: porcentajeEfectividad,
        tema: temaPorsentaje,
        dificultad: miDificultad,
        df: df,
        df1: df1,
        df2: df2,
        df3: df3
    };

    const opciones = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    };

    fetch('bd/subid_datos.php', opciones)
        .then(response => {
            if (!response.ok) {
                throw new Error('Ocurrió un error al realizar la solicitud.');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: 'Preguntas completadas',
                    text: `Este fue tu porcentaje de efectividad en la dificultad ${miDificultad}: ${porcentajeEfectividad}% \nTu tiempo total en responder las preguntas fue de ${tiempoTotal} segundos.`
                }).then(() => {
                    enviarDatos();
                    // window.location.href = `categoria.php?ronda=terminada&logro=${temaPorsentaje}`;
                });
            } else {
                console.error('Error al actualizar datos:', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function enviarDatos() {
    var codigo = localStorage.getItem('codigoSala');

    if (codigo === 'A0123') {

        var logroObtenido;
        var logroAMostrar;
        var logroTema;
        const datos = {
            tema: temaPorsentaje,
        };

        const opciones = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        };

        fetch('bd/obtenerLogros.php', opciones)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var logroFinal = data.logroFinal;
                    logroTema = data.logroTema;
                    logroObtenido = data.logro;
                    logroAMostrar = (logroObtenido === "logro1") ? 'Maestro de la Acentuación' : (logroObtenido === "logro2") ? 'Rey de las Letras' : (logroObtenido === "logro3") ? 'Señor de la Concordancia' : 'Experto en Gramática';
                    var logroImagen = (logroObtenido === "logro1") ? 'Acentuacion.webp' : (logroObtenido === "logro2") ? 'Logro-letras.webp' : (logroObtenido === "logro3") ? 'Concordancia.webp' : 'Gramatica.webp';

                    Swal.fire({
                        title: "Felicidades!",
                        text: `Acabas de obtener el logro ${logroAMostrar}. 
                        \n Por haber conseguido el 100% de efectividad en el tema de ${logroTema}.`,
                        imageUrl: `assets/imagenes/logros/${logroImagen}`,
                        imageWidth: 200,
                        imageHeight: 200,
                        imageAlt: "Custom image"
                    }).then(() => {
                        if (logroFinal) {
                            Swal.fire({
                                title: "Felicidades!",
                                text: `Acabas de obtener el logro Sabio Ortográfico. 
                            \n Por haber conseguido el 100% de efectividad todos los temas.`,
                                imageUrl: `assets/imagenes/logros/logro-final.webp`,
                                imageWidth: 200,
                                imageHeight: 200,
                                imageAlt: "Custom image"
                            }).then(() => {
                                window.location.href = `categoria.php?ronda=terminada&logro=Sabio-Ortográfico`;
                            });
                        } else {
                            window.location.href = `categoria.php?ronda=terminada&logro=${logroAMostrar}`;
                        }
                    });

                    // Hacer algo con el logro obtenido
                } else {
                    // console.error('Logro no conseguido.', data.message);
                    console.log('Logro no conseguido.', data.message);
                    window.location.href = `categoria.php?ronda=terminada`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    } else {
        window.location.href = `categoria.php?ronda=terminada`;
    }

}