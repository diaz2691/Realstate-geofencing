<?php

$script = shell_exec('python breLic.py 2>&1');
$result = json_decode($script, true);

echo $result['name'];
echo $result['lic'];
echo $result['expirationDate'];

echo json_encode($result);

?>