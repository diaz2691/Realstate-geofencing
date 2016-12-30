<?php
<<<<<<< HEAD
require('fpdf/fpdf.php');
=======
require('fpdf.php');
>>>>>>> AgentAddHouse

$the_content = "Ut sagittis erat vitae nunc viverra, ut bibendum dui sodales./n In fermentum, augue vel vestibulum porttitor, lectus ipsum faucibus justo, tincidunt luctus velit odio quis orci. ";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

//specify width and height of the cell Multicell(width, height, string)
$pdf->Multicell(190,10,$the_content); 

$pdf->Output();
?>