
<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
	    header("Location: userLogin.php?error=wrong username or password");
    }

    if (isset($_GET['houseId'])){

         $houseId = $_GET['houseId'];
         
         $sql = "SELECT * FROM HouseInfo WHERE houseId = '".$houseId."'"; // need to get assignmentId instead of the one for testing purposes
         $stmt = $dbConn -> prepare($sql);
         $stmt->execute();
         $results = $stmt->fetchAll();
         foreach($results as $result) { 
                $address = htmlspecialchars($result['address']);
                $city = htmlspecialchars($result['city']);
                $state = htmlspecialchars($result['state']);
                $zip = htmlspecialchars($result['zip']);
                $bedrooms = htmlspecialchars($result['bedrooms']);
                $bathrooms = htmlspecialchars($result['bathrooms']);
                $price = htmlspecialchars($result['price']);
         }

    }

     if (isset($_POST['editForm'])) {  //the update form has been submitted
         $sql = "UPDATE HouseInfo
                 SET address = :address,
                        city = :city,
                        state = :state,
                        zip = :zip,
                        bedrooms = :bedrooms,
                        bathrooms = :bathrooms,
                        price = :price
                 WHERE houseId = :houseId";
          $namedParameters = array();
          $namedParameters[":address"] = $_POST['address'];
          $namedParameters[":city"] = $_POST['city'];
          $namedParameters[":state"] = $_POST['state'];     
          $namedParameters[":zip"] = $_POST['zip'];     
          $namedParameters[":bedrooms"] = $_POST['bedrooms'];     
          $namedParameters[":bathrooms"] = $_POST['bathrooms'];     
          $namedParameters[":price"] = $_POST['price'];
          $namedParameters[":houseId"] = $_POST['houseId'];      
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
          echo "Record has been updated!";
             header("Location: AgentProfile.php");
         }



    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Assignment</title>
    <meta charset = "utf-8"/>
    <link type="text/css" rel="stylesheet" href="addOrEditInfo.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
        <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>
      <div class="form">
        <h1>Edit Record</h1>
        <form method="post">

            Address: <input type="text" name="address" value="<?=$address?>"> <br />
            City: <input type="text" name="city" value="<?=$city?>"><br />
            State: <input type="text" name="state" value="<?=$state?>"><br />
            Zip: <input type="text" name="zip" value="<?=$zip?>"><br />
            Bedrooms: <input type="text" name="bedrooms" value="<?=$bedrooms?>"><br />
            Bathrooms: <input type="text" name="bathrooms" value="<?=$bathrooms?>"><br />
            Price: <input type="text" name="price" value="<?=$price?>"><br />
            <input type="hidden" name="houseId" value="<?=$houseId?>"> 
            <br/>
            <input id="button" type="submit" name="editForm" value="Edit">
        
        </form>
            
        </div>         
        
    </body>
</html>