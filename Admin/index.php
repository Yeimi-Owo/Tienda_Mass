<?php
//Llamar a las carpetas de base de datos, la cabezera y footer
include('includes/header.php');
include('config/dbcon.php');
?>

<head>
    <style>
        #inicio {
            width: 100vw;
            padding: 0;
            margin: 0;
        }

        #inicio .contenido {
            width: 100%;
            max-width: none;
            /* Elimina el límite si quieres que ocupe todo el ancho */
            margin: 0;
            padding: 0;
            position: relative;
        }

        .video {
            width: 100%;
            height: 50%;
            height: auto;
            object-fit: cover;
            border-radius: 0px;
        }

        .contenido-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-align: center;
            padding: 1rem;
            background-color: rgba(0, 0, 0, 0.5);
            /* fondo semitransparente para mejor lectura */
            border-radius: 10px;
            max-width: 90%;
        }

        .txtRojo {
            color: #ff4d4d;
            /* o el rojo que estés usando */
        }
    </style>
</head>
<!-- Contenedor para todo el menu principal del Intranet -->

<!-- Primera imagen de presentacion -->
<section id="inicio" class="inicio">
    <div class="contenido">
        <video class="video" src="../Controlador/img.menu/autopartes_truck.mp4" autoplay muted loop></video>
        <div class="contenido-video">
            <h2>¡Repuestos que rinden, <span class="txtRojo">clientes que vuelven!</span></h2>
            <p>"En TruckMac combinamos tecnología, atención personalizada y calidad garantizada para que cada cliente tenga lo que necesita, cuando lo necesita"</p>
        </div>
    </div>
</section>

<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><b>TruckMAC</b></li>
    </ol>
    <div class="row">
        <!-- Codigo de los Contenedores -->
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Administradores</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Miembros</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Ventas</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body">Otros</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">Ver Detalles</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Llamar a las carpetas de pie de pagina y scripts -->
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>