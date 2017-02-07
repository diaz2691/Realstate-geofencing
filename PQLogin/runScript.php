<?php


exec("PQLogin" , $out,$ret );
//$output = shell_exec("PQLogin.py");
echo $out;

?>