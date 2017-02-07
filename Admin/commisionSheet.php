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
	$pdf->Output('commissionSheetTest.pdf','D');

	
	

	
}
else
{
	
	$pdf->Output();
}
?>

<script>

//console.log( "<?php  $ken; ?>");

function prepare()
{
	var token = "<?php echo $ken; ?>";

	var file = document.getElementById("filePdf").files[0];
	 var data = new FormData();
	 data.append("File", file);
	 data.append("File-Name", "Commission Sheet");

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() 
	{
	  if (this.readyState === 4 && this.status == 201) 
	  {
	  	var response = JSON.parse(xhr.responseText);
	  	
	    sendToSign(response.transientDocumentId, token);
	  }
	}

	xhr.open("POST", "https://api.na2.echosign.com/api/rest/v5/transientDocuments");
	xhr.setRequestHeader("Access-Token", token);
	// xhr.setRequestHeader("Content-Disposition", "form-data; name='File'; filename='MyPDF.pdf");
	// xhr.setRequestHeader("Content-Type", "multipart/form-data");
	xhr.send(data);
}
function sendToSign(tId, token)
{
	var data = JSON.stringify({
  	"documentCreationInfo": {
    	"fileInfos": [
      	{
        "transientDocumentId": tId
      	}
    	],
    "name": "Commission Sheet",
    "recipientSetInfos": [
      {
        "recipientSetMemberInfos": [
          {
            "email": "jodiaz@csumb.edu"
          }
        ],
        "recipientSetRole": "SIGNER"
      }
    ],
    "signatureType": "ESIGN",
    "signatureFlow": "SENDER_SIGNATURE_NOT_REQUIRED"
  }
});
	var sendDoc = new XMLHttpRequest();
	sendDoc.onreadystatechange = function()
	{
		if (this.readyState === 4 && this.status == 201) 
		{
		  	
		    window.location.href = "viewCommissionSheet.php";
		}
	}

	sendDoc.open("POST", "https://api.na2.echosign.com:443/api/rest/v5/agreements");
	sendDoc.setRequestHeader("Access-Token", token);
	sendDoc.setRequestHeader("content-type", "application/json");	

	sendDoc.send(data);
}

</script>




<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Send Commission Sheet</title>
    
    
    
    <meta charset = "utf-8"/>
 
</head>
    <body>
      <input type="file" id="filePdf" name="commSheet" size="40">
      <br />
      <br />
      <input type="submit" value="Send" onClick="prepare()">
    </body>
</html>








