<?php
session_start();
include('config/conexion_be.php');
include('message.php');

// Código para agregar un producto
if (isset($_POST['btn-agregar'])) {
     $nombre = $_POST['nombre'];
     $stock = $_POST['stock'];
     $precio = $_POST['precio'];

     // Procesar imagen si se subió
     $foto = null;
     if (!empty($_FILES['foto']['tmp_name'])) {
          $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
     }

     // Insertar el producto en la base de datos
     $query = "INSERT INTO productos (NombreProductos, Stock, Precio, Foto) VALUES ('$nombre', '$stock', '$precio', '$foto')";
     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Producto agregado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     }
}

// Código para actualizar un producto
if (isset($_POST['btn-editar'])) {
     $id = $_POST['id'];
     $nombre = $_POST['nombre'];
     $stock = $_POST['stock'];
     $precio = $_POST['precio'];

     // Procesar nueva imagen si se subió
     $foto = null;
     if (!empty($_FILES['foto']['tmp_name'])) {
          $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
          $query = "UPDATE productos SET NombreProductos = '$nombre', Stock = '$stock', Precio = '$precio', Foto = '$foto' WHERE idProductos = '$id'";
     } else {
          $query = "UPDATE productos SET NombreProductos = '$nombre', Stock = '$stock', Precio = '$precio' WHERE idProductos = '$id'";
     }

     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Producto actualizado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     }
}

// Código para eliminar un producto
if (isset($_POST['btn-eliminar'])) {
     $producto_id = $_POST['btn-eliminar'];

     // Eliminar el producto de la base de datos
     $query = "DELETE FROM productos WHERE idProductos='$producto_id' ";
     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('Producto eliminado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-productos.php'</script>";
     }
}
