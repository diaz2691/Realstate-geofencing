<?php
session_start();
require 'databaseConnection.php';

$dbConn = getConnection();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM usersInfo WHERE username = :username AND password = :password";
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
    
    $_SESSION['username']  = $result['username'];
    //$_SESSION['adminName'] = $result['firstName'] . " " . $result['lastName'];
    if($result['userType'] == 1){
    	header("Location: Agent/AgentProfile.html");
    }
    
    
}



?>