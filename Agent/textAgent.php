<?php
require("../databaseConnection.php");

require('../keys/tKey.php');
require('../twilio-php-master/Twilio/autoload.php');
use Twilio\Rest\Client;


$dbConn = getConnection();

$sqls = "SELECT userId, firstName, lastName, phone FROM BuyerInfo WHERE buyerID =" . $_POST['buyerID'];
$stmts = $dbConn -> prepare($sqls);
$stmts->execute();       
$counter = $stmts->fetch();

$agentOne = "SELECT firstName, lastName FROM UsersInfo WHERE userId =" . $counter['userId'];
$stmt = $dbConn -> prepare($agentOne);
$stmt->execute();       
$agent = $stmt->fetch();



$agentTwo = "SELECT firstName, lastName FROM UsersInfo WHERE userId =" . $_POST['agentId'];
$stmt = $dbConn -> prepare($agentTwo);
$stmt->execute();       
$curAgent = $stmt->fetch();


$twilio_phone_number = "+18315851661";

$client = new Client($account_sid, $auth_token);
// $client->account->messages->create(
// $agent['phone'],
// array(
// "From" => $twilio_phone_number,
// "Body" => "Hey " . $agent['firstName'] . " " . $agent['lastName'] . " This is " . $curAgent['firstName'] . " " . $curAgent['lastName'] . 
// ". I have a house that " . $counter['firstName'] . " " . $counter['lastName'] . " might be interested in. 
// Call me at: " . $curAgent['phone'] ,
// ));







?>