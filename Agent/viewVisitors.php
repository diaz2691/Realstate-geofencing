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
    <!--<link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/viewGradesStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css"> -->
    <style type="text/css">
    .tftable {font-size:12px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
    .tftable th {font-size:12px;background-color:#171515;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
    .tftable tr {background-color:#2f2f2f;}
    .tftable td {font-size:12px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
    .tftable tr:hover {background-color:#171515;}
    </style>
</head>
    

    <body>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="header">
            <br/><h1 id="mainHeader">Agent Profile</h1><br/>
        </div>
        <!-- Navigation Bar-->
        <?php
            //require("../navigationBar.php");
            //generateTeacherNav();
        ?>
        
        <br/>
        <br/><h2 id="header2">Visitors &#x2713</h2> 
        
        <table class="tftable" border="1">
       
        <tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th><th>Edit</th><th>Delete</th></tr>    
            
            <?php
            $dbConn = getConnection();
            $sql = "SELECT * FROM BuyerInfo WHERE houseId = :houseId";
            $namedParameters = array();
            $namedParameters[':houseId'] = $_GET['houseId'];
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['firstName'] . "</td>";
                echo "<td>" . $result['lastName'] . "</td>";
                echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                echo "<td>" . htmlspecialchars($result['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['price']) . "</td>";

             ?>  

             <td>
                     <form action="editBuyerInfo.php">
                         <input type="hidden" name="buyerID" value="<?=$result['buyerID']?>" />    
                         <input type="submit" value="Edit" name="editForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$result['firstName']?>')">
                         <input type="hidden" name="buyerID" value="<?=$result['buyerID']?>" />    
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