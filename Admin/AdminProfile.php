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
        <script src="//code.jquery.com/jquery-1.3.2.min.js">
            $(function(){
              $("#includedContent").load("adminNav.php"); 
            });
        </script>
        <script src="adminNav.js"></script>
        <link rel="stylesheet" type="text/css" href="adminNav.css">
    </head>
	<body>
        <div id="includedContent"></div>
		<h1>Admin Profile</h1>
        <!-- Navigation Bar -->

		 <form action="commisionSheet.php">   
            <input type="submit" value="Commission Sheet" name="CommissionForm"/>
         </form> 

          <form action="viewAgents.php">   
          	<input type="submit" value="View Agents" name="ViewForm"/>
          </form>   

	</body>
</html>
