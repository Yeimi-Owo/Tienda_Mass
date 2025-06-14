<?php
session_start(); // Inicia o recupera la sesión

session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión actual

// Redirigir a la página de inicio
echo '<script>alert("La sesion se ha cerrada");window.location="../index.php";</script>';
?>
