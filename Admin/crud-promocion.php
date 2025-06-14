<?php
session_start();
include('config/conexion_be.php');
include('message.php');

// Código para agregar un producto
if (isset($_POST['btn-agregar'])) {
     $nombre = $_POST['nombre'];
     $desc = $_POST['descripcion'];
     $pre = $_POST['precio'];
     $det = $_POST['detalles'];
     $ac = 1;

     // Insertar el producto en la base de datos
     $query = "INSERT INTO planes (nombre, descripcion, precio, detalles, activo) VALUES ('$nombre', '$desc', '$pre', '$det', '$ac')";
     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Promocion agregada satisfactoriamente');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     }
}

// Código para actualizar un producto
if (isset($_POST['btn-editar'])) {
     $nombre = $_POST['nombre'];
     $desc = $_POST['descripcion'];
     $pre = $_POST['precio'];
     $det = $_POST['detalles'];
     $id = $_POST['id'];

     $query = "UPDATE planes SET nombre = '$nombre', descripcion = '$desc', precio = '$pre', detalles = '$det' WHERE id_planes = '$id'";

     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Producto actualizado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     }
}

// Código para eliminar un producto
if (isset($_POST['btn-eliminar'])) {
     $promo_id = $_POST['btn-eliminar'];

     // Eliminar el producto de la base de datos
     $query = "DELETE FROM planes WHERE id_planes='$promo_id' ";
     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Promocion eliminado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-promociones.php'</script>";
     }
}
