<?php
require("../databaseConnection.php");

require('../keys/tKey.php');
require('../twilio-php-master/Twilio/autoload.php');
use Twilio\Rest\Client;


$dbConn = getConnection();

$sqls = "SELECT userId, firstName, lastName, phone FROM BuyerInfo WHERE houseId =" . $_POST['houseId'];
$stmts = $dbConn -> prepare($sqls);
$stmts->execute();       
$counter = $stmts->fetchAll();

// $sql = "SELECT firstName, lastName FROM UsersInfo WHERE userId =" . $counter['userId'];
// $stmt = $dbConn -> prepare($sql);
// $stmt->execute();       
//$agent = $stmt->fetchAll();



// $sql = "SELECT firstName, lastName FROM UsersInfo WHERE userId =" . $_POST['agentId'];
// $stmt = $dbConn -> prepare($sql);
// $stmt->execute();       
//$curAgent = $stmt->fetchAll();


// $twilio_phone_number = "+18315851661";

// $client = new Client($account_sid, $auth_token);
// $client->account->messages->create(
// $agent['phone'],
// array(
// "From" => $twilio_phone_number,
// "Body" => "Hey " . $agent['firstName'] . " " . $agent['lastName'] . " This is " . $curAgent['firstName'] . " " . $curAgent['lastName'] . 
// ". I have a house that " . $counter['firstName'] . " " . $counter['lastName'] . " might be interested in. 
// Call me at: " . $curAgent['phone'] ,
// ));







?>