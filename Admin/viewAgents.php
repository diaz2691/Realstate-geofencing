<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM UsersInfo 
                 WHERE userId = '".$_GET['userId']."'";
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
    <title>Admin Profile</title>
    
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
            <br/><h1 id="mainHeader">Admin Profile</h1><br/>
        </div>
        <!-- Navigation Bar-->
        <?php
            //require("../navigationBar.php");
            //generateTeacherNav();
        ?>
        
        <br/>
        <br/><h2 id="header2">Agents &#x2713</h2>

        <form action="addHouse.php">
            <input type="hidden" name="houseId" />    
            <input type="submit" value="Add New House" name="addForm"/>
        </form>  
        
        <table class="tftable" border="1">
       
        <tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>License</th><th>Update</th><th>Delete</th></tr>    
            
            <?php

            $dbConn = getConnection();
            $sql = "SELECT * FROM UsersInfo WHERE userType = 1";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['Username'] . "</td>";
                echo "<td>" . htmlspecialchars($result['firstName']) . "</td>";
                echo "<td>" . htmlspecialchars($result['lastName']) . "</td>";
                echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                echo "<td>" . htmlspecialchars($result['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($result['license']) . "</td>";

             ?> 

             <td>
                     <form action="editAgentInfo.php">
                         <input type="hidden" name="userId" value="<?=$result['userId']?>" />    
                         <input type="submit" value="Edit" name="editForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$result['username']?>')">
                         <input type="hidden" name="userId" value="<?=$result['userId']?>" />    
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