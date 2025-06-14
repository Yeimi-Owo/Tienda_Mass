<?php
session_start();

require_once "../../Modelo/Conexion/conexion_be.php";

if (!empty($_SESSION['usuario'])) {
    $nombreUsuario = $_SESSION['usuario'];
    $query = "SELECT nombre_completo, correo FROM usuarios WHERE usuario => '$nombreUsuario'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $response = array('logged_in' => true,'nombre_completo' => $row['nombre_completo'],'correo' => $row['correo']
    );
} else {
    $response = array('logged_in' => false);
}

header('Content-Type: application/json');
echo json_encode($response);
?>

