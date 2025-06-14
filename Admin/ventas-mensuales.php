<?php
include('includes/header.php');
include('config/conexion_be.php');

// Verificar si se seleccionó un mes
$mesSeleccionado = isset($_GET['mes']) ? $_GET['mes'] : '';

// Consulta de ventas
$sql = "SELECT idCompra, fecha, total FROM compratm WHERE estado = 'completado'";

if (!empty($mesSeleccionado)) {
    $sql .= " AND DATE_FORMAT(fecha, '%Y-%m') = '$mesSeleccionado'";
}

$sql .= " ORDER BY fecha DESC";
$resultado = $con->query($sql);
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Ventas Mensuales</h1>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Registros de Ventas Mensuales</h4>

                    <!-- Filtro de mes -->
                    <form method="GET" class="d-flex align-items-center">
                        <select name="mes" class="form-select me-2">
                            <option value="">-- Seleccionar Mes --</option>
                            <?php
                            $mesesQuery = $con->query("SELECT DISTINCT DATE_FORMAT(fecha, '%Y-%m') AS mes FROM compratm ORDER BY mes DESC");
                            while ($row = $mesesQuery->fetch_assoc()) {
                                $mesValor = $row['mes']; // Ej: 2025-07
                                setlocale(LC_TIME, 'es_ES.UTF-8'); // Puede necesitar soporte en el servidor
                                $mesNombre = strftime("%B %Y", strtotime($mesValor . "-01")); // Ej: julio 2025
                                $selected = ($mesValor === $mesSeleccionado) ? 'selected' : '';
                                echo "<option value=\"$mesValor\" $selected>$mesNombre</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary">Seleccionar</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>ID Venta</th>
                                <th>Fecha</th>
                                <th>Total Vendido (S/)</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php
                            $totalGeneral = 0;
                            if ($resultado->num_rows > 0):
                                while ($fila = $resultado->fetch_assoc()):
                                    $totalGeneral += $fila['total'];
                            ?>
                                    <tr>
                                        <td><?= $fila['idCompra'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($fila['fecha'])) ?></td>
                                        <td>S/.<?= number_format($fila['total'], 2) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <tr>
                                    <td colspan="2"><strong>Total del Mes</strong></td>
                                    <td><strong>S/.<?= number_format($totalGeneral, 2) ?></strong></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No hay registros para este mes.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
include('includes/scripts.php');
?>