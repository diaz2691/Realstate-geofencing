<?php

$script = shell_exec('python breLic.py 2>&1');
$result = json_decode($script, true);


echo $script;
echo "<br/>";
echo json_encode($houseData);

?>