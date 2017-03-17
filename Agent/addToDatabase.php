<?php
//session_start();
require '../databaseConnection.php';
session_start();
$dbConn = getConnection();

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bedroomsMax = $_POST['bedroomsMax'];
$bedroomsMin = $_POST['bedroomsMin'];
$bathroomsMax = $_POST['bathroomsMax'];
$bathroomsMin = $_POST['bathroomsMin'];
$priceMax = $_POST['priceMax'];
$priceMin = $_POST['priceMin'];
$houseId = $_POST['houseId'];
$userId = $_SESSION['userId'];

$sql = "INSERT INTO BuyerInfo 
		(firstName, lastName, email, phone, bedroomsMax, bedroomsMin, bathroomsMax, bathroomsMin, priceMax, priceMin, houseId, userId)
		VALUES (:firstName, :lastName, :email, :phone, :bedroomsMax, :bedroomsMin, :bathroomsMax, :bathroomsMin, :priceMax, :priceMin, :houseId, :userId)";
$namedParameters = array();
$namedParameters[':firstName'] = $firstName;
$namedParameters[':lastName'] = $lastName;
$namedParameters[':email'] = $email;
$namedParameters[':phone'] = $phone;
$namedParameters[':bedroomsMax'] = $bedroomsMax;
$namedParameters[':bedroomsMin'] = $bedroomsMin;
$namedParameters[':bathroomsMax'] = $bathroomsMax;
$namedParameters[':bathroomsMin'] = $bathroomsMin;
$namedParameters[':priceMax'] = $priceMax;
$namedParameters[':priceMin'] = $priceMin;
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