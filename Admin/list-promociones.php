<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Promociones</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Registros de Promociones
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
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Detalles</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $query = "SELECT * FROM planes";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><?= $row['id_planes']; ?></td>
                                        <td><?= $row['nombre']; ?></td>
                                        <td><?= $row['descripcion']; ?></td>
                                        <td>S/<?= number_format($row['precio'], 2); ?></td>
                                        <td><?= $row['detalles']; ?></td>
                                        <td>
                                            <a href="editar-promocion.php?editid=<?= $row['id_planes']; ?>" class="btn btn-success" style="display: inline-block; margin-right: 5px;">Editar</a>
                                            <form action="crud-promocion.php" method="POST" style="display: inline-block; margin: 0;">
                                                <button type="submit" name="btn-eliminar" value="<?= $row['id_planes']; ?>" class="btn btn-danger">Borrar</button>
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

<!-- Modal Registrar Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Promoción</h1>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="post" action="crud-promocion.php" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label class="form-label">Nombre de la Promoción</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Detalles</label>
                        <input type="text" class="form-control" name="detalles">
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