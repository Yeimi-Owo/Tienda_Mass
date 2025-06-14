<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!empty($_SESSION['usuario'])) {
    // Si el usuario ha iniciado sesión, se obtiene el nombre de usuario de la variable de sesión
    $nombreUsuario = $_SESSION['usuario'];

    // Se crea un array llamado $response con una clave 'logged_in' y el valor booleano true,
    // y también se agrega la clave 'nombre' con el valor del nombre de usuario.
    $response = array('logged_in' => true, 'nombre' => $nombreUsuario);
} else {
    // Usuario no ha iniciado sesión
    $response = array('logged_in' => false);
}
// Se establece el encabezado de la respuesta HTTP para indicar que el contenido devuelto será en formato JSON.
header('Content-Type: application/json');
// La función json_encode() convierte el array $response en una cadena JSON y la muestra en la salida. 
// Esto devuelve la respuesta en formato JSON, que indica si el usuario ha iniciado sesión o no, 
// y también incluye el nombre de usuario si está disponible.
echo json_encode($response);
?>

