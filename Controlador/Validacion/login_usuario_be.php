<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once "../../Modelo/Conexion/conexion_be.php";

// Obtener los valores del formulario
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
//md5()

// Verificar las credenciales del usuario en la tabla de usuarios
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
$resultado = mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $id = mysqli_fetch_assoc($resultado);
    // Inicio de sesión exitoso, almacenar información en la variable de sesión
    $_SESSION['usuario_iniciado'] = true;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['id_user'] = $id['id_usuario'];
    header("location: ../../Vista/Home/Index.php");
    exit();
} else {
    echo '
    <script>
        alert("Usuario no existe o la contraseña es incorrecta, por favor verifique los datos introducidos");
        window.location="../../Vista/User/Registro-Login.html";
    </script>
    ';
    exit();
}
?>

