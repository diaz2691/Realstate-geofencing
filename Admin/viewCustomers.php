<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: ../index.html?error=wrong username or password");
    } 

    $search = false;
    if (isset ($_GET['q'])){  //checking whether we have clicked on the "Delete" button
        $search = true;
    }

 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Customers</title>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script>
            function searchTable() {  
              
             $.ajax({
                    type: "get",
                    url: "../PQLogin/runScript.php",
                    //dataType: "json",
                    data: {"county": $("#county").val(),
                            "address": $("#address").val() },
                    success: function(data,status) {
                        //alert(status);
                        document.getElementById('bedrooms').value = data; //added for testing purposes on how the items will be added to form later on
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         alert(status);
                    }
                 });
             }
    </script>

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
    .input[type=text] {
        width: 140px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    /* When the input field gets focus, change its width to 100% */
    input[type=text]:focus {
        width: 100%;
    }

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

    <!-- CSS styles for standard search box -->
    <style type="text/css">
        #tfheader{
            background-color:#808080;
        }
        #tfnewsearch{
            float:right;
            padding:20px;
        }
        .tftextinput{
            margin: 0;
            padding: 5px 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            border:1px solid #0076a3; border-right:0px;
            border-top-left-radius: 5px 5px;
            border-bottom-left-radius: 5px 5px;
        }
        .tfbutton {
            margin: 0;
            padding: 5px 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-size:14px;
            outline: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            border: solid 1px #0076a3; border-right:0px;
            background: #0095cd;
            background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
            background: -moz-linear-gradient(top,  #00adee,  #0078a5);
            border-top-right-radius: 5px 5px;
            border-bottom-right-radius: 5px 5px;
        }
        .tfbutton:hover {
            text-decoration: none;
            background: #007ead;
            background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
            background: -moz-linear-gradient(top,  #0095cc,  #00678e);
        }
        /* Fixes submit button height problem in Firefox */
        .tfbutton::-moz-focus-inner {
          border: 0;
        }
        .tfclear{
            clear:both;
        }
    </style>
</head>
    

    <body>
                        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
        <br/><br/><h2 id="header2">Customers &#x2713</h2> 
       
        <!--<input type="text" id="search" name="search" placeholder="search customer name...">-->

        <!-- HTML for SEARCH BAR -->
          <div id="tfheader">
            <form id="tfnewsearch" method="get" action="viewCustomers.php">
                    <input type="text" class="tftextinput" name="q" size="21" maxlength="120"><input type="submit" value="search" class="tfbutton">
            </form>
          <div class="tfclear"></div>
          </div>

        <table class="tftable" border="1">
       
        <tr><th>Agent Name</th><th>Customer Name</th><th>Email</th><th>Phone</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th></tr>    
            
            <?php

            function getAgentName($id){
                $dbConn = getConnection();
                $sql = "SELECT firstName, lastName FROM UsersInfo where userId = $id";
                $stmt = $dbConn -> prepare($sql);
                $stmt->execute();
                //$stmt->execute();
                $results = $stmt->fetch();
                return $results['firstName'] . ' ' . $results['lastName'];
            }

            $dbConn = getConnection();
            if($search){
                $sql = "SELECT * FROM BuyerInfo WHERE lastName = $_GET['q']";
            }
            else{
                $sql = "SELECT * FROM BuyerInfo";
            }
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute();
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . getAgentName($result['userId']) . "</td>";
                echo "<td>" . $result['firstName'] . ' ' . $result['lastName'] . "</td>";
                echo "<td>" . htmlspecialchars($result['email']) . "</td>";
                echo "<td>" . htmlspecialchars($result['phone']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['price']) . "</td>";
                echo "</tr>";   
               } //closes foreach
             ?>         
        </table>
        
        <script>
            $("#search").change(searchTable());
        </script>
    </body>
</html>