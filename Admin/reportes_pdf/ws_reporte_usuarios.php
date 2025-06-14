<?php
session_start();
require '../fpdf/fpdf.php';

include('../config/conexion_be.php');
$sql = "SELECT * FROM usuarios";
$rsCli = mysqli_query($con, $sql);

ob_clean();

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L'); // Horizontal

// Encabezado institucional
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 7, utf8_decode('Truckmac'), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Correo: ventas@truckmacdg.com', 0, 1, 'C');
$pdf->Cell(0, 5, utf8_decode('Dirección: Av. Jose Galvez 199 Int. 70, La Victoria - Lima, Lima, Peru, 15018 '), 0, 1, 'C');
$pdf->Cell(0, 5, 'Telefono: 980 277 013', 0, 1, 'C');
$pdf->Ln(5);

// Título del reporte
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 7, utf8_decode('Reporte de Usuario'), 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(232, 232, 232);
$pdf->Cell(0, 6, utf8_decode('Lista de Usuarios'), 0, 1, 'C', true);
$pdf->Ln(4);

$total_width = 20 + 40 + 40 + 60;
$centerX = (297 - $total_width) / 2;

// Encabezado de tabla
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX($centerX);
$pdf->Cell(20, 6, '#', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Nombre Completo', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Usuario', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'Correo', 1, 1, 'C', 1);

// Datos del cliente
$pdf->SetFont('Arial', '', 9);
while ($row = mysqli_fetch_array($rsCli)) {
    $pdf->SetX($centerX);
    $pdf->Cell(20, 6, $row[0], 1, 0, 'C');
    $pdf->Cell(40, 6, utf8_decode($row[1]), 1, 0, 'C');
    $pdf->Cell(40, 6, utf8_decode($row[2]), 1, 0, 'C');
    $pdf->Cell(60, 6, utf8_decode($row[3]), 1, 1, 'C');
}

// Pie
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, utf8_decode('Emitido por: Sistema de Ventas'), 0, 1, 'C');
$pdf->Ln(5);

$pdf->Output();
ob_end_flush();
