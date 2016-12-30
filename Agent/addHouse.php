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
    <link rel="stylesheet" type="text/css" href="css/navStyles.css">
    <link type="text/css" rel="stylesheet" href="css/mainHeaderStyles.css">
    <link type="text/css" rel="stylesheet" href="css/enterAssignmentsStyles.css">
    <link type="text/css" rel="stylesheet" href="css/backgroundStyles.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->

</head>
    <body>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <br/><h1 id="mainHeader">Add New House Information</h1><br/>
        
        <!-- Navigation Bar -->
        <?php
            //require("teacherNav.php");
            //generateTeacherNav();
        ?>
        <!---------------------->
        
        <br/><br/><br/>
        <h1 id="enterHouseHeader">Enter House Information</h1>
        <div id="enterHouseDiv" > <br/>
            <div id="innerDiv">

                Address: <input type="text" name="address"> <br />
                City: <input type="text" name="city"><br />
                State: <input type="text" name="state"><br />
                Zip: <input type="text" name="zip"><br />
                Bedrooms: <input type="text" name="bedrooms"><br />
                Bathrooms: <input type="text" name="bathrooms"><br />
                Price: <input type="text" name="price"><br />
                <input type="hidden" name="userId" value="<?=$_SESSION['userId']?>"> 
                <input id="enterHouse" type="button" value="Enter" >  
                <?php echo $_SESSION['userId'];
                ?>
                
            </div>
        </div>
        
        <script>

            $("#enterHouse").click( function(event){
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
                window.location.href = "AgentProfile.php";
            });      
        </script>
        
    </body>
</html>