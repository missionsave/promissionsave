<?php 
$token=$_POST["credential"];
// print_r(json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1])))));

$vart=json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
$stdClass = (array)$vart;
echo $stdClass['email'];
?>