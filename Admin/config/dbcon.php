<?php
//conexion a la base de datos (Usuarios)
//Variables

$host = "localhost";
$username = "root";
$password = "";
$database= "truck_man_db";
$port= "3307";

//Conexión

$con= mysqli_connect("$host","$username","$password","$database","$port");

//Si hay algun error, se presenta el aviso propuesto

if(!$con)
{
    header("Location: ../errors/dberror.php");
    die();
}
?>