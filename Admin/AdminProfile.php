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
        <?php
            require("adminNav.php");
        ?> 
        
        <br/>
        <br/>
        
        <table class="tftable" border="1">
            <center><h2 id="header2">Agents &#x2713</h2></center>
        <tr><th class="tableHeader">Username</th><th class="tableHeader">First Name</th><th class="tableHeader">Last Name</th><th class="tableHeader">Active Listings</th><th class="tableHeader">Houses Sold</th><th class="tableHeader">Total Earnings</th></tr>    
            
            <?php
            function getHouseCount($id){
                $dbConn = getConnection();
                $sqls = "SELECT COUNT(*) as houseCount FROM HouseInfo WHERE userId = $id";
                $stmts = $dbConn -> prepare($sqls);
                $stmts->execute();              
                //echo "<script type='text/javascript'>alert('lol');</script>";

                $counter = $stmts->fetch();
                return $counter['houseCount'];
            }

            function getHousesSold($id){
                $dbConn = getConnection();
                $sqls = "SELECT COUNT(*) as housesSold FROM HouseInfo WHERE userId = $id AND status = 'sold'";
                $stmts = $dbConn -> prepare($sqls);
                $stmts->execute();              
                //echo "<script type='text/javascript'>alert('lol');</script>";

                $counter = $stmts->fetch();
                return $counter['housesSold'];
            }

            $dbConn = getConnection();
            $sql = "SELECT * FROM UsersInfo WHERE userType = 1";
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();
            foreach($results as $result){
                echo "<tr>";
                //echo "<td>" . $result['username'] . "</td>";
                ?>
                <td><form action='AgentProfile.php' method='post'>
                    <button type='submit' name='userId' value='<?php echo $result['userId']; ?>' class='btn-link'> <?php echo $result['username']; ?></button>
                </form></td>
                <?php
                echo "<td>" . htmlspecialchars($result['firstName']) . "</td>";
                echo "<td>" . htmlspecialchars($result['lastName']) . "</td>";
                echo "<td>" . getHouseCount($result['userId']) . "</td>";
                echo "<td>" . getHousesSold($result['userId']) . "</td>";
             ?> 
                <td>$0</td>
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>
    <br/><br/><br/><br/><br/><br/>
    </body>
</html>