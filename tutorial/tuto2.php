<?php
require('../fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('cer.jpg',5,6,200);
	// Arial bold 15
	$this->SetFont('Arial','',9);
	// Title
	$this->Cell(90,60,'CIF/17072019/0433',0,0,'C');
	// Line break
	$this->Ln(2);
	$this->Cell(190,106,'Chandra Bhushan Sharma',0,0,'C');
	$this->Ln(8);
	$this->SetFont('Arial','',12);
	$this->Cell(190,116,'Rs. 1,00,000.00/ (RUPEE ONE LAKH ONLY)',0,0,'C');
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Output();
?>
