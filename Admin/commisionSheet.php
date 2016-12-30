<?php

require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','I');
$pdf->SetFontSize(10);

$pdf->Cell(0,10,'Re/MAX Property Experts Commission Breakdown                                                                      Check # ',0,1);
$pdf->Cell(0,10,'Date ',0,1);
$pdf->Cell(0,10,'Settlement Date ',0,1);
$pdf->Cell(0,10,'Agent ',0,1);
$pdf->Cell(0,10,'Clients ',0,1);
$pdf->Cell(0,10,'Property Address ',0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'Gross Commission ',0,1);
$pdf->Cell(0,10,'Broker Fee ',0,1);
$pdf->Cell(0,10,'Subtatal ',0,1);
$pdf->Cell(0,10,'Transaction Coordinator ',0,1);
$pdf->Cell(0,10,'TC. Tech Fee ',0,1);
$pdf->Cell(0,10,'E&O Insurance ',0,1);
$pdf->Cell(0,10,'Remax ',0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'Agent Net Commission ',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','BI',14);
$pdf->Cell(0,10,'                                                                                                Have READ & APPROVED this Commission Worksheet ',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'Agent Signature                              Date                                     Owner and/or Broker Signature                                         Date',0,1);
$pdf->Cell(0,10,'                                                                                       Ending Gross Commission ',0,1);

$pdf->Output();
?>