<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Detalle de Pedido</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMac</b></li>
          <li class="breadcrumb-item">Pedidos</li>
          <li class="breadcrumb-item">Detalle de Pedido</li>
     </ol>

     <?php
     // Verificar que se haya enviado el ID de la venta
     if (isset($_GET['id'])) {
          $venta_id = $_GET['id'];

          // Consulta de la cabecera de la venta
          $queryVenta = "SELECT * FROM compratm WHERE idCompra = '$venta_id'";
          $resultVenta = mysqli_query($con, $queryVenta);

          if (mysqli_num_rows($resultVenta) > 0) {
               $venta = mysqli_fetch_assoc($resultVenta);
     ?>
               <div class="card mb-4">
                    <div class="card-header">
                         <h4>Información del Pedido</h4>
                    </div>
                    <div class="card-body">
                         <p><strong>Código del Usuario:</strong> <?= $venta['id_usuario']; ?></p>
                         <p><strong>Fecha:</strong> <?= $venta['fecha']; ?></p>
                         <p><strong>Dirección:</strong> <?= $venta['direccion']; ?></p>
                    </div>
               </div>

               <?php
               // Consulta para obtener el detalle de la venta
               $queryDetalle = "SELECT d.*, p.NombreProductos 
                             FROM detalle_compratm d 
                             JOIN productos p ON d.idProductos = p.idProductos 
                             WHERE d.idCompra = '$venta_id'";
               $resultDetalle = mysqli_query($con, $queryDetalle);
               ?>

               <div class="card">
                    <div class="card-header">
                         <h4>Lista de Productos</h4>
                    </div>
                    <div class="card-body">
                         <table class="table table-bordered">
                              <thead>
                                   <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   if (mysqli_num_rows($resultDetalle) > 0) {
                                        $granTotal = 0;
                                        while ($detalle = mysqli_fetch_assoc($resultDetalle)) {
                                             $subtotal = $detalle['cantidad'] * $detalle['precio_unitario'];
                                             $granTotal += $subtotal;
                                   ?>
                                             <tr>
                                                  <td><?= $detalle['NombreProductos']; ?></td>
                                                  <td><?= $detalle['cantidad']; ?></td>
                                                  <td>S/<?= number_format($detalle['precio_unitario'], 2); ?></td>
                                                  <td>S/<?= number_format($subtotal, 2); ?></td>
                                             </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                             <td colspan="3" class="text-end"><strong>Total</strong></td>
                                             <td><strong>S/<?= number_format($granTotal, 2); ?></strong></td>
                                        </tr>
                                   <?php
                                   } else {
                                   ?>
                                        <tr>
                                             <td colspan="4">No se encontraron registros de detalle</td>
                                        </tr>
                                   <?php
                                   }
                                   ?>
                              </tbody>
                         </table>
                    </div>
               </div>

               <div class="mt-3">
                    <a href="list-pedidos.php" class="btn btn-secondary">Volver</a>
               </div>

     <?php
          } else {
               echo "<h4>No se encontró la venta con el ID especificado.</h4>";
          }
     } else {
          echo "<h4>No se especificó ningún ID de venta.</h4>";
     }
     ?>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>