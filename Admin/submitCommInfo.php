<?php
     session_start();
     require('../databaseConnection.php');
     $dbConn = getConnection();

    $license = $_POST['license'];
    $houseId = $_POST['houseId'];

    $sql = "SELECT * FROM UsersInfo WHERE license = $license";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();

    $sqlHouse = "SELECT * FROM HouseInfo WHERE houseId = $houseId";
    $stmtHouse = $dbConn -> prepare($sqlHouse);
    $stmtHouse->execute();

    $sqlAgent = "SELECT * FROM commInfo ORDER BY date DESC LIMIT 1 WHERE license = $license";
    $stmtAgent = $dbConn -> prepare($sqlHouse);
    $stmtAgent->execute();

    $TYGross = $stmtAgent['TYGross'];
    $FYGross = $stmtAgent['FYGross']; 
    $commission = $_POST['commission'];
    $brokerFee = 0;
    $finalComm = 0;



    if($TYGross <= 80000)
    {
      $difference =  80000 - $TYGross;

      //$total = $TYGross + $commission;
      if($commission <= $difference)
      {
        $brokerFee += $commission * .20;
      }
      else
      {
        $brokerFee += $difference * .20;
        $commission = $commission - $difference;
        if($commission > 0)
        {
          $difference = 49999 - $commission;
          if($difference <= 49999)
          {
            $brokerFee += $difference * .15;
          }
          else
          {
            $brokerFee += 49999 * .15;
            $commission = $commission - 49999;
            if($commission > 0)
            {
              $difference = 49999 - $commission;
              if($difference <= 49999)
              {
                $brokerFee += $difference * .10;
              }
              else
              {
                $brokerFee += 49999 * .10;
                $commission = $commission - 49999;
                if($commission > 0)
                {
                  $brokerFee += $commission * .5;
                }
              }
            }
          }
        }
      }
    }
    else if ($TYGross <= 130000)
    {
      $difference =  130000 - $TYGross; 
      if($commission <= $difference)
      {
        $brokerFee += $commission * .15;
      }
      else
      {
        $brokerFee += $difference * .15;
        $commission = $commission - $difference;
        if($commission > 0)
        {
          if($difference <= 49999)
          {
            $brokerFee += $difference * .10;
          }
          else
          {
            $brokerFee += 49999 * .10;
            $commission = $commission - 49999;
            if($commission > 0)
            {
              $brokerFee += $commission * .5;
            }
          }
        }
      }
    }
    else if($TYGross <= 180000)
    {
      $difference =  180000 - $TYGross; 
      if($commission <= $difference)
      {
        $brokerFee += $commission * .15;
      }
      else
      {
        $brokerFee += 49999 * .10;
        $commission = $commission - 49999;
        if($commission > 0)
        {
          $brokerFee += $commission * .5;
        }
      }
    }
    else
    {
      $brokerFee += $commission * .5;
    }



     $sql = "INSERT INTO commInfo
                  (houseId, license, firstName, lastName, date, settlementDate, checkNum, address, city, state, zip, TYGross, FYGross, InitialGross, brokerFee, finalComm)
                  VALUES (:houseId, :license, :firstName, :lastName, :date, :settlementDate, :checkNum, :address, :city, :state, :zip, :TYGross, :FYGross, :InitialGross, :brokerFee, :finalComm)";
           $namedParameters = array();

          $namedParameters[":houseId"] = $houseId;
          $namedParameters[":license"] = $license;
          $namedParameters[":firstName"] = $stmt['firstName'];
          $namedParameters[":lastName"] = $stmt['lastName'];     
          $namedParameters[":date"] = $_POST['date'];     
          $namedParameters[":settlementDate"] = $_POST['settlementDate'];     
          $namedParameters[":checkNum"] = $_POST['checkNum'];   

          $namedParameters[":address"] = $stmtHouse['address'];     
          $namedParameters[":city"] = $stmtHouse['city'];     
          $namedParameters[":state"] = $stmtHouse['state']; 
          $namedParameters[":zip"] = $stmtHouse['zip'];

          $namedParameters[":TYGross"] =  $stmtAgent['TYGross'] + $_POST['commission'];   
          $namedParameters[":FYGross"] = $stmtAgent['FYGross'] + ($_POST['commission'] - $brokerFee - 349);

          $namedParameters[":InitialGross"] =  $_POST['commission'];   
          $namedParameters[":brokerFee"] = $brokerFee;
          $namedParameters[":finalComm"] =  $_POST['commission'] - $brokerFee - 349;   

          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
    

    

  

  
?>