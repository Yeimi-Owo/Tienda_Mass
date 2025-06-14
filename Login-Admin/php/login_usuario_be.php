<?php
session_start();
include 'conexion_be.php'; // Conexión a la base de datos

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Verificar datos del administrador
$validar_admin = mysqli_query($conexion, "SELECT * FROM administrador WHERE email='$email' AND contrasena='$contrasena'");
if (mysqli_num_rows($validar_admin) > 0) {
    $admin = mysqli_fetch_assoc($validar_admin);
    $_SESSION['usuario'] = $admin['email'];
    $_SESSION['nombre'] = $admin['nombre'];

    header("location: ../../admin/index.php"); // Redirigir a la sección de administración
    exit();
} else {

// Si no se encuentra en ninguna tabla, mostrar mensaje de error
echo '
    <script>
        alert("Usuario no existe, por favor verifique los datos ingresados");
        window.location = "../index.php";
    </script>
';
exit();
}
?>
