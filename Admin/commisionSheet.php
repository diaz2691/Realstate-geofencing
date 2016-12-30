<?php
require('fpdf.php');
define('FPDF_FONTPATH',$this->config->item('fonts_path'));
$this->load->library(array('fpdf','fpdf_rotate','pdf'));
$this->pdf->Open();
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(0);
$pdf->MultiCell(100,5,"Test\n line of text");
$pdf->Output('test.pdf', 'D');
?>