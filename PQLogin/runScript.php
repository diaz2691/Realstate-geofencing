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

$script = shell_exec('python PQLogin.py 2>&1 ' . $address. ' '.$county);

$result = json_decode($script, true);
// foreach ($result as $r ) 
// {
// 	echo $r . "<br/>";
// }

 
echo "<br/> Total value : " . $result[0] . "<br/>";
echo "Square Feet : " . $result[1] . "<br/>";
echo "Bedrooms : " . $result['bedR'] . "<br/>";
echo "Full Baths : " . $result['fullBath'] . "<br/>";
echo "APN : " . $result['apn'] . "<br/>";

?>