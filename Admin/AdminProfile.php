<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();



    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 
 ?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Administrator</title>
        <!--<link rel="stylesheet" type="text/css" href="adminNav.css">
        <script src="adminNav.js"></script>-->
    </head>
	<body>
        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 

	</body>
</html>
