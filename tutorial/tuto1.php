<?php
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(100,100,'Hello World!');
$pdf->Output();
?>
