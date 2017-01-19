<?php
//FIGURE OUT ERROR FOR CHANGING PASSWORD 
    session_start();
    require 'databaseConnection.php'; 
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    if(isset($_POST['oldPassword'])) {
        $sql = "SELECT password FROM UsersInfo where userId = :userId";
        $namedParameters = array();
        $namedParameters[":userId"] = $_SESSION['userId'];
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute($namedParameters);
        $results = $stmt->fetch();
        echo $results['password'];
        /*if($results['password'] == $_POST['oldPassword'] ){
            $sql = "UPDATE BuyerInfo
                 SET password = :password
                 WHERE userId = :userId";
            $namedParameters = array();
            $namedParameters[":password"] = $_POST['newPassword'];
            $namedParameters[":userId"] = $_SESSION['userId'];     
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
        }*/
        //header("Location: index.html");
    }
 ?>
<!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><html>

<head>
    <link rel="stylesheet" type="text/css" href="login.css">
    <style type="text/css">
        h1{
            text-align: center;
            font-family: "Roboto", sans-serif;
        }
    </style>
    <title></title>
</head>
<body>
    <div class="login-page">
        <h1> Change Password </h1>
        <div class="form">
            <form action="changePassword.php" method="post" class="login-form">
                <input type="password" name="oldPassword" placeholder="old password"/>
                <input type="password" name="newPassword" placeholder="new password"/>
                <input type="submit" value="enter" name="loginForm" id="button"/>      
            </form>
</body>
</html>