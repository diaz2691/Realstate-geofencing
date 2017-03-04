<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 
 ?>

        
        <!--
To change this template use Tools | Templates.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    
<head>
    <title></title>
    
    <script>
        
    </script>
    
    <meta charset = "utf-8"/>
</head>
    

    <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>

        <object data=http://remax.idxhome.com/homesearch/59157 width="600" height="400"> <embed src=http://remax.idxhome.com/homesearch/59157 width="600" height="400"> </embed> Error: Embedded data could not be displayed. </object>
        
        
    </body>
</html>