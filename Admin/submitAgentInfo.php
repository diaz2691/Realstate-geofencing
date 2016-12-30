<?php
    session_start();
    require('../databaseConnection.php');
    $dbConn = getConnection();

    $sql = "INSERT INTO UsersInfo
                 (username, password, firstName, lastName, email, phone, license)
                 VALUES (:username, :password, :firstName, :lastName, :email, :phone, :license)";
          $namedParameters = array();
          $namedParameters[":username"] = $_POST['username'];
          $namedParameters[":password"] = $_POST['password'];
          $namedParameters[":firstName"] = $_POST['firstName'];
          $namedParameters[":lastName"] = $_POST['lastName'];     
          $namedParameters[":email"] = $_POST['email'];     
          $namedParameters[":phone"] = $_POST['phone'];     
          $namedParameters[":license"] = $_POST['license'];   
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
          header("Location: viewAgents.php");
?>