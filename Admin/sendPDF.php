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
    'mediaUrl' => "https://c1.staticflickr.com/3/2899/14341091933_1e92e62d12_b.jpg",
    )
    );
?>


