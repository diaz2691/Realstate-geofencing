<?php
require("../databaseConnection.php");
require("../keys/refreshKeyAdobe.php");
require("../keys/pass.php");
session_start();
$dbConn = getConnection();
$commId;
if(!isset($_GET['commId']))
{
	$commId = $_POST['id'];
}
else
{
	$commId = $_GET['commId'];
}

$sqlAgent = "SELECT * FROM commInfo  WHERE commId = '" . $commId . "'";
$stmtAgent = $dbConn -> prepare($sqlAgent);
$stmtAgent->execute();
$comm = $stmtAgent->fetch();






require('fpdf/fpdf.php');

 
        // $data = $_GET["agentNum"];

       
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','I');
$pdf->SetFontSize(10);

$pdf->Cell(0,10,'Re/MAX Property Experts Commission Breakdown',0,1);
$pdf->Cell(0,10,'Date:  ' . date("d-m-Y", strtotime($comm['date'])) .'                                                                     Total Year to Date Gross: $' . $comm['TYGross'],0,1);
$pdf->Cell(0,10,'Check # '. $comm['checkNum'] .'                                                                           Agent Final Year to Date Gross Comission: $' . $comm['FYGross'],0,1);
$pdf->Cell(0,10,'Settlement Date: ' . date("d-m-Y", strtotime($comm['settlementDate'])),0,1);
$pdf->Cell(0,10,'Agent:  ' . $comm['firstName'] . " " . $comm['lastName'],0,1);
$pdf->Cell(0,10,'Clients:  ',0,1);
$pdf->Cell(0,10,'Property Address: ' . $comm['address'] . ", " . $comm['city'] . " " . $comm['state'] . " " . $comm['zip']  ,0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'                        Agent Initial Gross Commission: $' . $comm['InitialGross'],0,1);
$pdf->Cell(0,10,'                        Remax/Broker Fee: $' . $comm['brokerFee'],0,1);
$pdf->Cell(0,10,'                        Agent Subtotal: $' . ($comm['InitialGross'] - $comm['brokerFee']),0,1);
$pdf->Cell(0,10,'                        Processing Fee: $200.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        TC. Tech Fee:  $50.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        E&O Insurance:  $99.00  Flat fee fixed ',0,1);
$pdf->Cell(0,10,'                        Other Fees:  ',0,1);
$pdf->Cell(0,10,' ',0,1);
$pdf->Cell(0,10,'                        Agents Final Commission:  $' . $comm['finalComm'],0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->SetFont('Times','BI',14);
$pdf->Cell(0,10,'                                                               Have READ & APPROVED this Commission Worksheet ',0,1);
$pdf->SetFontSize(10);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'Agent Signature                              Date                                     Owner and/or Broker Signature                                         Date',0,1);




if(isset($_POST['id']))
{
	
	//$pdf->Output('commissionSheetTest'.$_POST['id'].'.pdf','D' );

	$base = $pdf->Output('','s');
	//$json = json_encode($base);

	//echo base64_encode($base);
	$document = base64_encode($base);

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://demo.docusign.net/restapi/v2/accounts/2837693/envelopes",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{emailSubject:DocuSign REST API Quickstart Sample,emailBlurb: Shows how to create and send an envelope from a document.,recipients: {signers: [{email: jodiaz@csumb.edu,name: Jose Diaz,recipientId: 1,routingOrder: 1}]},documents\: [{documentId: 1,name: test.pdf,documentBase64: " . $document."}],status: sent}",
	  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json",
    "x-docusign-authentication: { \"Username\":" . $username . ",\"Password\":" . $password .",\"IntegratorKey\":" . $intKey . " }"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

	//$sqlAddDate = "INSERT INTO commInfo (date) VALUES (:date) WHERE commId =" . $_POST['commID'];
 	//$sqlAddDate = "UPDATE commInfo SET date = :date WHERE commId =" . $_POST['commID'];
    //$namedParameters[":date"] = date("Y-m-d");

// 	$stmt = $dbConn -> prepare($sqlAddDate);
//     $stmt->ex
	
}
// elseif (isset($_POST['token'])) 
// {
// 	$ken = $_POST['token'];

// 	$sqlAddDate = "INSERT INTO commInfo (date) VALUES (:date) WHERE commId =" . $_POST['commID'];
// 	//$sqlAddDate = "UPDATE commInfo SET date = :date WHERE commId =" . $_POST['commID'];
// 	$namedParameters[":date"] = date("Y-m-d");

// 	$stmt = $dbConn -> prepare($sqlAddDate);
//     $stmt->execute($namedParameters);  
// }
else
{
	
	$pdf->Output();
}
?>

 



