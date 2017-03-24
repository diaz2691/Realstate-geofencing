<?php

$sql = "INSERT INTO LoanInfo
                  (clients, settlementDate, checkNum, address, grossComm, percentage, netComm)
                  VALUES (:clients, :settlementDate, :checkNum, :address, :grossComm, :percentage, :netComm)";
           $namedParameters = array();

          $namedParameters[":clients"] = " ";
              
          $namedParameters[":settlementDate"] = $_POST['settlementDate'];     
          $namedParameters[":checkNum"] = $_POST['checkNum'];   

          $namedParameters[":address"] = $_POST['houseId'];     
          

          $namedParameters[":grossComm"] =  $_POST['commission'];   
          $namedParameters[":percentage"] = $_POST['precent'];

          $namedParameters[":netComm"] =  1000;   
          
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters); 

        

?>
