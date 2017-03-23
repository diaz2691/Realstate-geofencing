<?php
require('../twilio-php-master/Twilio/autoload.php');
use Twilio\Twiml;

$response = new Twiml;
$body = $_REQUEST['Body'];

if( $body == "My home" )
{
    $response->message('Hi!');
}
else if( $body == 'bye' )
{
    $response->message('Entered incorrect phrase');
}
print $response;




// $twilio_phone_number = "+18315851661";

//     $client = new Client($account_sid, $auth_token);
//     $client->messages->create(
//     "8312934153",
//     array(
//     "From" => $twilio_phone_number,
//     "Body" => "Flyer",
//     'mediaUrl' => "http://52.11.24.75/keys/1331_Sonoma_Seaside_CaFlyer.jpg",
//     )
//     );

?>