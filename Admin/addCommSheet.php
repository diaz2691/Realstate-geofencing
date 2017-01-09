<?php
    require("../databaseConnection.php");  
    session_start();
    $dbConn = getConnection();

    if(!isset($_SESSION['userId'])) {
        header("Location: ../index.html?error=wrong username or password");
    } 

    $sql = "SELECT * FROM UsersInfo ";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    //$stmt->execute();
    $results = $stmt->fetchAll();
 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Add New Agent Information</title>
    <meta charset = "utf-8"/><!--
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> importing jQuery library-->
    <link type="text/css" rel="stylesheet" href="editAgentInfo.css">
    <style type="text/css">
        .form{
            padding-top: 2cm;
        }
    </style>

</head>
    <body>

        <!-- Navigation Bar -->
        <?php
            require("adminNav.php");
        ?> 
            <div class="form">
                <h1>Enter Commission Information</h1>

               <!--  
                <input type="text" id="password" placeholder="temporary password"><br />
                <input type="text" id="firstName" placeholder="first name"><br />
                <input type="text" id="lastName" placeholder="last name"><br />
                <input type="text" id="email" placeholder="email"><br />
                <input type="text" id="phone" placeholder="phone"><br />
                <input type="text" id="license" placeholder="license"><br /> 
                
                <input type="button" value="enter" id="button">  
                -->
                <select id="agentName" onchange="getLicense()">
                    <?php
                        $license = "";
                        foreach($results as $result){
                            echo "<option value='". $result['license']." '>". $result['firstName'] . " " . $result['lastName'] . "</option>";
                        }


                        

                        echo "<br />";
                        echo "<input type='text' value="" id='agentLicense' readonly>";
                    ?>
                </select>
                
            </div>
        
        <script>


            $("#button").click( function(event){
                // var username = $("#username").val();
                // var password = $("#password").val();
                // var firstName = $("#firstName").val();
                // var lastName = $("#lastName").val();
                // var email = $("#email").val();
                // var phone = $("#phone").val();
                // var license = $("#license").val();
                $.ajax({
                    type: "POST",
                    url: "http://ec2-35-163-86-119.us-west-2.compute.amazonaws.com/Admin/submitAgentInfo.php",
                    data: 
                    {
                        // username: username,
                        //   password: password,
                        //   firstName: firstName,
                        //   lastName: lastName,
                        //   email: email,
                        // phone: phone,
                        // license: license
                    }
                }); 
                window.location.href = "viewAgents.php";
            }); 

            function getLicense()
            {
                var x = document.getElementById("agentName").value;
                document.getElementById("agentLicense").value = x; 

            }

        </script>
        
    </body>
</html>











