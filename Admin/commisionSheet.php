<?php




require('fpdf/fpdf.php');

 if(isset($_GET["agentNum"]))
    {

        $data = $_GET["agentNum"];

        if($data == 0)
        {
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Times','I');
            $pdf->SetFontSize(10);

            $pdf->Cell(0,10,'Re/MAX Property Experts Commission Breakdown',0,1);
            $pdf->Cell(0,10,'Date:  12/05/16                                                                       Total Year to Date Gross: $25,000.00',0,1);
            $pdf->Cell(0,10,'Check # 1546                                                                           Agent Final Year to Date Gross Comission: $19,651.00',0,1);
            $pdf->Cell(0,10,'Settlement Date: 12/05/16',0,1);
            $pdf->Cell(0,10,'Agent: Carlos Mejia ',0,1);
            $pdf->Cell(0,10,'Clients: 2 ',0,1);
            $pdf->Cell(0,10,'Property Address: 1234 Sol Dr., Salinas CA, 93906 ',0,1);
            $pdf->Cell(0,10,' ',0,1);
            $pdf->Cell(0,10,'                        Agent Initial Gross Commission: $25,000 ',0,1);
            $pdf->Cell(0,10,'                        Remax/Broker Fee: $5,000.00 ',0,1);
            $pdf->Cell(0,10,'                        Agent Subtotal: $20,000',0,1);
            $pdf->Cell(0,10,'                        Processing Fee: $200.00  Flat fee fixed ',0,1);
            $pdf->Cell(0,10,'                        TC. Tech Fee:  $50.00  Flat fee fixed ',0,1);
            $pdf->Cell(0,10,'                        E&O Insurance:  $99.00  Flat fee fixed ',0,1);
            $pdf->Cell(0,10,'                        Other Fees:  ',0,1);
            $pdf->Cell(0,10,' ',0,1);
            $pdf->Cell(0,10,'                        Agents Final Commission:  $19,651.00 ',0,1);
            $pdf->Cell(0,10,'',0,1);
            $pdf->SetFont('Times','BI',14);
            $pdf->Cell(0,10,'                                                               Have READ & APPROVED this Commission Worksheet ',0,1);
            $pdf->SetFontSize(10);
            $pdf->Cell(0,10,'',0,1);
            $pdf->Cell(0,10,'',0,1);
            $pdf->Cell(0,10,'Agent Signature                              Date                                     Owner and/or Broker Signature                                         Date',0,1);
            $pdf->Cell(0,10,'                                                                                                Ending Gross Commission ',0,1);

            $pdf->Output();
        }

    }
else{

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
$pdf->Cell(0,10,'                        Agent Initial Gross Commission: ',0,1);
$pdf->Cell(0,10,'                        Remax/Broker Fee: ',0,1);
$pdf->Cell(0,10,'                        Agent Subtotal: ',0,1);
 $pdf->Cell(0,10,'                        Processing Fee: $200.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        TC. Tech Fee:  $50.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        E&O Insurance:  $99.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        Other Fees:  ',0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'                        Agents Final Commission:   ',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','BI',14);
$pdf->Cell(0,10,'                                                               Have READ & APPROVED this Commission Worksheet ',0,1);
$pdf->SetFontSize(10);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'Agent Signature                              Date                                     Owner and/or Broker Signature                                         Date',0,1);
$pdf->Cell(0,10,'                                                                                                Ending Gross Commission ',0,1);

$pdf->Output();
}
?>