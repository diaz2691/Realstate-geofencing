<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM HouseInfo 
                 WHERE houseId = '".$_GET['houseId']."'";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();

    }

    $sortByDate = true;
    if (isset ($_GET['sortType'])){  
        if($_GET['sortType'] == "address"){
            $sortByDate = false;
        }

    }


 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Agent Profile</title>
    
    <script>
        
            function confirmDelete(record) {
               // alert("hi"); // for testing
               var deleteRecord = confirm("Are you sure you want to delete " + record + "?");
               if(!deleteRecord){
                   return false
               } else {
                   return true;
               }
            }
        
        </script>
    
    <meta charset = "utf-8"/>
 <style type="text/css">
               /* .tableHeader {
                    text-align:center;
                }*/

              .tableButtons {
                text-align:center;
              }
              .option {
              font-family: "Roboto", sans-serif;
              outline: 0;
              background: "green";
              border: 0;
              box-sizing: border-box;
              font-size: 14px;
              text-align:center;
              background-color:#c68c53
            }
            .tftable {font-size:14px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
            .tftable th {font-size:14px;background-color:#c68c53;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
            .tftable tr {background-color:#d2a679;}
            .tftable td {font-size:14px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
            .tftable tr:hover {background-color:#c68c53;}

            th a {
                display: block;
                text-decoration: none !important;
                color: inherit;
            }
    </style>
</head>
    

    <body>
        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?>
        
        <br/>
        <br/><h2 id="header2">Houses &#x2713</h2>  
        
        <table class="tftable" border="1">
       
        <tr><th><a href="viewHouses.php?sortType=date" >Date Added<span class="caret"></a></th><th><a href="#" >Address<span class="caret"></a></th><th>City</th><th>State</th><th>Zip Code</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th></tr>    
            
            <?php

            $dbConn = getConnection();
            $sql = "SELECT * FROM HouseInfo
                   ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address)))";
            $namedParameters = array();
            $namedParameters[':userId'] = $_SESSION['userId'];
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . htmlspecialchars($result['dateTime']) . "</td>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['city'] . "</td>";
                echo "<td>" . htmlspecialchars($result['state']) . "</td>";
                echo "<td>" . htmlspecialchars($result['zip']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['price']) . "</td>";

             ?>  
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    </body>
</html>