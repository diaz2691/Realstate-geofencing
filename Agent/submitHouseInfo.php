<?php
    session_start();
    require('../databaseConnection.php');
    $dbConn = getConnection();

    $sql = "INSERT INTO HouseInfo
                 (userId, status, address, city, state, zip, bedrooms, bathrooms, price)
                 VALUES (:userId, :status, :address, :city, :state, :zip, :bedrooms, :bathrooms, :price)";
          $namedParameters = array();
          $namedParameters[":userId"] = $_POST['userId'];
          $namedParameters[":status"] = $_POST['status'];
          $namedParameters[":address"] = $_POST['address'];
          $namedParameters[":city"] = $_POST['city'];
          $namedParameters[":state"] = $_POST['state'];     
          $namedParameters[":zip"] = $_POST['zip'];     
          $namedParameters[":bedrooms"] = $_POST['bedrooms'];     
          $namedParameters[":bathrooms"] = $_POST['bathrooms'];     
          $namedParameters[":price"] = $_POST['price'];     
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
          header("Location: AgentHome.php");
?>