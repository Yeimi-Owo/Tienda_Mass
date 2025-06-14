<?php
include('includes/header.php');
include('config/conexion_be.php');
?>

<div class="container-fluid px-4">
     <h1 class="mt-4">Usuarios</h1>
     <hr>
     <div class="row">
          <div class="col-md-12">
               <?php include('message.php'); ?>
               <div class="card">
                    <div class="card-header">
                         <h4>Registro de Usuarios
                              <a target="_blank" href="reportes_pdf/ws_reporte_usuarios.php">
                                   <button type="button" class="btn btn-success"><i class="fa-solid fa-file-pen"></i>Exportar</button>
                              </a>
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
                                        <th>Nombre Completo</th>
                                        <th>Usuario</th>
                                        <th>Correo Electrónico</th>
                                        <th>Contraseña</th>
                                        <th>Acción</th>
                                   </tr>
                              </thead>
                              <tbody style="text-align: center;">
                                   <?php
                                   $query = "SELECT * FROM usuarios";
                                   $query_run = mysqli_query($con, $query);
                                   if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                   ?>
                                             <tr>
                                                  <td><?= $row['id_usuario']; ?></td>
                                                  <td><?= $row['nombre_completo']; ?></td>
                                                  <td><?= $row['usuario']; ?></td>
                                                  <td><?= $row['correo']; ?></td>
                                                  <td><?= str_repeat('*', strlen($row['contrasena'])); ?></td>
                                                  <td>
                                                       <a href="editar-usuario.php?editid=<?= $row['id_usuario']; ?>" class="btn btn-success" style="display: inline-block; margin-right: 5px;">Editar</a>
                                                       <form action="crud-usuario.php" method="POST" style="display: inline-block; margin: 0;">
                                                            <button type="submit" name="btn-eliminar" value="<?= $row['id_usuario']; ?>" class="btn btn-danger">Borrar</button>
                                                       </form>
                                                  </td>
                                             </tr>

                                        <?php
                                        }
                                   } else {
                                        ?>
                                        <tr>
                                             <td coldspan="6">No encontrado</td>
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

<!-- Modal Registrar-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
               </div>
               <div class="modal-body">
                    <form class="row g-3" method="post" action="crud-usuario.php" id="form-registrar">
                         <div class="col-md-12">
                              <label for="inputState" class="form-label">Nombre Completo</label>
                              <input type="text" class="form-control" id="txt-nombre" placeholder="Ingresar nombre" name="nombre" required>
                         </div>
                         <div class="col-md-12">
                              <label for="inputState" class="form-label">Usuario</label>
                              <input type="text" class="form-control" id="txt-usuario" placeholder="Ingresar usuario" name="usuario" required>
                         </div>
                         <div class="col-md-12">
                              <label for="inputZip" class="form-label">Correo Electrónico</label>
                              <input type="email" class="form-control" id="txt-correo" placeholder="Ingresar correo" name="correo" required>
                         </div>
                         <div class="col-md-12">
                              <label for="inputZip" class="form-label">Contraseña</label>
                              <input type="password" class="form-control" id="txt-contraseña" placeholder="Ingresar contraseña" name="contrasena" required>
                         </div>
                         <!--boton para Guardar registro-->
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                              <button type="submit" name="btn-agregar" class="btn btn-primary">Guardar</button>
                         </div>
                         <!--boton para Guardar registro-->
                    </form>
               </div>
          </div>
     </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>