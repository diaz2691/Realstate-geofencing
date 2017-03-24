<?php

$sql = "INSERT INTO LoanInfo
                  (clients, settlementDate, checkNum, address, grossComm, percentage, netComm)
                  VALUES (:clients, :settlementDate, :checkNum, :address, :grossComm, :percentage, :netComm)";
           $namedParameters = array();

          $namedParameters[":clients"] = $$_POST['clients'];
              
          $namedParameters[":settlementDate"] = $_POST['settlementDate'];     
          $namedParameters[":checkNum"] = $_POST['checkNum'];   

          $namedParameters[":address"] = $houseResults['address'];     
          

          $namedParameters[":grossComm"] =  $_POST['grossComm'];   
          $namedParameters[":percentage"] = $_POST['precentage'];

          $namedParameters[":netComm"] =  $_POST['netComm'];   
          
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters); 

        

?>
