<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Editar Promoción</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMAC</b></li>
          <li class="breadcrumb-item">Promociones</li>
     </ol>
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Editar Promoción
                              <a href="list-promociones.php" class="btn btn-danger float-end">Volver</a>
                         </h4>
                    </div>
                    <div class="card-body">
                         <?php
                         if (isset($_GET['editid'])) {
                              $promo_id = $_GET['editid'];
                              $sql = "SELECT * FROM planes WHERE id_planes='$promo_id'";
                              $promocion_run = mysqli_query($con, $sql);

                              if (mysqli_num_rows($promocion_run) > 0) {
                                   foreach ($promocion_run as $promocion) {
                         ?>
                                        <form action="crud-promocion.php" method="POST" enctype="multipart/form-data">
                                             <input type="hidden" name="id" value="<?= $promocion['id_planes']; ?>">
                                             <div class="row">
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Nombre de la Promoción</label>
                                                       <input type="text" name="nombre" value="<?= $promocion['nombre']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Descripción</label>
                                                       <input type="text" name="descripcion" value="<?= $promocion['descripcion']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Precio</label>
                                                       <input type="number" name="precio" value="<?= $promocion['precio']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Detalles</label>
                                                       <input type="text" name="detalles" value="<?= $promocion['detalles']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <button type="submit" name="btn-editar" class="btn btn-primary">Actualizar</button>
                                                  </div>
                                             </div>
                                        </form>
                                   <?php
                                   }
                              } else {
                                   ?>
                                   <h4>No encontrado</h4>
                         <?php
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