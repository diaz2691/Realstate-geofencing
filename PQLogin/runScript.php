<?php


exec("PQLogin.py" , $out,$ret );
//$output = shell_exec("PQLogin.py");
foreach ($out as $line)
{
    print "$line\n";
}

echo $ret;

?>