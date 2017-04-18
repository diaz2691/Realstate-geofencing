<?php

function PostRequest($url, $referer, $_data) {

// convert variables array to string:
$data = array(); 
while(list($n,$v) = each($_data)){
$data[] = "$n=$v";
} 
$data = implode('&', $data);
// format --> test1=a&test2=b etc.

// parse the given URL
$url = parse_url($url);

// extract host and path:
$host = $url['host'];
$path = $url['path'];

// open a socket connection on port 80
$fp = fsockopen("ssl://".$host, 443);

// send the request headers:
fputs($fp, "POST $path HTTP/1.1rn");
fputs($fp, "Host: $hostrn");
fputs($fp, "Referer: $refererrn");
fputs($fp, "Content-type: application/x-www-form-urlencodedrn");
fputs($fp, "Content-length: ". strlen($data) ."rn");
fputs($fp, "Connection: closernrn");
fputs($fp, $data);

$result = ''; 
$safe=0;
while(!feof($fp)&&$safe<1000) {
// receive the results of the request
$result .= fgets($fp, 128);
$safe++;
}

// close the socket connection:
fclose($fp);

// split the result header from the content
$result = explode("rnrn", $result, 2);

$header = isset($result[0]) ? $result[0] : '';
$content = isset($result[1]) ? $result[1] : '';

// return as array:
return array($header, $content);
}

/*
** The example:
*/

// submit these variables to the server:
$data = array(
'j_username'=>'01864213',
'password'=>'Kaylee1'
);

// send a request to example.com (referer = jonasjohn.de)
list($header, $content) = PostRequest(
"https://idp.mlslistings.com/idp/Authn/UserPassword",
"http://www.myhost.com",
$data
);

// print the result of the whole request:
print $content;

?>