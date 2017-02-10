<?php


//exec("PQLogin.py" , $out,$ret );
//$output = shell_exec("PQLogin.py");
// foreach ($out as $line)
// {
//     echo $line . "<br />";
// }

//echo $ret;

session_start();
// $address = $_GET['address'];
// $county = $_GET['county'];

$address = "address";
$county = "county";

$check = passthru('python PQLogin.py 2>&1' . $address. ' '.$county);

$result = json_decode($check, true);

echo "Total value : " . $result['totVale'];
echo "Square Feet : " . $result['sqFeet'];
echo "Bedrooms : " . $result['bedR'];
echo "Full Baths : " . $result['fullBath'];
echo "APN : " . $result['apn'];
?>