
<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_GET['userId'])){

         $userId = $_GET['userId'];
        
         $sql = "SELECT * FROM UsersInfo WHERE userId = '".$userId."'"; // need to get assignmentId instead of the one for testing purposes
         $stmt = $dbConn -> prepare($sql);
         $stmt->execute();
         $results = $stmt->fetchAll();
         foreach($results as $result) { 
                $username = htmlspecialchars($result['username']);
                $firstName = htmlspecialchars($result['firstName']);
                $email = htmlspecialchars($result['email']);
                $phone = htmlspecialchars($result['phone']);
                $lastName = htmlspecialchars($result['lastName']);
                $license = htmlspecialchars($result['license']);
         }

    }

     if (isset($_POST['editForm'])) {  //the update form has been submitted
         $sql = "UPDATE UsersInfo
                 SET firstName = :firstName,
                        lastName = :lastName,
                        email = :email,
                        phone = :phone,
                        username = :username,
                        license = :license
                 WHERE userId = :userId";
          $namedParameters = array();
          $namedParameters[":firstName"] = $_POST['firstName'];
          $namedParameters[":lastName"] = $_POST['lastName'];
          $namedParameters[":email"] = $_POST['email'];     
          $namedParameters[":phone"] = $_POST['phone'];     
          $namedParameters[":username"] = $_POST['username'];     
          $namedParameters[":license"] = $_POST['license'];  
          $namedParameters[":userId"] = $_POST['userId'];;      
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
          echo "Record has been updated!";
             header("Location: viewAgents.php");
         }



    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Agent Information</title>
    <meta charset = "utf-8"/>
    <link type="text/css" rel="stylesheet" href="editAgentInfo.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
        <?php
            require("adminNav.php");
        ?> 
    <h1>Edit Record</h1>
        <div class="form">
            <form method="post">

                Username: <input type="text" name="username" value="<?=$username?>"> <br />
                First Name: <input type="text" name="firstName" value="<?=$firstName?>"><br />
                Last Name: <input type="text" name="lastName" value="<?=$lastName?>"><br />
                Email: <input type="text" name="email" value="<?=$email?>"><br />
                Phone: <input type="text" name="phone" value="<?=$phone?>"><br />
                License: <input type="text" name="license" value="<?=$license?>"><br />
                <input type="hidden" name="userId" value="<?=$userId?>"> 
                <input ype="submit" name="editForm" value="edit" id="button">
        
            </form>
            
        </div>         
        
    </body>
</html>