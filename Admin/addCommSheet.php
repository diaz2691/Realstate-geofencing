<?php
ini_set('display_errors', 1);
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

    $sqlHouse = "SELECT * FROM HouseInfo ORDER BY address";
    $stmtHouse = $dbConn -> prepare($sqlHouse);
    $stmtHouse->execute();


    $results = $stmt->fetchAll();

    $houses = $stmtHouse->fetchAll();
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

                Agent's name:<br/>
                <select id="agentName" onchange="getLicense()">
                    <?php
                        $license = "";
                        foreach($results as $result){
                            echo "<option value='". $result['license']."'>". $result['firstName'] . " " . $result['lastName'] . "</option>";
                        }
                        ?>
                </select>
                        <?php

                        echo "<br />";
                        echo "License: <input type='text' value='F34255G7' id='agentLicense' readonly> <br />";
                        echo "Date: <input type='date' id='date' value='2014-02-09'> <br/>" ;
                        echo "Settlement date: <input type='date' id='settlementDate' value='2014-02-09'> <br/>" ;
                        echo "Commission: <input type='text' id='commission' name='commission'><br>";
                        echo "Check Number: <input type='text' id='checkNum' name='checkNum'><br>";

                        echo "House Address:";
                        echo "<select id='houseId'>";
                        foreach($houses as $house){                        
                            echo "<option value='". $house['houseId']."'>". $house['address'] . " " . $house['city'] . " " . $house['state'] . " " . $house['zip'] . "</option>";
                        }
                        echo "</select>";

                    ?>
                    <br/>
                    <br/>
                    <input type="button" value="enter" id="button">
                
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
                var license = $("#agentLicense").val();
                var date = $("#date").val();
                var settlementDate = $("#settlementDate").val();
                var commission = $("#commission").val();
                var checkNum = $("#checkNum").val();
                var houseId = $("#houseId").val();
                alert(date);
                alert(settlementDate);
                alert(commission);
                alert(checkNum);
                alert(houseId);
                $.ajax({
                    type: "POST",
                    url: "http://ec2-35-163-86-119.us-west-2.compute.amazonaws.com/Admin/submitCommInfo.php",
                    data: 
                    {
                        // username: username,
                        //   password: password,
                        //   firstName: firstName,
                        //   lastName: lastName,
                        //   email: email,
                        // phone: phone,
                        // license: license
                        license: license,
                        date: date,
                        settlementDate: settlementDate,
                        commission: commission,
                        checkNum: checkNum,
                        houseId: houseId
                    },
                    success: function(data) 
                    {
                        successmessage = 'Data was succesfully captured';
                        $("label#successmessage").text(successmessage);
                    },
                        error: function(data) {
                        successmessage = 'Error';
                        $("label#successmessage").text(successmessage);
                    },
                });
                window.location.href = "viewCommissionSheet.php";
            }); 

            function getLicense()
            {
                var x = document.getElementById("agentName").value;
                document.getElementById("agentLicense").value = x; 

            }

        </script>
        
    </body>
</html>