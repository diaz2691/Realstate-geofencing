
<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_GET['buyerID'])){

         $buyerID = $_GET['buyerID'];
        
         $sql = "SELECT * FROM BuyerInfo WHERE buyerID = '".$buyerID."'"; // need to get assignmentId instead of the one for testing purposes
         $stmt = $dbConn -> prepare($sql);
         $stmt->execute();
         $results = $stmt->fetchAll();
         foreach($results as $result) { 
                $firstName = htmlspecialchars($result['firstName']);
                $lastName = htmlspecialchars($result['lastName']);
                $email = htmlspecialchars($result['email']);
                $phone = htmlspecialchars($result['phone']);
                $bedrooms = htmlspecialchars($result['bedrooms']);
                $bathrooms = htmlspecialchars($result['bathrooms']);
                $price = htmlspecialchars($result['price']);
         }

    }

     if (isset($_POST['editForm'])) {  //the update form has been submitted
         $sql = "UPDATE BuyerInfo
                 SET firstName = :firstName,
                        lastName = :lastName,
                        email = :email,
                        phone = :phone,
                        bedrooms = :bedrooms,
                        bathrooms = :bathrooms,
                        price = :price
                 WHERE buyerID = :buyerID";
          $namedParameters = array();
          $namedParameters[":firstName"] = $_POST['firstName'];
          $namedParameters[":lastName"] = $_POST['lastName'];
          $namedParameters[":email"] = $_POST['email'];     
          $namedParameters[":phone"] = $_POST['phone'];     
          $namedParameters[":bedrooms"] = $_POST['bedrooms'];     
          $namedParameters[":bathrooms"] = $_POST['bathrooms'];     
          $namedParameters[":price"] = $_POST['price'];
          $namedParameters[":buyerID"] = $_POST['buyerID'];      
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
          echo "Record has been updated!";
             header("Location: viewVisitors.php");
         }



    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Visitor</title>
    <meta charset = "utf-8"/>
    <link type="text/css" rel="stylesheet" href="addOrEditInfo.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>   
    <div class="form">
        <h1>Edit Record</h1>
        <form method="post">

            <b>First Name</b> <input type="text" name="firstName" value="<?=$firstName?>"> <br />
            <b>Last Name</b> <input type="text" name="lastName" value="<?=$lastName?>"><br />
            <b>Email</b> <input type="text" name="email" value="<?=$email?>"><br />
            <b>Phone</b> <input type="text" name="phone" value="<?=$phone?>"><br />
            <b>Bedrooms</b> <input type="text" name="bedrooms" value="<?=$bedrooms?>"><br />
            <b>Bathrooms</b> <input type="text" name="bathrooms" value="<?=$bathrooms?>"><br />
            <b>Price</b> <input type="text" name="price" value="<?=$price?>"><br />
            <input type="hidden" name="buyerID" value="<?=$buyerID?>"> <br/>
            <input id="button" type="submit" name="editForm" value="Edit">
        
        </form>
            
    </div>         
        
    </body>
    <?php include('../footer.php'); ?>
</html>