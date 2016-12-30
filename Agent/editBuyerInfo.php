
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
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/updateAssignmentStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <h1 id="mainHeader">Visitors Information</h1>    
    <h1>Edit Record</h1>
        <div id="formDiv">
            
      <br/> 
    <form method="post">

        First Name: <input type="text" name="firstName" value="<?=$firstName?>"> <br />
        Last Name: <input type="text" name="lastName" value="<?=$lastName?>"><br />
        Email: <input type="text" name="email" value="<?=$email?>"><br />
        Phone: <input type="text" name="phone" value="<?=$phone?>"><br />
        Bedrooms: <input type="text" name="bedrooms" value="<?=$bedrooms?>"><br />
        Bathrooms: <input type="text" name="bathrooms" value="<?=$bathrooms?>"><br />
        Price: <input type="text" name="price" value="<?=$price?>"><br />
        <input type="hidden" name="buyerID" value="<?=$buyerID?>"> 
<br/>
        <input id="button" type="submit" name="editForm" value="Edit!">
    
    </form>
            
        </div>         
        
    </body>
</html>