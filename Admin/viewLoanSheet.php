<?php
    require("../databaseConnection.php");  
    require("../keys/refreshKeyAdobe.php");
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: ../index.html?error=wrong username or password");
    } 

    if (isset ($_GET['deleteForm'])){  //checking whether we have clicked on the "Delete" button
        $sql = "DELETE FROM LoanInfo 
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
    <title>Loan Sheet</title>
    
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
              font-size: 18px;
              text-align:center;
              background-color:#c68c53
            }
            .tftable {font-size:18px;color:#fbfbfb;width:100%;border-width: 1px;border-color: #686767;border-collapse: collapse;}
            .tftable th {font-size:18px;background-color:#c68c53;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;text-align:left;}
            .tftable tr {background-color:#d2a679;}
            .tftable td {font-size:18px;border-width: 1px;padding: 8px;border-style: solid;border-color: #686767;}
            .tftable tr:hover {background-color:#c68c53;}
    </style>
</head>
    

    <body>
                        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
        <br/><br/><h2 id="header2">Loan Sheets &#x2713</h2> 

        <form action="addLoanSheet.php">  
            <input type="submit" value="Add New Loan Sheet" name="addForm"/>
        </form>  

        <table class="tftable" border="1">
       
      <tr><th>Clients</th><th>Address</th><th>Loan Date</th><th>Settlement Date</th><th>View</th><th>Edit</th><th>Archive</th></tr>    
            
            <?php
            $dbConn = getConnection();
            $sql = "SELECT * FROM LoanInfo ";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['clients'] . "</td>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['date']))) . "</td>";
                echo "<td>" . htmlspecialchars(date("d-m-Y", strtotime($result['settlementDate']))) . "</td>";

             ?>   
              <td>
                <form action="loanSheet.php">
                   <input type="hidden" name="loanId" value="<?=$result['loanId']?>" />    
                   <input class="option" type="submit" value="View" name="viewLoanSheet"/>
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
     



    </script>



</html>