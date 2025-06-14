<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Productos</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Registros de Productos
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Agregar Nuevo
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Stock</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $query = "SELECT * FROM productos";
                            $query_run = mysqli_query($con, $query);
                            $alertStock = false; // Variable para controlar la alerta
                            $productosBajos = []; // Array para almacenar nombres de productos con stock bajo

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    if ($row['Stock'] == 10) {
                                        $alertStock = true; // Activar alerta
                                        $productosBajos[] = $row['NombreProductos']; // Agregar nombre al array
                                    }
                            ?>
                                    <tr>
                                        <td><?= $row['idProductos']; ?></td>
                                        <td><?= $row['NombreProductos']; ?></td>
                                        <td><?= $row['Stock']; ?></td>
                                        <td>S/<?= number_format($row['Precio'], 2); ?></td>
                                        <td>
                                            <?php if (!empty($row['Foto'])) { ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($row['Foto']); ?>" width="50" height="50">
                                            <?php } else { ?>
                                                <span>Sin imagen</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="editar-producto.php?editid=<?= $row['idProductos']; ?>" class="btn btn-success" style="display: inline-block; margin-right: 5px;">Editar</a>
                                            <form action="crud-producto.php" method="POST" style="display: inline-block; margin: 0;">
                                                <button type="submit" name="btn-eliminar" value="<?= $row['idProductos']; ?>" class="btn btn-danger">Borrar</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">No se encontraron productos</td>
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

<?php if ($alertStock): ?>
    <script>
        alert('Los siguientes productos tienen stock bajo (10 unidades): <?= implode(", ", $productosBajos); ?>');
    </script>
<?php endif; ?>

<!-- Modal Registrar Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Producto</h1>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="crud-producto.php" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
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