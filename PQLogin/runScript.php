<?php


exec("PQLogin" , $out,$ret );
//$output = shell_exec("PQLogin.py");
foreach ($out as $line)
{
    print "$line\n";
}

echo $ret;

?>