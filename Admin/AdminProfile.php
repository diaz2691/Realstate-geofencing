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
        <!--<link rel="stylesheet" type="text/css" href="adminNav.css">
        <script src="adminNav.js"></script>-->
    </head>
	<body>

		<h1>Admin Profile</h1>
        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?>

		 <form action="commisionSheet.php">   
            <input type="submit" value="Commission Sheet" name="CommissionForm"/>
         </form> 

          <form action="viewAgents.php">   
          	<input type="submit" value="View Agents" name="ViewForm"/>
          </form>   

	</body>
</html>
