<?php
session_start();
include('config/conexion_be.php');
include('message.php');

// ----------------------
// Agregar una venta
// ----------------------
if (isset($_POST['btn-agregar'])) {
     // Capturamos los datos (observa que "fecha" se asigna automáticamente)
     $id_usuario = $_POST['id_usuario'];   // Debe ser un número entero
     $estado     = $_POST['estado'];       // Debe ser 'pendiente', 'completado' o 'cancelado'
     $total      = $_POST['total'];        // Total de la venta, en formato decimal (ej. 123.45)

     // Creamos el statement preparado
     $query = "INSERT INTO compratm (id_usuario, estado, total) VALUES (?, ?, ?)";
     $stmt = mysqli_prepare($con, $query);
     if ($stmt === false) {
          echo "<script>alert('Error en la preparación del statement');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
          exit();
     }

     // 'i' para el id_usuario, 's' para estado y 'd' para total (decimal)
     mysqli_stmt_bind_param($stmt, "isd", $id_usuario, $estado, $total);
     if (mysqli_stmt_execute($stmt)) {
          echo "<script>alert('Venta agregada satisfactoriamente');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     } else {
          echo "<script>alert('Hubo un error al agregar la venta');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     }
     mysqli_stmt_close($stmt);
}

// ----------------------
// Editar (actualizar) una venta
// ----------------------
if (isset($_POST['btn-editar'])) {
     $idCompra   = $_POST['idCompra'];     // El ID de la venta a actualizar
     $id_usuario = $_POST['id_usuario'];
     $estado     = $_POST['estado'];
     $total      = $_POST['total'];

     $query = "UPDATE compratm SET id_usuario = ?, estado = ?, total = ? WHERE idCompra = ?";
     $stmt = mysqli_prepare($con, $query);
     if ($stmt === false) {
          echo "<script>alert('Error en la preparación del statement');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
          exit();
     }
     // 'isdi': id_usuario (i), estado (s), total (d) y idCompra (i)
     mysqli_stmt_bind_param($stmt, "isdi", $id_usuario, $estado, $total, $idCompra);
     if (mysqli_stmt_execute($stmt)) {
          echo "<script>alert('Venta actualizada satisfactoriamente');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     } else {
          echo "<script>alert('Hubo un error al actualizar la venta');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     }
     mysqli_stmt_close($stmt);
}

// ----------------------
// Eliminar una venta
// ----------------------
if (isset($_POST['btn-eliminar'])) {
     $idCompra = $_POST['btn-eliminar'];

     $query = "DELETE FROM compratm WHERE idCompra = ?";
     $stmt = mysqli_prepare($con, $query);
     if ($stmt === false) {
          echo "<script>alert('Error en la preparación del statement');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
          exit();
     }
     mysqli_stmt_bind_param($stmt, "i", $idCompra);
     if (mysqli_stmt_execute($stmt)) {
          echo "<script>alert('Venta eliminada satisfactoriamente');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     } else {
          echo "<script>alert('Hubo un error al eliminar la venta');</script>";
          echo "<script>window.location.href='list-ventas.php';</script>";
     }
     mysqli_stmt_close($stmt);
}
