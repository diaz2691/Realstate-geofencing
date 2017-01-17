<?php
    require("databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    if(isset($_POST['oldPassword'])) {
        $sql = "SELECT password FROM UsersInfo where userId = $_SESSION['userId']";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();
        //$stmt->execute();
        $results = $stmt->fetch();
        if($results['password'] == $_POST['oldPassword'] ){
            $sql = "UPDATE BuyerInfo
                 SET password = :password
                 WHERE userId = :userId";
            $namedParameters = array();
            $namedParameters[":password"] = $_POST['newPassword'];
            $namedParameters[":userId"] = $_SESSION['userId'];     
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
        }
        header("Location: index.html");
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
            <form action="login.php" method="post" class="login-form">
                <input type="text" name="oldPassword" placeholder="old password"/>
                <input type="password" name="newPassword" placeholder="new password"/>
                <input type="submit" value="change" name="loginForm" id="button"/>      
            </form>
    
    <h3 style="color:red">
    <?php
  
      if (isset($_GET['error'])) {
          
          echo $_GET['error'];
          
      }

    ?>
    </h3>



</body>
</html>