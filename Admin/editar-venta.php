<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Editar Venta</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMac</b></li>
          <li class="breadcrumb-item">Ventas</li>
     </ol>
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Editar Venta
                              <a href="list-ventas.php" class="btn btn-danger float-end">Volver</a>
                         </h4>
                    </div>
                    <div class="card-body">
                         <?php
                         if (isset($_GET['editid'])) {
                              $venta_id = $_GET['editid'];
                              // Consultar cabecera de la venta
                              $queryVenta = "SELECT * FROM compratm WHERE idCompra='$venta_id'";
                              $resultVenta = mysqli_query($con, $queryVenta);

                              if (mysqli_num_rows($resultVenta) > 0) {
                                   $venta = mysqli_fetch_assoc($resultVenta);
                                   // Consultamos el detalle de la venta
                                   $queryDetalle = "SELECT d.*, p.NombreProductos 
                                                   FROM detalle_compratm d 
                                                   JOIN productos p ON d.idProductos = p.idProductos 
                                                   WHERE d.idCompra='$venta_id'";
                                   $resultDetalle = mysqli_query($con, $queryDetalle);
                         ?>
                                   <form action="crud-venta.php" method="POST">
                                        <!-- Cabecera de la venta -->
                                        <input type="hidden" name="idCompra" value="<?= $venta['idCompra']; ?>">
                                        <div class="row">
                                             <div class="col-md-6 mb-3">
                                                  <label for="">ID Usuario</label>
                                                  <input type="text" name="id_usuario" value="<?= $venta['id_usuario']; ?>" class="form-control" readonly>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Fecha</label>
                                                  <input type="text" name="fecha" value="<?= $venta['fecha']; ?>" class="form-control">
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Estado</label>
                                                  <select name="estado" class="form-select" required>
                                                       <option value="pendiente" <?= ($venta['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                                       <option value="completado" <?= ($venta['estado'] == 'completado') ? 'selected' : ''; ?>>Completado</option>
                                                       <option value="cancelado" <?= ($venta['estado'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                                                  </select>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Total</label>
                                                  <input type="number" step="0.01" name="total" value="<?= $venta['total']; ?>" class="form-control" required>
                                             </div>
                                        </div>

                                        <h4>Detalles de la Venta</h4>
                                        <table class="table table-bordered">
                                             <thead>
                                                  <tr>
                                                       <th>Producto</th>
                                                       <th>Cantidad</th>
                                                       <th>Precio Unitario</th>
                                                       <th>Acción</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  if (mysqli_num_rows($resultDetalle) > 0) {
                                                       while ($detalle = mysqli_fetch_assoc($resultDetalle)) {
                                                  ?>
                                                            <tr>
                                                                 <td>
                                                                      <?= $detalle['NombreProductos']; ?>
                                                                      <!-- Guardamos los IDs para operar luego -->
                                                                      <input type="hidden" name="detalle[id][]" value="<?= $detalle['idDetalle']; ?>">
                                                                      <input type="hidden" name="detalle[idProductos][]" value="<?= $detalle['idProductos']; ?>">
                                                                 </td>
                                                                 <td>
                                                                      <input type="number" name="detalle[cantidad][]" value="<?= $detalle['cantidad']; ?>" class="form-control" required>
                                                                 </td>
                                                                 <td>
                                                                      <input type="number" step="0.01" name="detalle[precio_unitario][]" value="<?= $detalle['precio_unitario']; ?>" class="form-control" required>
                                                                 </td>
                                                                 <td>
                                                                      <!-- Enlace para eliminar un detalle, si se requiere -->
                                                                      <a href="crud-venta.php?deleteDetalle=<?= $detalle['idDetalle']; ?>&idCompra=<?= $venta['idCompra']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                                 </td>
                                                            </tr>
                                                  <?php
                                                       }
                                                  } else {
                                                       echo "<tr><td colspan='4'>No se encontraron detalles</td></tr>";
                                                  }
                                                  ?>
                                             </tbody>
                                        </table>
                                        <div class="col-md-6 mb-3">
                                             <button type="submit" name="btn-editar" class="btn btn-primary">Actualizar Venta</button>
                                        </div>
                                   </form>
                         <?php
                              } else {
                                   echo "<h4>No se encontró la venta</h4>";
                              }
                         }
                         ?>
                    </div>
               </div>
          </div>
     </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>