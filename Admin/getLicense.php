<?php
    session_start();
    require('../databaseConnection.php');
    $dbConn = getConnection();

    $sql = "SELECT 1 FROM commInfo WHERE license = :license";
          $namedParameters = array();
          $namedParameters[":license"] = $_POST['license']; 

          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
    

  
?>