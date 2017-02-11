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

$script = passthru('python PQLogin.py 2>&1' . $address. ' '.$county, 'r');

$result = json_decode($script);
foreach ($result as $r ) 
{
	echo $r . "<br/>";
}


// echo "Total value : " . $result['totVal'];
// echo "Square Feet : " . $result['sqFeet'];
// echo "Bedrooms : " . $result['bedR'];
// echo "Full Baths : " . $result['fullBath'];
// echo "APN : " . $result['apn'];
?>