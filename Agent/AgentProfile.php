<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['username'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM grades 
                 WHERE assignmentid = '".$_GET['assignmentid']."'";    
        $result = pg_query($sql); 
        if (!$result) { 
            $errormessage = pg_last_error(); 
            echo "Error with query: " . $errormessage; 
            exit(); 
        } 
        //pg_close(); 

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
            //require("navigationBar.php");
            //generateTeacherNav();
        ?>
        
        <br/>
        <br/><h2 id="header2">Houses &#x2713</h2>
        
        <table class="tftable" border="1">
       
        <tr><th>Address</th><th>City</th><th>State</th><th>Zip Code</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th><th>Update</th><th>Delete</th></tr>    
            
            <?php
             //$studentid = 1; // 1 FOR TESTING PURPOSES! 
             // NEED TO GET PERCENTAGE, LETTER GRADE
             //$grades = getGrades($studentid);
             //
                
             //$gradeTotal = 0;
             //$possiblePointsTotal = 0;

            $dbConn = getConnection();
            $sql = "SELECT * FROM HouseInfo WHERE userId = :userId";
            $namedParameters = array();
            $namedParameters[':userId'] = $_SESSION['userId'];
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
            //$stmt->execute();
            $results = $stmt->fetch();
            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['city'] . "</td>";
                echo "<td>" . htmlspecialchars($result['state']) . "</td>";
                echo "<td>" . htmlspecialchars($result['zip']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['price']) . "</td>";

             ?>  <td>
                     <form action="updateGrades.php">
                         <input type="hidden" name="assignmentid" value="<?=$grade['assignmentid']?>" />    
                         <input type="submit" value="Update" name="updateForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$grade['assignmentid']?>')">
                         <input type="hidden" name="assignmentid" value="<?=$grade['assignmentid']?>" />    
                         <input type="submit" value="Delete" name="deleteForm"/>
                     </form>   
                </td>
               </tr>

             <?php    
               } //closes foreach
             ?>            
            
           
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td><b>Earned Points</b></td><td><b>Possible Total Points</b></td><td><b>Class Average</b></td><td><b>Letter Grade</b></td><td></td><td></td></tr>

        <tr><td></td><td></td><td></td><td><?=$gradeTotal?></td><td><?=$possiblePointsTotal?></td><td><?=$classAverage?>%</td><td><?=$letter?></td><td></td><td></td></tr>
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>