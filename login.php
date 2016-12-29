<?php
session_start();
require 'databaseConnection.php';

$dbConn = getConnection();

$username = $_POST['username'];
$password = sha1($_POST['password']);

$sql = "SELECT * FROM usersInfo WHERE username = :username AND password = :password";
$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;
$stmt = $dbConn -> prepare($sql);
$stmt->execute($namedParameters);
//$stmt->execute();
$result = $stmt->fetch(); //We are expecting one record

if (empty($result)) {
     header("Location: index.php?error=WRONG USERNAME OR PASSWORD");
}

else {
    
    $_SESSION['username']  = $result['username'];
    //$_SESSION['adminName'] = $result['firstName'] . " " . $result['lastName'];
    if($result['userId'] == 1){
    	header("Location: Agent/AgentProfile.html");
    }
    
    
}



?>