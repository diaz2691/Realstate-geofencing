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
    .tftable {font-size:12px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
    .tftable th {font-size:12px;background-color:#171515;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
    .tftable tr {background-color:#2f2f2f;}
    .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
    .tftable tr:hover {background-color:#171515;}
    </style>
</head>
    

    <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>  //generateTeacherNav();
        ?>
        
        <br/>
        <br/><h2 id="header2">Houses &#x2713</h2>

        <form action="addHouse.php">
            <input type="hidden" name="houseId" />    
            <input type="submit" value="Add New House" name="addForm"/>
        </form>  
        
        <table class="tftable" border="1">
       
        <tr><th>Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th><th>Visitors</th><th>Update</th><th>Delete</th></tr>    
            
            <?php

            $dbConn = getConnection();
            $sql = "SELECT * FROM HouseInfo WHERE userId = :userId";
            $namedParameters = array();
            $namedParameters[':userId'] = $_SESSION['userId'];
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['city'] . "</td>";
                echo "<td>" . htmlspecialchars($result['state']) . "</td>";
                echo "<td>" . htmlspecialchars($result['zip']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['price']) . "</td>";

             ?>  
           <td>

                     <form action="BuyerForm.php">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input type="submit" value="Open Form" name="VisitorForm"/>
                     </form> 

                     <form action="viewVisitors.php">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input type="submit" value="View" name="ViewForm"/>
                     </form>   
                </td> 

             <td>
                     <form action="editHouseInfo.php">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input type="submit" value="Edit" name="editForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$result['address']?>')">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input type="submit" value="Delete" name="deleteForm"/>
                     </form>   
                </td>
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>