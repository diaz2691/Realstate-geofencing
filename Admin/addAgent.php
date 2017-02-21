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
                <h1>Enter Agent Information</h1>

                <input type="text" id="license" placeholder="license" onchange="getLicense()"><br />
                <input type="text" id="username" placeholder="username"> <br />
                <input type="text" id="password" placeholder="temporary password"><br />
                <input type="text" id="firstName" placeholder="first name" readonly><br />
                <input type="text" id="lastName" placeholder="last name" readonly><br />
                <input type="text" id="email" placeholder="email"><br />
                <input type="text" id="phone" placeholder="phone"><br />

                <input type="text" id="issued" placeholder="Issued License Date" readonly><br />
                <input type="text" id="expiration" placeholder="License Expiration Date" readonly><br />
                 
                <input type="button" value="enter" id="button">  
                
            </div>x
        
        <script>
            function getLicense()
            {
                lic = document.getElementById("license").value;
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () 
                {
                   if (this.readyState == 4 && this.status == 200) 
                   {
                    var response = JSON.parse(xhr.responseText);
                    xhr.abort();
                    //console.log(response.name);
                    // var firstN = response.name.split(" ");
                    // var cleanlastN = firstN[0].split(",");
                    
                    // document.getElementById("firstName").value = firstN[1];
                    // document.getElementById("lastName").value = cleanlastN[0];


                    var firstName = response.name.split(",");
                    document.getElementById("firstName").value = firstName[1];
                    document.getElementById("lastName").value = firstName[0];
                    document.getElementById("issued").value = response.lic;
                    document.getElementById("expiration").value = response.expirationDate;
                    }
         
                 }

                xhr.open("GET", "../PQLogin/licScript.php?license=" + lic, true);
                xhr.send();
            }

            $("#button").click( function(event){
                var username = $("#username").val();
                var password = $("#password").val();
                var firstName = $("#firstName").val();
                var lastName = $("#lastName").val();
                var email = $("#email").val();
                var phone = $("#phone").val();
                var license = $("#license").val();
                $.ajax({
                    type: "POST",
                    url: "http://52.11.24.75/Admin/submitAgentInfo.php",
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