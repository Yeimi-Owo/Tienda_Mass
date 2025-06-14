<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Editar Producto</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMAC</b></li>
          <li class="breadcrumb-item">Productos</li>
     </ol>
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Editar Producto
                              <a href="list-productos.php" class="btn btn-danger float-end">Volver</a>
                         </h4>
                    </div>
                    <div class="card-body">
                         <?php
                         if (isset($_GET['editid'])) {
                              $producto_id = $_GET['editid'];
                              $productos = "SELECT * FROM productos WHERE idProductos='$producto_id'";
                              $productos_run = mysqli_query($con, $productos);

                              if (mysqli_num_rows($productos_run) > 0) {
                                   foreach ($productos_run as $producto) {
                         ?>
                                        <form action="crud-producto.php" method="POST" enctype="multipart/form-data">
                                             <input type="hidden" name="id" value="<?= $producto['idProductos']; ?>">
                                             <div class="row">
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Nombre del Producto</label>
                                                       <input type="text" name="nombre" value="<?= $producto['NombreProductos']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Stock</label>
                                                       <input type="number" name="stock" value="<?= $producto['Stock']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Precio</label>
                                                       <input type="number" name="precio" value="<?= $producto['Precio']; ?>" class="form-control" required>
                                                  </div>
                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Imagen</label>
                                                       <input type="file" name="foto" class="form-control">
                                                       <?php if (!empty($producto['Foto'])) { ?>
                                                            <img src="data:image/jpeg;base64,<?= base64_encode($producto['Foto']); ?>" width="100">
                                                       <?php } ?>
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