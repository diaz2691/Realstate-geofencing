<?php
session_start();
require 'databaseConnection.php';

$dbConn = getConnection();

$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql = "SELECT * FROM UsersInfo WHERE username = :username AND password = :password";
$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;
$stmt = $dbConn -> prepare($sql);
$stmt->execute($namedParameters);
//$stmt->execute();
$result = $stmt->fetch(); //We are expecting one record

if (empty($result)) {
     header("Location: index.html?error=WRONG USERNAME OR PASSWORD");
}

else {
    
    $_SESSION['userId']  = $result['userId'];
    $_SESSION['username'] = $result['username'];
    //$_SESSION['userName'] = $result['firstName'] . " " . $result['lastName'];
    //$_SESSION['userId'] = $result['userId'];
    if($result['userType'] == 1){
    	header("Location: Agent/IDXGetFeatured.php");
	}

	else if($result['userType'] == 0){
		header("Location: Admin/AdminProfile.php");
	}
    
}



?>