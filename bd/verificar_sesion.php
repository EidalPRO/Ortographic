
<?php
session_start();

if (isset($_SESSION['usuario'])) {
    // La sesión está iniciada
    $response = array('session' => true);
    echo json_encode($response);
    exit();
} else {
    // No hay sesión iniciada
    $response = array('session' => false);
    echo json_encode($response);
    exit();
}
?>