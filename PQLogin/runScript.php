<?php


//exec("PQLogin.py" , $out,$ret );
//$output = shell_exec("PQLogin.py");
// foreach ($out as $line)
// {
//     echo $line . "<br />";
// }

//echo $ret;

session_start();
$address = $_GET['address'];
$county = $_GET['county'];

$check = passthru('python PQLogin.py 2>&1');
echo $check;

?>