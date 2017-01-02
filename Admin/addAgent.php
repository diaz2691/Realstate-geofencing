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
    <title>Add New Agent Information</title>
    <meta charset = "utf-8"/>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script><!-- importing jQuery library-->
    <link type="text/css" rel="stylesheet" href="editAgentInfo.css">

</head>
    <body>

        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
        <div id="enterAgentDiv" >
            <div class="form">

                Username: <input type="text" id="username"> <br />
                Temporary Password: <input type="text" id="password"><br />
                First Name: <input type="text" id="firstName"><br />
                LastName: <input type="text" id="lastName"><br />
                Email: <input type="text" id="email"><br />
                Phone: <input type="text" id="phone"><br />
                License: <input type="text" id="license"><br /> 
                <input type="button" value="enter" id="button">  
                
            </div>
        </div>
        
        <script>


            $("#enterAgentInfo").click( function(event){
                var username = $("#username").val();
                var password = $("#password").val();
                var firstName = $("#firstName").val();
                var lastName = $("#lastName").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var license = $("#license").val();
                alert(username);
                $.ajax({
                    type: "POST",
                    url: "http://ec2-35-163-86-119.us-west-2.compute.amazonaws.com/Admin/submitAgentInfo.php",
                    data: {username: username,
                          password: password,
                          firstName: firstName,
                          lastName: lastName,
                          email: email,
                        phone: phone,
                        license: license}
                }); 
                window.location.href = "viewAgents.php";
            });      
        </script>
        
    </body>
</html>