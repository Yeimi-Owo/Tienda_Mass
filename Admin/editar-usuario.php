<?php
include('includes/header.php');
include('config/conexion_be.php');
?>


<div class="container-fluid px-4">
     <h1 class="mt-4">Editar Usuario</h1>
     <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active"><b>TruckMAC</b></li>
          <li class="breadcrumb-item">Usuarios</li>
     </ol>
     <div class="row">
          <div class="col-md-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Editar Usuario
                              <a href="list-usuarios.php" class="btn btn-danger float-end">Volver</a>
                         </h4>
                    </div>
                    <div class="card-body">

                         <?php
                         if (isset($_GET['editid'])) {

                              $user_id = $_GET['editid'];
                              $users = "SELECT * FROM usuarios where id_usuario='$user_id' ";
                              $users_run = mysqli_query($con, $users);

                              if (mysqli_num_rows($users_run) > 0) {
                                   foreach ($users_run as $user) {

                         ?>
                                        <form action="crud-usuario.php" method="POST">
                                             <input type="text" name="user_id" value="<?= $user['id_usuario'] ?>" hidden>
                                             <div class="row">

                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Nombre Completo</label>
                                                       <input type="text" name="nombre" value="<?= $user['nombre_completo']; ?>" class="form-control">
                                                  </div>

                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Usuario</label>
                                                       <input type="text" name="usuario" value="<?= $user['usuario']; ?>" class="form-control">
                                                  </div>

                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Correo</label>
                                                       <input type="email" name="correo" value="<?= $user['correo']; ?>" class="form-control">
                                                  </div>

                                                  <div class="col-md-6 mb-3">
                                                       <label for="">Contraseña</label>
                                                       <input type="password" name="contrasena" value="<?= $user['contrasena']; ?>" class="form-control">
                                                  </div>

                                                  <div class="col-md-6 mb-3">
                                                       <button type="submit" name="btn-editar" class="btn btn-primary"> Actualizar </button>
                                                  </div>

                                             </div>

                                        </form>

                                   <?php
                                   }
                              } else {
                                   ?>
                                   <h4> No encontrado</h4>
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