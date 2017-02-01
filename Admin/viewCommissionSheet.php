<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM commInfo 
                 WHERE commId = '".$_GET['commId']."'";
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
    <title>Commission Sheet</title>
    
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
    </style>
</head>
    

    <body>
                        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
        <br/><br/><h2 id="header2">Commission Sheets &#x2713</h2> 

        <form action="addCommSheet.php">  
            <input type="submit" value="Add New Commission Sheet" name="addForm"/>
        </form>  

        <table class="tftable" border="1">
       
      <tr><th>First Name</th><th>Last Name</th><th>Address</th><th>Date</th><th>Settlement Date</th><th>View</th><th>Edit</th><th>Send</th><th>Delete</th></tr>    
            
            <?php
            $dbConn = getConnection();
            $sql = "SELECT * FROM commInfo ";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['firstName'] . "</td>";
                echo "<td>" . $result['lastName'] . "</td>";
                echo "<td>" . htmlspecialchars($result['address'])." ".$result['city'].", ".$result['state']." ".$result['zip']."</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['date']))) . "</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['settlementDate']))) . "</td>";

             ?>   
             <td>
                <form action="commisionSheet.php">
                   <input type="hidden" name="commId" value="<?=$result['commId']?>" />    
                   <input class="option" type="submit" value="View" name="viewComissionSheet"/>
                </form>   
              </td> 

             <td>
                <form action="editCommInfo.php">
                   <input type="hidden" name="buyerID" value="<?=$result['commId']?>" />    
                   <input class="option" type="submit" value="Edit" name="editForm"/>
                </form>   
              </td> 

              <td>
                   <input class="option" type="text" value="Send" name="Send" onClick="sendComm(<?=$result['commId']?>)"/>
              </td>

              <td>
                <form onsubmit="return confirmDelete('<?=$result['firstName']?>')">
                   <input type="hidden" name="buyerID" value="<?=$result['buyerID']?>" />    
                   <input class="option" type="submit" value="Delete" name="deleteForm"/>
                </form>    
              </td>
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>

    <script>

      function sendComm(commId)
      {
        alert(commId);
      }
    </script>
</html>