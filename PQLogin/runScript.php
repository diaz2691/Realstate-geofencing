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

$address = "1131 carson st.";
$county = "Monterey, CA";

$script = shell_exec('python PQLogin.py 2>&1 ' . $address. ' '.$county);
echo $script;
$result = json_decode($script, true);
// foreach ($result as $r ) 
// {
// 	echo $r . "<br/>";
// }

 
echo "<br/> Total value : " . $result['totVal'] . "<br/>";
echo "Square Feet : " . $result['sqFeet'] . "<br/>";
echo "Bedrooms : " . $result['bedR'] . "<br/>";
echo "Full Baths : " . $result['fullBath'] . "<br/>";
echo "APN : " . $result['apn'] . "<br/>";

?>