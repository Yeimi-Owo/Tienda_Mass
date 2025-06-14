<?php
session_start();
include('config/conexion_be.php');
include('message.php');

if (isset($_POST['btn-agregar']))

//Codigo para agregar a un usuario

{
    $name = $_POST['nombre'];
    $user = $_POST['usuario'];
    $email = $_POST['correo'];
    $pass = $_POST['contrasena'];
    $status = 1;

    //Conexion a la base de datos

    $query = "INSERT INTO usuarios (nombre_completo,usuario,correo,contrasena,activo) VALUES ('$name','$user','$email','$pass','$status')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        //Confirmacion de Usuario agregado

        echo "<script>alert('Usuario agregado satisfactoriamente');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    } else {

        //Notificacion si no se agrego

        echo "<script>alert('Hubo un error.');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    }
}


if (isset($_POST['btn-editar']))

//Actualizar datos del usuario

{

    $name = $_POST['nombre'];
    $user = $_POST['usuario'];
    $email = $_POST['correo'];
    $pass = $_POST['contrasena'];
    $user_id = $_POST['user_id'];


    //Conexion a la base de datos

    $query = "UPDATE usuarios set nombre_completo = '$name', usuario = '$user', correo = '$email', contrasena = '$pass'
    where  id_usuario= '$user_id' ";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        //Confirmacion de Usuario actualizado

        echo "<script>alert('Usuario actualizado satisfactoriamente');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    } else {

        //Notificacion si no se actualizo

        echo "<script>alert('Hubo un error.');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    }
}

//Codigo para la eliminacion de administrador

if (isset($_POST['btn-eliminar'])) {
    $user_id = $_POST['btn-eliminar'];

    //Conexion a la base de datos

    $query = "DELETE FROM usuarios WHERE id_usuario='$user_id' ";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {

        //Confirmacion de Usuario actualizado

        echo "<script>alert('Usuario eliminado satisfactoriamente');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    } else {

        //Notificacion si no se actualizo

        echo "<script>alert('Hubo un error.');</script>";
        echo "<script>window.location.href='list-usuarios.php'</script>";
    }
}
