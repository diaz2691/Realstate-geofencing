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
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        function getCity() {  
          
         $.ajax({
                type: "get",
                url: "http://maps.googleapis.com/maps/api/geocode/json",
                dataType: "json",
                data: {"address": $("#zip").val() },
                success: function(data,status) {
                    alert(data);
                     $("#city").html(data);
                },
                complete: function(data,status) { //optional, used for debugging purposes
                     alert(status);
                }
             });
         }

            $("#button").click( function(event){
                var status = $("#status :selected").text();
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
                    data: {status: status,
                          address: address,
                          city: city,
                          state: state,
                          zip: zip,
                          bedrooms: bedrooms,
                        bathrooms: bathrooms,
                        price: price,
                        userId: userId}
                }); 
                window.location.href = "AgentHome.php";
            }); 
    </script><!-- importing jQuery library-->
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
        
            <div type="text" class="form">
                <h1>Enter House Information</h1>
                <select id="status">
                <option value="active" selected>active</option>
                  <option value="pending">pending</option>
                  <option value="sold">sold</option>
                </select>
                <input type="text" id="address" placeholder="address"> <br />
                <input type="text" id="city" placeholder="city"><br />
                City: <span id="cities"></span> <br />
                <input type="text" id="state" placeholder="state"><br />
                <input type="text" id="zip" placeholder="zip"><br />
                <input type="text" id="bedrooms" placeholder="bedrooms"><br />
                <input type="text" id="bathrooms" placeholder="bathrooms"><br />
                <input type="text" id="price" placeholder="price"><br />
                <input type="hidden" id="userId" value="<?=$_SESSION['userId']?>"> 
                <input id="button" type="button" value="Enter" > 
                
        </div>
        
        <script> 
          $("#zip").change(getCity);     
        </script>
        
    </body>
</html>