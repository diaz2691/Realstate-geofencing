<?php
//session_start();
require 'databaseConnection.php';

$dbConn = getConnection();

$firstName = $_GET['username'];
$lastName = $_GET['password'];
$email = $_GET['email'];
$phone = $_GET['phone'];

$sql = "INSERT INTO BuyerInfo 
		(firstName, lastName, email, phone)
		VALUES (:firstName, :lastName, :email, :phone)";
$namedParameters = array();
$namedParameters[':firstName'] = $firstName;
$namedParameters[':lastName'] = $lastName;
$namedParameters[':email'] = $email;
$namedParameters[':phone'] = $phone;
$stmt = $dbConn -> prepare($sql);
$stmt->execute($namedParameters);
//$stmt->execute();
//$result = $stmt->fetch(); //We are expecting one record

//if (empty($result)) {
 header("Location: Confirmation.php");
//}

/*else {
    
    $_SESSION['username']  = $result['username'];
    $_SESSION['adminName'] = $result['firstName'] . " " . $result['lastName'];
    $_SESSION['userId'] = $result['userId'];
    header("Location: quiz.php");
    */
}



?>