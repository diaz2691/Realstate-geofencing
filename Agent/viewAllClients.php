<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM BuyerInfo 
                 WHERE buyerID = '".$_GET['buyerID']."'";
        $stmt = $dbConn -> prepare($sql);
        $stmt->execute();

    }
 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Visitors</title>
    
    <script>
        
            function confirmDelete(record) 
            {
               // alert("hi"); // for testing
               var deleteRecord = confirm("Are you sure you want to delete " + record + "?");
               if(!deleteRecord)
               {
                   return false
               } 
               else 
               {
                   return true;
               }
            }

            function text(houseId,agentId)
            {
              var data = "houseId=" + houseId + "&agentId=" + agentId;
              var xhr = new XMLHttpRequest();
              xhr.onreadystatechange = function () 
              {
               if (this.readyState == 4 && this.status == 200) 
               {
                  var response = JSON.parse(xhr.responseText);
                  xhr.abort();
                }
              }

              xhr.open("POST", "textAgent.php", true);
              xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
              xhr.setRequestHeader("houseId", houseId);
              xhr..setRequestHeader("agentId", agentId);
              xhr.send();
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
              font-size: 18px;
              text-align:center;
              background-color:#c68c53
            }
            .tftable {font-size:18px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
            .tftable th {font-size:18px;background-color:#c68c53;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
            .tftable tr {background-color:#d2a679;}
            .tftable td {font-size:18px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
            .tftable tr:hover {background-color:#c68c53;}

            .button
            {
              background-color: #4CAF50;
            }
    </style>
</head>
    

    <body>
                        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?> 
        <br/><br/><h2 id="header2">Clients &#x2713</h2> 
        
        <table class="tftable" border="1">
       
        <tr><th>Agent Name</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th></tr>    
            
            <?php

            function getAgentName($id){
                $dbConn = getConnection();
                $sqls = "SELECT firstName, lastName FROM UsersInfo WHERE userId = $id";
                $stmts = $dbConn -> prepare($sqls);
                $stmts->execute();       
                $counter = $stmts->fetch();
                return $counter['firstName'] . " " . $counter['lastName'];
            }

            $dbConn = getConnection();
            $sql = "SELECT * FROM BuyerInfo";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . getAgentName($result['userId']) . "<button class='button' onclick=text(" . $result['houseId'] . "," . $_SESSION['userId'] . ") >Text</button></td>";
                echo "<td>" . htmlspecialchars($result['bedroomsMin']) . " - " . htmlspecialchars($result['bedroomsMax']) ."</td>";
                echo "<td>" . htmlspecialchars($result['bathroomsMin']) . " - " . htmlspecialchars($result['bathroomsMax']) . "</td>";
                echo "<td>$" . htmlspecialchars(number_format($result['priceMin'])) . " - $" . htmlspecialchars(number_format($result['priceMax'])) .  "</td>";

             ?> 
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>