<!--Comments-->
<?php
	
// https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-8GA30407VK1630742
?>
<!--Global vars-->
<?php
	$lat=39.3273571;
	$long=-8.937850;
	$balance=10;
?>
<?php
//rapidapi paypal
if(0){ 
$curl = curl_init(); 
curl_setopt_array($curl, [
	CURLOPT_URL => "https://paypaldimasv1.p.rapidapi.com/getAccessToken",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "secret=%3CREQUIRED%3E&clientId=%3CREQUIRED%3E&grantType=%3CREQUIRED%3E",
	CURLOPT_HTTPHEADER => [
		"content-type: application/x-www-form-urlencoded",
		"x-rapidapi-host: PayPaldimasV1.p.rapidapi.com",
		"x-rapidapi-key: d415a74093msha089bfe51bdf121p14a6ecjsnb979b818a109"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}

}

//reverse geo
if(0){
	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => "https://geocodeapi.p.rapidapi.com/GetNearestCities?range=0&longitude=".$long."&latitude=".$lat."",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: geocodeapi.p.rapidapi.com",
			"x-rapidapi-key: d415a74093msha089bfe51bdf121p14a6ecjsnb979b818a109"
		],
	]);

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		echo $response;
	}
}
?>

<!DOCTYPE html>
<html>
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="logo.gif?a">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta charset="UTF-8">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<head>
<style>
html { 
	scroll-behavior: smooth; 
	// color: #fff;
} 
html, body {
    // max-width: 100%;
    overflow-x: hidden;
}	
	
.button {
  padding:  5px 15px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #04AA6D;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry"></script>
<script type="text/javascript">
google.maps.LatLng.prototype.distanceFrom = function(latlng) {
  var lat = [this.lat(), latlng.lat()]
  var lng = [this.lng(), latlng.lng()]
  var R = 6378137;
  var dLat = (lat[1]-lat[0]) * Math.PI / 180;
  var dLng = (lng[1]-lng[0]) * Math.PI / 180;
  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
  Math.cos(lat[0] * Math.PI / 180 ) * Math.cos(lat[1] * Math.PI / 180 ) *
  Math.sin(dLng/2) * Math.sin(dLng/2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
  var d = R * c;
  return Math.round(d);
}
 
var loc1 = new google.maps.LatLng(39.3273571,-8.937850);
// var loc2 = new google.maps.LatLng(39.3600638,-9.1833094);
// var loc2 = new google.maps.LatLng(39.0435121,-9.270855);
// var loc2 = new google.maps.LatLng(39.3474385,-9.1481191);
var loc2 = new google.maps.LatLng(40.6379385,-8.6019448);
var dist = loc2.distanceFrom(loc1);
console.log(dist/1000);

var gd=google.maps.geometry.spherical.computeDistanceBetween (loc1, loc2);
console.log(gd);
</script>
</head>
<body>
<div style="position: fixed; left:0px; top:0px; z-index:1;  width: 100%; height:120px; color: #fff; background-color:orange; background-image:url(fundoshelf.jpg) ">
	<div style="margin: auto;">
	<div style="float:right;"><b>Saldo: <?php echo $balance;?></b>eur</div>
	<button id="buttonCarregar" class="button" style="float:right;" onclick="btcarregarf();">carregar</button>
	</div>
</div>



<div class="w3-card-4" id="divCarregar" style=" position: absolute;float:right; left:0px; top:120px;  width: 100%; height:0px;   ">
  <div class="w3-container w3-brown">
    <h2>Insira o montante a carregar:</h2>
  </div>
  <form class="w3-container" action="/action_page.php"> 
    <p>      
    <label class="w3-text-brown"><b>Euros</b></label>
    <input class="w3-input w3-border w3-sand" name="last" type="text"></p>
    <p>
    <button class="w3-btn w3-brown">Register</button></p>
  </form>
</div>

<div id="divNews" style="position: absolute; padding:0; left:0px; top:120px;  width: 100%; height:90%; background-color:white;   ">
 
</div>

<!--Global vars-->
<script>
var top1=120;
var output = document.getElementById("divNews"); 
var divCarregar = document.getElementById("divCarregar"); 
var divNews = document.getElementById("divNews"); 
var inputPay = document.getElementById("inputPay"); 


function btcarregarf(){
	console.log("w");
	divCarregar.style.height=33;
	divNews.style.top= top1+333+"px";
	inputPay.focus();
}


</script>
<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	console.log(position);
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude +
  "<br>altitude: "+ position.coords.altitude;
}
// getLocation();
function geoFindMe() {
	//acesso à localizaçao em definiçoes 
// var geolocation = Components.classes["@mozilla.org/geolocation;1"]
                            // .getService(Components.interfaces.nsIDOMGeoGeolocation);
	 if (!navigator.geolocation){
	   output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
	   return;
	 }

	 function success(position) {
	   var latitude  = position.coords.latitude;
	   var longitude = position.coords.longitude;

	   output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';

	   // var img = new Image();
	   // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
	   // output.appendChild(img);
	 }

	 function error(err) {
		console.warn('ERROR(' + err.code + '): ' + err.message);
		output.innerHTML ='ERROR(' + err.code + '): ' + err.message;
	   // output.innerHTML = "Unable to retrieve your location";
	 }

	 output.innerHTML = "<p>Locating…</p>";

	 navigator.geolocation.getCurrentPosition(success, error);
} 
geoFindMe();

 
</script>

</body>
</html>