<?php
    session_start();
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
    $account_sid = "AC4991f00911beb00578efd8b8355fdc7d";
    $auth_token = "b605b8121c246b4b64fe407255f50528";
    $twilio_phone_number = "+18315851661";

    $client = new Client($account_sid, $auth_token);
    $client->account->messages->create(
    $_POST['phone'],
    array(
    "From" => $twilio_phone_number,
    "Body" => "Your password is " . $_POST['password'],
    )
    );

    

  

  
?>