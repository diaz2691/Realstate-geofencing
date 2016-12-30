<?php

require('fpdf/fpdf.php');




$the_content = "Ut sagittis erat vitae nunc viverra, ut bibendum dui sodales./n In fermentum, augue vel vestibulum porttitor, lectus ipsum faucibus justo, tincidunt luctus velit odio quis orci. ";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial',' ',11);

//specify width and height of the cell Multicell(width, height, string)

$pdf->Cell(0,10,'Remax ',0,1);
$pdf->Cell(0,10,'check ',0,1);

$pdf->Output();
?>