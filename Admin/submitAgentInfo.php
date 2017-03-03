<?php
    session_start();
    require('../keys/tKey.php');
    require('../databaseConnection.php');
    require('../twilio-php-master/Twilio/autoload.php');
    use Twilio\Rest\Client;
    $dbConn = getConnection();

    $sql = "INSERT INTO UsersInfo
                 (userType, username, password, firstName, lastName, email, phone, license)
                 VALUES (1, :username, :password, :firstName, :lastName, :email, :phone, :license)";
          $namedParameters = array();
          $namedParameters[":username"] = $_POST['username'];
          $namedParameters[":password"] = $_POST['password'];
          $namedParameters[":firstName"] = $_POST['firstName'];
          $namedParameters[":lastName"] = $_POST['lastName'];     
          $namedParameters[":email"] = $_POST['email'];     
          $namedParameters[":phone"] = $_POST['phone'];     
          $namedParameters[":license"] = $_POST['license'];   
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);
    
    $twilio_phone_number = "+18315851661";

    $client = new Client($account_sid, $auth_token);
    $client->account->messages->create(
    $_POST['phone'],
    array(
    "From" => $twilio_phone_number,
    "Body" => "Your password is " . $_POST['password'] . ". Visit www.jjp2017.org to log in.",
    )
    );

    

  

  
?>