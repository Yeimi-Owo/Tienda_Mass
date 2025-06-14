<?php
session_start();
require_once "../../Vista/config/database.php";

// Verificar si el usuario está autenticado
if (!isset($_SESSION["id_user"])) {
  echo "<script>alert('Debes iniciar sesión para completar la compra'); window.location.href='../../Vista/User/Registro-Login.html';</script>";
  exit();
}

// Verificar que se hayan recibido los datos del carrito y los datos adicionales
if (isset($_SESSION["productos_compra"], $_SESSION["correo"], $_SESSION["direccion"], $_SESSION["metodo_pago"])) {
  $productos = $_SESSION["productos_compra"];
  
  $con = (new Database())->conectar();
  $total = 0;
  $id_usuario = $_SESSION["id_user"]; // ID del usuario autenticado

  // Datos adicionales
  $correo = $_SESSION["correo"];
  $direccion = $_SESSION["direccion"];
  $metodo_pago = $_SESSION["metodo_pago"];

  // Calcular el total
  foreach ($productos as $producto) {
      $total += $producto["cantidad"] * $producto["precio"];
  }

  // Insertar compra en `compratm` 
  $sqlCompra = $con->prepare("INSERT INTO compratm (id_usuario, fecha, estado, total, correo, direccion, metodo_pago) VALUES (?, NOW(), 'pendiente', ?, ?, ?, ?)");
  if (!$sqlCompra->execute([$id_usuario, $total, $correo, $direccion, $metodo_pago])) {
      print_r($sqlCompra->errorInfo());
      exit();
  }
  $idCompra = $con->lastInsertId();

  // Insertar productos en `detalle_compratm`
  foreach ($productos as $producto) {
      $sqlDetalle = $con->prepare("INSERT INTO detalle_compratm (idCompra, idProductos, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
      $sqlDetalle->execute([$idCompra, $producto["idProductos"], $producto["cantidad"], $producto["precio"]]);

      // Reducir el stock correspondiente para cada producto
      $sqlStock = $con->prepare("UPDATE productos SET Stock = Stock - ? WHERE idProductos = ?");
      $sqlStock->execute([$producto["cantidad"], $producto["idProductos"]]);
  }
  
  $estado = "Pendiente";
  // Insertar en la tabla `pedidos`
  $sqlPedido = $con->prepare("INSERT INTO pedidos (id_usuario, idCompra, direccion, metodo_pago, correo, estado) VALUES (?, ?, ?, ?, ?, ?)");
  if (!$sqlPedido->execute([$id_usuario, $idCompra, $direccion, $metodo_pago, $correo, $estado])) {
      print_r($sqlPedido->errorInfo());
      exit();
  }

  // Guardar datos para la página de confirmación
  $_SESSION['compra_exitosa'] = [
      'numero_orden' => 'TM-' . date('Y') . '-' . str_pad($idCompra, 5, '0', STR_PAD_LEFT),
      'total' => $total,
      'productos' => $productos,
      'metodo_pago' => $metodo_pago,
      'correo' => $correo,
      'direccion' => $direccion,
      'fecha' => date('Y-m-d H:i:s'),
      'id_compra' => $idCompra
  ];

  // Limpiar datos de compra
  unset($_SESSION["productos_compra"], $_SESSION["correo"], $_SESSION["direccion"], $_SESSION["metodo_pago"]);

  // Redirigir a página de confirmación con animación
  header("Location: compra_exitosa.php");
  exit();

} else {
  echo "<script>alert('Hubo un error en la compra'); window.location.href='checkout.php';</script>";
}
?>