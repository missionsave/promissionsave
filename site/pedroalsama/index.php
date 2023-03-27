<?php //links usefull
// https://oklahoma.gov/okdhs/services/snap.html
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="../logo.png"> 
<title>Pedro Alsama</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
h3{font-size:17px; font-weight: bold;}
</style>
<div id="divbody" style="  max-width:690px; position:absolute; top:50px; bottom:0; left: 0; right: 0; margin: auto;">
<div id="a4" style="  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); max-width:690px;  top:0; bottom:0; left: 0; right: 0; margin: auto;">
<div id="content" style="  max-width:640px; top:0; bottom:0; left: 0; right: 0; margin: auto;">

 

<div>
<?php 
// $locimg="../wfp/";
// $your_text_variable="";
// $your_text_variable=file_get_contents ($locimg."WFP.html");
/////hack doc
// $your_text_variable=str_replace('Vivision.org','<span class="notranslate"> Vivision.org </span>',$your_text_variable);
// $your_text_variable=str_replace('Vivision ','<span class="notranslate">Vivision </span>',$your_text_variable);
// $your_text_variable=str_replace('"><img alt="" src="images/image3.png"',' float:left;"><img alt="" src="'.$locimg.'images/image3.png"',$your_text_variable);
// $your_text_variable=str_replace('"><img alt="" src="images/image2.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="'.$locimg.'images/image2.png" style="width: 100% !important; height: auto !important; ',$your_text_variable);
// $your_text_variable=str_replace('"><img alt="" src="images/image1.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="images/image1.png" style="width: 100% !important; height: auto !important; ',$your_text_variable); 
// echo $your_text_variable."<br>";  
?>

</div>
<div> 
<?php 
// $your_text_variable=file_get_contents ($f."BillGatesVivisionTechnology_andmethod_tofight.html"); 
// $your_text_variable=str_replace('Vivision.org','<span class="notranslate"> Vivision.org </span>',$your_text_variable);
// $your_text_variable=str_replace('Vivision ','<span class="notranslate">Vivision </span>',$your_text_variable);
// $your_text_variable=str_replace('<div id="publish-banner">','<div id="publish-banner" style="display:none;!important">',$your_text_variable);
// echo $your_text_variable."<br>"; 

if($f==""){
// require_once("../vendor/autoload.php");
// require_once("../parser.php"); 
}

require_once("../../../htdocs/vendor/autoload.php");
require_once("../connect.php"); 
require_once("../token.php"); 
require_once("parser.php"); 

$ip_address = $_SERVER['REMOTE_ADDR'];
$cc = file_get_contents("http://ipapi.co/$ip_address/country_code");

$cost="15,000 euros";
$costn="15,000 euros";
if($cc=="ZA")$costn="300,000 rand";
if($cc=="US")$costn="15,000 dolars";
if($cc=="AU")$costn="24,000 dolars";

$cost='&lt;video1&gt;';
$costn='<audio controls>
<source src="https://drive.google.com/uc?export=download&confirm=9iBg&id=1cZ8oNG68emoF9PqNVpzQUTC1DV2hbZgS" type="audio/mp3">
Seu navegador não suporta a tag de áudio.
</audio>';

$costn='<audio controls>
<source src="https://drive.google.com/u/0/uc?id=1cZ8oNG68emoF9PqNVpzQUTC1DV2hbZgS&export=download&confirm=t&uuid=76ca01da-78a9-4547-97e1-e9724f256e43&at=ANzk5s7tyuN4DI02WLvyqgUAo-ut:1679865404787" type="audio/mp3">
Seu navegador não suporta a tag de áudio.
</audio>';

$costn='<audio controls>
<source src="https://drive.google.com/u/0/uc?id=1cZ8oNG68emoF9PqNVpzQUTC1DV2hbZgS&export=download&confirm=t&uuid=76ca01da-78a9-4547-97e1-e9724f256e43" type="audio/mp3">
Seu navegador não suporta a tag de áudio.
</audio>';

// $costn='<audio controls>
// <source src="https://drive.google.com/uc?export=download&id=1cZ8oNG68emoF9PqNVpzQUTC1DV2hbZgS" type="audio/mpeg">
// Your browser does not support the audio tag.
// </audio>';
https://l.facebook.com/l.php?u=https%3A%2F%2Fdrive.google.com%2Ffile%2Fd%2F1GBmkfyAbAqqqzdc6JXby0HGgnBM7W__L%2Fview%3Fusp%3Dshare_link%26fbclid%3DIwAR1W-b7lIxGCqwJc00ua9fYw4LdTqe4VfJFjOsk1P7gpnbXiHG3Ul-9UpoY&h=AT0ShaGZMTCQxoE0DseGInaD0H9Lx30qYfZBEjGgOc-ygJ1nrEOAW0HxFkNJ4NQE8naLfPAus8hkaHYQO67HTqXpf7jbxyKiKr_xGDtPDgsJ49m6sprZYYBoPIlTd_QDoxuqQ2_9g8pdpx5i_2xc0A

echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vQAWBgX1tsjukQVVkz2Xtmc8g6JWbhyvvVOM7um1jp6gGdUts_Yqv3VZtXRuIGsbCEPyA6qqOk3nEJx/pub",array(
	'"><img alt="" src="images/image1.png"' => ' float:left;"><img alt="" src="images/image1.png"', 
	$cost => $costn, 
),"",1);



//  echo $cc;

 // Check if the client has an IPv6 address
if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    $client_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
    $client_ip = $_SERVER['REMOTE_ADDR'];
} else {
    // The client doesn't have an IPv6 address
    $client_ip = $_SERVER['REMOTE_ADDR'];
}
//  $ip_address = $_SERVER['REMOTE_ADDR'];

 // Make a request to the IPinfo.io API
 $response = file_get_contents("https://ip-geolocation.whoisxmlapi.com/api/v1?apiKey=at_zaGnNFCcyirgrgHBYQKTmqXkxbn5u&ipAddress=$client_ip");
//  $response = file_get_contents("https://ipinfo.io/$client_ip/json?token=8225583858d1af");
 
 // Parse the JSON response
 $data = json_decode($response, true);
 
 // Get the country code from the response
 $country_code = $data['location']['country'];
//  $country_code = $data['country'];
 
 // Output the country code
//  echo $country_code;


?>



</div>



<!-- <a href="https://www.vivision.org/wfp/" style="text-align:center;">Further reading, why don't you read our open site with WFP</a> -->
Patrocionador clique <a href="https://www.promition.org" style="text-align:center;">aqui</a>

</div>
</div>
</div>
<script>
function popup(){
	if(screen.width>500)return;
	var win = window.open("robot.html", "Title", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=200,top="+(screen.height-400)+",left="+(screen.width-840)); 
}
</script>
</html>

