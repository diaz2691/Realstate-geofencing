<?php
    require('../keys/tKey.php');
    require('../twilio-php-master/Twilio/autoload.php');
    use Twilio\Rest\Client;
    

    $twilio_phone_number = "+18315851661";

    $client = new Client($account_sid, $auth_token);
    $client->account->messages->create(
    "8312934153",
    array(
    "From" => $twilio_phone_number,
    "Body" => "Flyer",
    'mediaUrl' => "http://52.11.24.75/keys/1331_Sonoma_Seaside_Ca%20Flyer.pdf",
    )
    );
?>


