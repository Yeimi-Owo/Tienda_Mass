<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Pedidos</h1>
     <hr>
     <div class="row">
          <div class="col-md-12">
               <?php include('message.php'); ?>
               <div class="card">
                    <div class="card-header">
                         <h4>
                              Registros de Pedidos
                              <!--  
                             Si deseas agregar ventas manualmente (aunque generalmente se generan automáticamente)
                             puedes habilitar el botón de "Agregar Nuevo" y crear un modal para ello.
                             -->
                         </h4>
                    </div>
                    <div class="card-body">
                         <table class="table table-bordered" style="text-align: center;">
                              <thead>
                                   <tr>
                                        <th>Nombre Completo</th>
                                        <th>Fecha</th>
                                        <th>Dirección</th>
                                        <th>Método de Pago</th>
                                        <th>Correo Electrónico</th>
                                        <th>Estado</th>
                                        <th>Total</th>
                                        <th>Acción</th>
                                   </tr>
                              </thead>
                              <tbody style="text-align: center;">
                                   <?php
                                   // Consulta para obtener las ventas de la tabla compratm
                                   $query = "SELECT 
                                             p.idCompra,
                                             p.id_usuario,
                                             p.estado,
                                             c.fecha,
                                             c.direccion,
                                             c.metodo_pago,
                                             c.correo,
                                             c.total,
                                             u.nombre_completo
                                        FROM 
                                             pedidos p
                                        JOIN 
                                             compratm c ON p.idCompra = c.idCompra
                                        JOIN 
                                             usuarios u ON u.id_usuario = p.id_usuario;";
                                   $query_run = mysqli_query($con, $query);

                                   if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                   ?>
                                             <tr>
                                                  <td><?= $row['nombre_completo']; ?></td>
                                                  <td><?= $row['fecha']; ?></td>
                                                  <td><?= $row['direccion']; ?></td>
                                                  <td><?= $row['metodo_pago']; ?></td>
                                                  <td><?= $row['correo']; ?></td>
                                                  <td><?= $row['estado']; ?></td>
                                                  <td>S/<?= number_format($row['total'], 2); ?></td>
                                                  <td>
                                                       <!-- Botón para ver detalles de la venta con el parámetro id -->
                                                       <a href="list-detalle-pedido.php?id=<?= $row['idCompra']; ?>"
                                                            class="btn btn-primary"
                                                            style="display:inline-block; margin-right:5px;">
                                                            Ver Detalles
                                                       </a>

                                                       <!-- Opción para editar (por ejemplo, cambiar el estado) -->
                                                       <a href="editar-pedido.php?editid=<?= $row['idCompra']; ?>"
                                                            class="btn btn-success"
                                                            style="display:inline-block; margin-right:5px;">
                                                            Editar
                                                       </a>
                                                  </td>
                                             </tr>
                                        <?php
                                        }
                                   } else {
                                        ?>
                                        <tr>
                                             <td colspan="7">No se encontraron ventas</td>
                                        </tr>
                                   <?php
                                   }
                                   ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<!-- Modal para Agregar Nueva Venta (opcional, si tu aplicación requiere ingresar ventas manualmente) -->
<div class="modal fade" id="agregarVentaModal" tabindex="-1" aria-labelledby="agregarVentaModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="agregarVentaModalLabel">Nueva Venta</h1>
               </div>
               <div class="modal-body">
                    <form class="row g-3" method="post" action="crud-venta.php" id="form-agregar-venta">
                         <div class="col-md-12">
                              <label class="form-label">ID Usuario</label>
                              <input type="number" class="form-control" name="id_usuario" required>
                         </div>
                         <div class="col-md-12">
                              <label class="form-label">Estado</label>
                              <select class="form-select" name="estado" required>
                                   <option value="pendiente" selected>Pendiente</option>
                                   <option value="completado">Completado</option>
                                   <option value="cancelado">Cancelado</option>
                              </select>
                         </div>
                         <div class="col-md-12">
                              <label class="form-label">Total</label>
                              <input type="number" step="0.01" class="form-control" name="total" required>
                         </div>
                         <!-- Si deseas permitir ingresar manualmente la fecha, inclúyela aquí -->
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                              <button type="submit" name="btn-agregar" class="btn btn-primary">Guardar</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>