<?php

//Mensaje de aviso para loguearse o registrase

if(isset($_SESSION['message']))

{
    ?>
        <!-- Diseño del mensaje -->
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong></strong> <?= $_SESSION['message']; ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    <?php
    unset($_SESSION['message']);
}
?>


