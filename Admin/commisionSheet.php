<?php
require("../databaseConnection.php");
require("../keys/refreshKeyAdobe.php");
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



if(isset($_POST['token']))
{
	$ken = $_POST['token'];
	$path = "../keys/". $_POST['commId'] . ".pdf";

	$pdfFile = $pdf->Output($path,"F");

	if (file_exists($$path)) 
	{
    echo "The file $filename exists";
	} else 
	{
	    echo "The file $filename does not exist";
	}
	// echo $pdfFile;

	// $file = 'path/to/PDF/file.pdf';
	//   $filename = 'filename.pdf';
	//   header('Content-type: application/pdf');
	//   header('Content-Disposition: inline; filename="' . $filename . '"');
	//   header('Content-Transfer-Encoding: binary');
	//   header('Accept-Ranges: bytes');
	//   @readfile($file);

	//echo "<iframe src=" . $path . " width=100% style=height:100%></iframe>";

	// $pdfFile = file_get_contents($pdf->Output($_POST['commId'] . ".pdf","F"));
	// $encoded = base64_encode($pdfFile);
	// $decoded = base64_decode($encoded);
	
	// $file = $pdf;
	// $filename = 'filename.pdf';
	// header('Content-type: application/pdf');
	// header('Content-Disposition: inline; filename="' . $filename . '"');
	// header('Content-Transfer-Encoding: binary');
	// header('Accept-Ranges: bytes');
	// @readfile($file);

	// $request = new HttpRequest();
	// $request->setUrl('https://api.na2.echosign.com/api/rest/v5/transientDocuments');
	// $request->setMethod(HTTP_METH_POST);

	// $request->setHeaders(array(
	//   'access-token' => $ken,
	//   'content-type' => 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW'
	// ));

	// $request->setBody('------WebKitFormBoundary7MA4YWxkTrZu0gW
	// Content-Disposition: form-data; name="File-Name"

	// commission Sheet
	// ------WebKitFormBoundary7MA4YWxkTrZu0gW
	// Content-Disposition: form-data; name="File"; filename="'. $_ .'.pdf"
	// Content-Type: application/pdf


	// ------WebKitFormBoundary7MA4YWxkTrZu0gW--');

	// try {
	//   $response = $request->send();

	//   echo $response->getBody();
	// } catch (HttpException $ex) {
	//   echo $ex;
	// }

	
}
else
{
	
	$pdf->Output();
}
?>

<script>

//console.log( "<?php  $ken; ?>");


// var data = new FormData();
// data.append("File", "<?php $file_contents ?>");
// data.append("File-Name", "Commission Sheet");

// var xhr = new XMLHttpRequest();
// xhr.onreadystatechange = function() 
// {
//   if (this.readyState === 4 ) 
//   {
//   	var response = JSON.parse(xhr.responseText);
//   	console.log(response);
//     console.log("TRANS" + this.transientDocumentId);
//   }
// }

// xhr.open("POST", "https://api.na2.echosign.com/api/rest/v5/transientDocuments");
// xhr.setRequestHeader("Access-Token", "<?php echo $ken; ?>");
// //xhr.setRequestHeader("Content-Type", "multipart/form-data");
// xhr.send(data);



</script>













