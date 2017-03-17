<?php
    require('../keys/tKey.php');
    require('../twilio-php-master/Twilio/autoload.php');
    use Twilio\Rest\Client;
    

    require("../databaseConnection.php");

    $dbConn = getConnection();

    $getDown = "SELECT downloads FROM flyerInfo WHERE houseId = '1'";
    $down = $dbConn -> prepare($getDown);
    $down->execute();
    $downResult = $down->fetch();

    $sql = "INSERT INTO flyerInfo
                 (houseId, date, phoneNum, downloads)
                 VALUES (:houseId, :date, :phoneNum, :downloads)";

          $namedParameters = array();
          $namedParameters[":houseId"] = "1";
          $namedParameters[":date"] = date("Y-m-d");
          $namedParameters[":phoneNum"] = "8318092424";
          $namedParameters[":downloads"] = $downResult['downloads'] + 1;     
           
          $stmt = $dbConn -> prepare($sql);
          $stmt->execute($namedParameters);



    $twilio_phone_number = "+18315851661";

    $client = new Client($account_sid, $auth_token);
    $client->messages->create(
    "8312934153",
    array(
    "From" => $twilio_phone_number,
    "Body" => "Flyer",
    'mediaUrl' => "http://52.11.24.75/keys/1331_Sonoma_Seaside_CaFlyer.jpg",
    )
    );
?>


