<?php
include('includes/header.php');
include('config/conexion_be.php');

if (isset($_POST['btn-editar'])) {
     $pedido_id = $_POST['idPedido'];
     $estado = $_POST['estado'];

     $query = "UPDATE pedidos SET estado = '$estado' WHERE idPedido = '$pedido_id'";

     $query_run = mysqli_query($con, $query);

     if ($query_run) {
          echo "<script>alert('pedido actualizado satisfactoriamente');</script>";
          echo "<script>window.location.href='list-pedidos.php'</script>";
     } else {
          echo "<script>alert('Hubo un error.');</script>";
          echo "<script>window.location.href='list-pedidos.php'</script>";
     }
}
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Editar Pedido</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMac</b></li>
          <li class="breadcrumb-item">Pedidos</li>
     </ol>
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Editar Pedido
                              <a href="list-ventas.php" class="btn btn-danger float-end">Volver</a>
                         </h4>
                    </div>
                    <div class="card-body">
                         <?php
                         if (isset($_GET['editid'])) {
                              $venta_id = $_GET['editid'];
                              // Consultar cabecera de la venta
                              $queryVenta = "SELECT * FROM pedidos WHERE idCompra='$venta_id'";
                              $resultVenta = mysqli_query($con, $queryVenta);

                              if (mysqli_num_rows($resultVenta) > 0) {
                                   $venta = mysqli_fetch_assoc($resultVenta);
                         ?>
                                   <form action="editar-pedido.php" method="POST">
                                        <!-- Cabecera de la venta -->
                                        <input type="hidden" name="idPedido" value="<?= $venta['idPedido']; ?>">
                                        <div class="row">
                                             <div class="col-md-6 mb-3">
                                                  <label for="">ID Usuario</label>
                                                  <input type="text" name="id_usuario" value="<?= $venta['id_usuario']; ?>" class="form-control" readonly>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Dirección</label>
                                                  <input type="text" name="direccion" value="<?= $venta['direccion']; ?>" class="form-control" readonly>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Método de Pago</label>
                                                  <input type="text" name="metodo_pago" value="<?= $venta['metodo_pago']; ?>" class="form-control" readonly>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Correo</label>
                                                  <input type="text" name="correo" value="<?= $venta['correo']; ?>" class="form-control" readonly>
                                             </div>
                                             <div class="col-md-6 mb-3">
                                                  <label for="">Estado</label>
                                                  <select name="estado" class="form-select" required>
                                                       <option value="pendiente" <?= ($venta['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                                       <option value="en preparación" <?= ($venta['estado'] == 'en preparación') ? 'selected' : ''; ?>>En Preparación</option>
                                                       <option value="enviado" <?= ($venta['estado'] == 'enviado') ? 'selected' : ''; ?>>Enviado</option>
                                                  </select>
                                             </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                             <button type="submit" name="btn-editar" class="btn btn-primary">Actualizar Pedido</button>
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