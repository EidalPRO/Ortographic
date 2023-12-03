document.querySelector('[name="boton_practicar"]').addEventListener('click', function (event) {
    // Evita la acción por defecto 
    event.preventDefault();

    // Verifica si la sesión está iniciada
    <?php if (isset($_SESSION['usuario'])) { ?>
        // Si la sesión está iniciada, redirige a categoria.php
        window.location.href = "selecionar_sala.php";
    <?php } else { ?>
        Swal.fire({
            icon: "info",
            title: "Inicia sesión",
            text: "Debes iniciar sesión para tener una mejor experiencia del juego.",
        }).then(function () {
            window.location.href = "sesion_inicio.php";
        });
    <?php } ?>
});