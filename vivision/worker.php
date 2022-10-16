<?php


// https://github.com/jasperdebie/VisInfo/blob/master/us-state-capitals.csv
function filldb1(){
require_once('connect.php');
$c=file_get_contents("us-state-capitals.csv");
$c=explode("\n",$c);
$i=0;
foreach ($c as &$value) {
	$i++;
	if($i==1)continue;
    $v=explode(",",$value);
	echo $v[1]." ".$v[2]."<br>";
	$stmt = $db -> prepare( 'INSERT INTO tabMak (lat,longi,city,virtual) VALUES (?,?,?,1);');
	$city=$v[1].", ".$v[0].", USA";
	$stmt -> execute(array($v[2],$v[3],$city));
} 
}


function filldb2(){
require_once('connect.php');
$c=file_get_contents("usa counties.csv");
$c=explode("\n",$c);
$i=0;
foreach ($c as &$value) {
	$i++;
	if($i==1)continue;
    $v=explode(";",$value);
	$stmt = $db -> prepare( 'INSERT INTO tabMak (lat,longi,city,virtual,url) VALUES (?,?,?,1,?);');
	$lat=$v[12];
	$long=$v[13];
	$lat=str_replace("°", "", $lat);
	$lat=str_replace("+", "", $lat);
	$long=str_replace("°", "", $long);
	$long=str_replace("–", "-", $long);
	$long=str_replace(",", ".", $long);
	$lat=str_replace(",", ".", $lat);
	$city=$v[4].", ".$v[1].", USA";
	$url="https://www.google.com/maps/@".floatval($lat).",".floatval($long).",10z";
	echo $lat." ".$long." ".$city."<br>";
	$stmt -> execute(array(floatval($lat),floatval($long),$city,$url));
	// break;
} 
}
// filldb2();









?>