<?php
// Establecer la zona horaria a la de tu país
date_default_timezone_set('America/Lima');


require_once "../../Modelo/Conexion/conexion_be.php";

// Obtener los valores del formulario
$nombre_completo = isset($_POST["nombre_completo"]) ? $_POST["nombre_completo"] : "";
$correo = isset($_POST["correo"]) ? $_POST["correo"] : "";
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : "";
$fecha_registro = date('Y-m-d H:i:s'); // Obtener la fecha y hora actual
$activo = 1;

// Verificar si hay campos vacíos
if (empty($nombre_completo) || empty($correo) || empty($usuario) || empty($contrasena)) {
    echo '
            <script>
              alert("Por favor, complete todos los campos del formulario.");
              window.location="../../Vista/User/Registro-Login.html";
           </script>
        ';
    exit;
} else {
    //Verificar que el correo no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");
    //Condicional para verificar si hay una fila con el mismo correo
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo '
            <script>
                alert("Este correo ya ha sido registrado");
                window.location="../../Vista/User/Registro-Login.html";
            </script>
        ';
        exit;
    } else {
        $query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena, fecha_registro, activo)
        VALUES ('$nombre_completo', '$correo', '$usuario', '$contrasena', '$fecha_registro', '$activo')";
    }
}

/*Verificar que el usuario no se repita en la base de datos
$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");
//Condicional para verificar si hay una fila con el mismo correo
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
            <script>
                alert("Este usuario ya está registrado");
                window.location="../../Vista/User/Registro-Login.html";
            </script>
           ';
    exit;
}
*/

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location="../../Vista/User/Registro-Login.html";
            </script>
        ';
} else {
    echo '
            <script>
                alert("Intentalo de nuevo, el ususario no está almacenado");
                window.location="../../Vista/User/Registro-Login.html";
            </script>
        ';
}
mysqli_close($conexion);
