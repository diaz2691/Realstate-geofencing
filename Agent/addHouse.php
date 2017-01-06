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
    <style type="text/css">
        .form select {
          font-family: "Roboto", sans-serif;
          outline: 0;
          background: #f2f2f2;
          width: 100%;
          border: 0;
          margin: 0 0 15px;
          padding: 15px;
          box-sizing: border-box;
          font-size: 14px;
          text-align: center;
        }
    </style>

</head>
    <body>
                <!-- Navigation Bar -->
        <?php
            require("agentNav.php");
        ?>  
        
            <div class="form">
                <h1>Enter House Information</h1>
                <select id="condition">
                  <option value=1>active</option>
                  <option value=2>pending</option>
                  <option value=3>sold</option>
                </select>
                <input type="text" id="address" placeholder="address"> <br />
                <input type="text" id="city" placeholder="city"><br />
                <input type="text" id="state" placeholder="state"><br />
                <input type="text" id="zip" placeholder="zip"><br />
                <input type="text" id="bedrooms" placeholder="bedrooms"><br />
                <input type="text" id="bathrooms" placeholder="bathrooms"><br />
                <input type="text" id="price" placeholder="price"><br />
                <input type="hidden" id="userId" value="<?=$_SESSION['userId']?>"> 
                <input id="button" type="button" value="Enter" > 
                
        </div>
        
        <script>

            $("#button").click( function(event){
                var condition = $("#condition").val();
                alert(condition);
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
                    url: "whttp://ec2-35-163-86-119.us-west-2.compute.amazonaws.com/Agent/submitHouseInfo.php",
                    data: {condition: condition,
                          address: address,
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