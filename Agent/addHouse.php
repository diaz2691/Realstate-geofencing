<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: userLogin.php?error=wrong username or password");
    } 
 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Add New House Information</title>
    <meta charset = "utf-8"/>
    <link type="text/css" rel="stylesheet" href="addOrEditInfo.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
                <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>  
        
            <div id="form">
                <h1>Enter House Information</h1>
                <input type="text" id="address" placeholder="address"> <br />
                <input type="text" id="city" placeholder="city"><br />
                <input type="text" id="state" placeholder="state"><br />
                <input type="text" id="zip" placeholder="zip"><br />
                <input type="text" id="bedrooms" placeholder="bedrooms"><br />
                <input type="text" id="bathrooms" placeholder="bathrooms"><br />
                <input type="text" id="price" placeholder="price"><br />
                <input type="hidden" id="userId" value="<?=$_SESSION['userId']?>"> 
                <input id="button" type="button" value="Enter" >  
                <?php echo $_SESSION['userId'];
                ?>
                
        </div>
        
        <script>

            $("#button").click( function(event){
                var address = $("#address").val();
                var city = $("#city").val();
                var state = $("#state").val();
                var zip = $("#zip").val();
                var bedrooms = $("#bedrooms").val();
                var bathrooms = $("#bathrooms").val();
                var price = $("#price").val();
                var userId = $("#userId").val();  
                $.ajax({
                    type: "POST",
                    url: "http://ec2-35-163-86-119.us-west-2.compute.amazonaws.com/Agent/submitHouseInfo.php",
                    data: {address: address,
                          city: city,
                          state: state,
                          zip: zip,
                          bedrooms: bedrooms,
                        bathrooms: bathrooms,
                        price: price,
                        userId: userId}
                }); 
                //window.location.href = "AgentProfile.php";
            });      
        </script>
        
    </body>
</html>