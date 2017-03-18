<?php
require('fpdf/fpdf.php');

 
        // $data = $_GET["agentNum"];

       
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','I');
$pdf->SetFontSize(10);

$pdf->Cell(0,10,'Bay Capital Mortgage Commission Worksheet             Check #: ',0,1);
$pdf->Cell(0,10,'                                                 Beginning Gross Commissions: ',0,1);
$pdf->Cell(0,10,'Date: ',0,1);
$pdf->Cell(0,10,'Settlement Date: ',0,1);
$pdf->Cell(0,10,'Agent:',0,1);
$pdf->Cell(0,10,'Clients: ',0,1);
$pdf->Cell(0,10,'Property Address:',0,1);
$pdf->Cell(0,10,'Gross Commission:',0,1);
$pdf->Cell(0,10,'Broker Fee:',0,1);
$pdf->Cell(0,10,'Subtotal:',0,1);
$pdf->Cell(0,10,'Agent Percentage:',0,1);
$pdf->Cell(0,10,'Subtotal Comission:',0,1);
$pdf->Cell(0,10,'E&O Insurance:',0,1);
$pdf->Cell(0,10,'other:',0,1);
$pdf->Cell(0,10,'other:',0,1);
$pdf->Cell(0,10,'Agent Net Commission:',0,1);

$pdf->Output();

?>