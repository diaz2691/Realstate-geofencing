<?php
//session_start();
require '../databaseConnection.php';
session_start();
$dbConn = getConnection();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bedrooms = $_POST['bedrooms'];
$bathrooms = $_POST['bathrooms'];
$price = $_POST['price'];
$houseId = $_POST['houseId'];
$userId = $_SESSION['userId'];

$sql = "INSERT INTO BuyerInfo 
		(firstName, lastName, email, phone, bedrooms, bathrooms, price, houseId, userId)
		VALUES (:firstName, :lastName, :email, :phone, :bedrooms, :bathrooms, :price, :houseId, :userId)";
$namedParameters = array();
$namedParameters[':firstName'] = $firstName;
$namedParameters[':lastName'] = $lastName;
$namedParameters[':email'] = $email;
$namedParameters[':phone'] = $phone;
$namedParameters[':bedrooms'] = $bedrooms;
$namedParameters[':bathrooms'] = $bathrooms;
$namedParameters[':price'] = $price;
$namedParameters[':houseId'] = $houseId;
$namedParameters[':userId'] = $userId;
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
    
}*/



?>