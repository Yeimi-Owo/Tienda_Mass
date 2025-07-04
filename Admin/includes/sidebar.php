<!-- Barra lateral de opciones del Intranet -->
<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <!-- Codigo para inicio (Panel de control/Administradores) -->
                <a class="nav-link pt-4" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Panel de Control
                </a>
                <a class="nav-link" href="list-administradores.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-lock"></i></div>
                    Administradores
                </a>
                <a class="nav-link" href="list-usuarios.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-user"></i></div>
                    Usuarios
                </a>
                <a class="nav-link" href="list-productos.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-shopping-cart"></i></div>
                    Productos
                </a>
                <a class="nav-link" href="list-pedidos.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-truck"></i></div>
                    Pedidos
                </a>
                <!-- Codigo para las ventas -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Ventas
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="list-ventas.php">Registro de Ventas</a>
                        <a class="nav-link" href="ventas-mensuales.php">Ventas Mensuales</a>
                    </nav>
                </div>
                <a class="nav-link" href="list-promociones.php">
                    <div class="sb-nav-link-icon"><i class="fa fa-exclamation-circle"></i></div>
                    Promociones
                </a>
                <!-- Separación -->
                <div class="sb-sidenav-menu-heading">Otros</div>
                <!-- Notificaciones(Falta implementarlo) -->
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa fa-bell"></i></div>
                    Notificaciones
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <!-- Registrado por el nombre SILHOUETTE GYM (Marca de agua) -->
            <div class="small">Conectado por</div>
            <b>TruckMAC</b>
        </div>
    </nav>
</div>