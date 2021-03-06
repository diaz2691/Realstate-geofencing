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
    $ascending = true;
    if (isset ($_GET['sortType'])){  
        if($_GET['sortType'] == "address"){
            $sortByDate = false;
        }
    }
    if(isset ($_GET['changeOrder'])){
        if($_GET['changeOrder']){
            $ascending = false;
        }
    }

 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title>Agent Home</title>
    <scriptsrc="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    
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

            function displayNote()
            {
                document.getElementById('noteBox').style.display = "block";
            }

            function hideNoteBox()
            {
                document.getElementById('noteBox').style.display = "none";
            }

            function saveNote()
            {

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

            th a {
                display: block;
                text-decoration: none !important;
                color: inherit;
            }

            #noteBox
            {
               display:none;
                background-color: #eee;
                border-radius: 5px;
                border: 1px solid #aaa;
                position: fixed;
                width: 300px;
                height: 300px;
                left: 50%;
                margin-left: -150px;
                margin-top: -100px;
                padding: 12px 8px 8px;
                text-align: center;
            }
            #noteBox .button {
                background-color: #ccc;
                display: inline-block;
                border-radius: 3px;
                border: 1px solid #aaa;
                padding: 2px;
                text-align: center;
                width: 80px;
                cursor: pointer;
            }

            #noteBox .message
            {
                text-align: left;
                margin-bottom: 8px;
            }
    </style>
</head>
    

    <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>
        
        <br/>
        <br/><h2 id="header2">Houses &#x2713</h2>

       <!--
       <form action="AgentHome.php">
            <input type="text" name="search" placeholder="Search for " size=67/><br>
            <
            <input type="radio" name="field" value="address" checked> Address<br>
            <input type="radio" name="field" value="city"> City<br>
            <input type="radio" name="field" value="zip"> Zip <br>
            <input type="submit" value="submit" name="searchForm"/>
        </form>
        -->

        <form action="addHouse.php">
            <input type="hidden" name="houseId" />    
            <input type="submit" value="Add New House" name="addForm"/>
        </form>  

        <div id="noteBox">
            <textarea style="width: 272px; height: 189px;"> </textarea>
            <div class="message"></div>
            <button onClick="saveNote">Save</button>
            <button onClick="hideNoteBox()">Cancel</button>
        </div>
        
        <table class="tftable" border="1">
       
        <tr><th>Status</th><th><a href=<?php echo "AgentHome.php?sortType=date&changeOrder=" . $ascending ; ?> >Date Added<span class="caret"></a></th><th><a href=<?php echo "AgentHome.php?sortType=address&changeOrder=" . $ascending ; ?> >Address<span class="caret"></a></th><th>City</th><th>State</th><th>Zip Code</th><th>Bedrooms</th><th>Bathrooms</th><th>Price</th><th>Visitors</th><th>Notes</th><th>Update</th><th>Delete</th></tr>    
            
        <?php

        $dbConn = getConnection();
        
        $searchField = $_GET['field'];
        /*if(isset($_GET['searchForm'])){
            if($sortByDate){
                if($ascending){
                    if(strcmp($searchField, "address") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND address = $searchField
                        ORDER BY dateTimes ASC";
                    }
                    elseif ($searchField, "city") == 0) {
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND city = $searchField
                        ORDER BY dateTimes ASC";
                    }
                    else{
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND zip = $searchField
                        ORDER BY dateTimes ASC";  
                    }
                }
                else{
                    if(strcmp($searchField, "address") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND address = $searchField
                        ORDER BY dateTimes DESC";
                    }
                    elseif(strcmp($searchField, "city") == 0) {
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND city = $searchField
                        ORDER BY dateTimes DESC";
                    }
                    else{
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId 
                        AND zip = $searchField
                        ORDER BY dateTimes DESC";  
                    }
                }
            }
            else{
                if($ascending){
                    if(strcmp($searchField, "address") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND address = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) ASC";
                    }
                    elseif(strcmp($searchField, "city") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND city = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) ASC";
                    }
                    else{
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND zip = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) ASC";                        
                    }
                }
                else{
                    if(strcmp($searchField, "address") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND address = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) DESC";
                    }
                    elseif(strcmp($searchField, "city") == 0){
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND city = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) DESC";
                    }
                    else{
                        $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                            FROM HouseInfo
                            WHERE userId = :userId
                            AND zip = $searchField
                            ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) DESC";                        
                    }
                }
            }
        }*/
        $word = false;
        if($word){
            echo "FIX THIS";
        }
        else{
            if($sortByDate){
                if($ascending){
                    $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId
                        ORDER BY dateTimes ASC";
                }
                else{
                   $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId
                        ORDER BY dateTimes DESC";
                }
            }
            else{
                if($ascending){
                    $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId
                        ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) ASC";
                    }
                else{
                    $sql = "SELECT status, houseId, date(dateTimes) as dateTimes, address, city, state, zip, bedrooms, bathrooms, price
                        FROM HouseInfo
                        WHERE userId = :userId
                        ORDER BY SUBSTR(LTRIM(address), LOCATE(' ', LTRIM(address))) DESC";
                }
            }
        }
            $namedParameters = array();
            $namedParameters[':userId'] = $_SESSION['userId'];
            $stmt = $dbConn -> prepare($sql);
            $stmt->execute($namedParameters);
            //$stmt->execute();
            $results = $stmt->fetchAll();

            foreach($results as $result){
                echo "<tr>";
                echo "<td>" . $result['status'] . "</td>";
                echo "<td>" . $result['dateTimes'] . "</td>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['city'] . "</td>";
                echo "<td>" . htmlspecialchars($result['state']) . "</td>";
                echo "<td>" . htmlspecialchars($result['zip']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bedrooms']) . "</td>";
                echo "<td>" . htmlspecialchars($result['bathrooms']) . "</td>";
                echo "<td>$" . htmlspecialchars(number_format($result['price'])) . "</td>";

             ?>  
           <td>

                     <form action="BuyerForm.php" target="_blank">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input class="option" type="submit" value="Open Form" name="VisitorForm"/>
                     </form> 

                     <form action="viewVisitors.php">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input class="option" type="submit" value="View" name="ViewForm"/>
                     </form>   
                </td> 

                <td>
                    <button class="option" onclick="displayNote()">Note</button>
                </td>

             <td>
                     <form action="editHouseInfo.php">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input class="option" type="submit" value="Edit" name="editForm"/>
                     </form>   
                </td> 
                <td>
                     <form onsubmit="return confirmDelete('<?=$result['address']?>')">
                         <input type="hidden" name="houseId" value="<?=$result['houseId']?>" />    
                         <input class="option" type="submit" value="Delete" name="deleteForm"/>
                     </form>   
                </td>
               </tr>

             <?php    
               } //closes foreach
             ?>         
        </table>

    </body>
    <?php include('../footer.php'); ?>
</html>