<?php //Comments
	
// https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=EC-8GA30407VK1630742

$webview=0;
//For iOS
if ((strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile/') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari/') == false)) {
	$webview=1;
} 
//For Android
// echo $_SERVER['HTTP_X_REQUESTED_WITH'];
if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "") {
	$webview=1;
} 

?>

<?php 
	/*
	$hash = '<script>document.writeln(window.location.hash.replace("#", ""));</script>';
echo $hash;
	//nao funciona
	echo "rr".strpos($hash,"script");
	if( strpos($hash,"cb")!== false ){
	echo "fo";
	// echo 'window.fbAsyncInit=fbentrar;';
	}
	return;
	*/
?>

<?php //Global vars
/* 	// $site="vivision.org";
	// $site="www.".$site;
	// $site="https://".$site;
	$site="https://".$_SERVER['SERVER_NAME'];
	$location="";
	$id=0;
	$name="nome";
	$email="email";
	$lat=39.3273571;
	$long=-8.937850;
	$balance=10;
	
	$composer ='vendor/autoload.php';
	
	$lang=1;
	require_once($location."connect.php");
	// require_once("dict.php");
	function d($val){return $val;}
	require_once("token.php");
	require_once("vendor/autoload.php");
	require_once("google_login.php");
	require_once("facebook_login.php");
	require_once("parser.php");
	// $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	// echo $url;
	// echo $_SERVER['SERVER_NAME'];
	// echo $site;
	// return; */
?>
 

<?php //utils
function setCookieToken($token){ 
	echo '<script>setCookie("vivisiont","'.$token.'",365);</script>';
	$_COOKIE["vivisiont"]=$token;
}

// https://stackoverflow.com/questions/22143250/xmlhttprequest-cross-domain
if(@$_POST["action"]=="test")
{
 setCookie("testero","teste");	
 echo "tt".@$_COOKIE["testero"];
 return;
}

// print_r($_SERVER);
// exit;

// echo $_SERVER["REQUEST_URI"];
// exit;
?>
<?php
	
?>



<?php //check if have token logged then autolog
	// create_token();
	// if(@$_COOKIE["vivisionl2"]!=""){
	// echo "on";
	
// }

?>


<?php //reverse geo
 


function reverse_geo($lat,$long){
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
<html  lang="<?php echo $langbr;?>" >
	<!--<meta name="google" value="notranslate">-->
<?php if($langbr!="en")echo '<meta name="google" value="notranslate">'; ?>
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes">
<meta charset="UTF-8">
 
<meta property="og:type"               content="article" />
<meta property="og:title"              content="Promissionsave" />
<meta property="og:description"        content="By buying strawberries and roasted sweet potatoes here, you are saving people from hunger." />
<meta property="og:image"              content="https://promissionsave.com/images/plantel-de-fresones-albion-520x520.jpeg" />


<title>Promissionsave alpha</title>
<style>
.loader {
    width: 48px;
    height: 48px;
    border: 5px solid blue;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    } 
</style>	
<div id="div_loader" class="loader" style="display:none; position:fixed; margin:auto; top: 30%;  z-index:100;">
</div>
<script>
	div_loader.style.left=window.innerWidth/2-24+"px";
	div_loader.style.display="block";
</script>

<?php  
	/*xhttp.php c??pia para meeting.vivision.org de vivision.org*/
	// $location="./";
	$location="../../htdocs/"; 
	$site="https://".$_SERVER['SERVER_NAME'];
	$just_domain = "https://".preg_replace("/^(.*\.)?([^.]*\..*)$/", "$2", $_SERVER['HTTP_HOST']);
	$composer =$location.'vendor/autoload.php';	
	$id=0;
	$name="nome";
	$email="email";
	// $lat=39.3273571;
	$long=-8.937850;
	$lang=0;
	$idioms=array("en","pt","es","fr","it");
	$langbr="en";
	if(@$_SERVER['HTTP_ACCEPT_LANGUAGE'])$langbr = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if( @$_COOKIE['lang'] )$langbr=$_COOKIE['lang'];
	// $langbr="ar";
	// $langbr="en";
	$balance=10;
	require_once("connect.php");	
	require_once( "token.php");	
	require_once( "dict.php");	
	require_once($location."vendor/autoload.php");	
	require_once($location."google_login.php");	
	require_once($location."facebook_login.php");
	require_once("parser.php");
?>



<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

	<!-- preconnect 
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://d1o9e4un86hhpc.cloudfront.net">
			<link rel="preconnect" href="https://advancedmedia.websol.barchart.com">-->
	
<script src="https://accounts.google.com/gsi/client" async defer></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<head>

<style>
.ml2 {
  font-weight: 900;
  font-size: 18px;
}
.ml2 .word {
  display: inline-block;
  line-height: 1em; 
  vertical-align: text-top;
  color: #F5F5F5;
  text-shadow: 1px 1px 2px black;
}
.ml3 {
  font-weight: 900;
  font-size: 18px;
}
.ml3 .word {
  display: inline-block;
  line-height: 1em; 
  vertical-align: text-top;
  color: #F5F5F5;
  text-shadow: 1px 1px 2px black;
} 
</style>
<style>
.center_flex {
  display: flex;flex-direction: row;   flex-wrap: nowrap;
  align-items: center;
  justify-content: center;
  
}	
	
	
html { 
	scroll-behavior: smooth; 
	// color: #fff;
} 
html, body {
    // max-width: 100%;
    overflow-x: hidden;
}	
input {
  outline: 0;
  border-width: 0 0 2px;
  border-color: blue
}
input:focus {
  border-color: green
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.button {
  padding:  5px 15px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #3e8f41;
  
  border: none;
  border-radius: 5px;
  box-shadow: 0 4px #999;
}

.button:hover {background-color: #04AA6D}

.button:active {
  background-color: #04AA6D;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}

/* headlines with lines */
.decorated{
     overflow: hidden;
     text-align: center;
 }
.decorated > span{
    position: relative;
    display: inline-block;
}
.decorated > span:before, .decorated > span:after{
    content: '';
    position: absolute;
    top: 50%;
    border-bottom: 1px solid;
    width: 100px;
    margin: 0 20px;
}
.decorated > span:before{
    right: 100%;
}
.decorated > span:after{
    left: 100%;
}
</style>
<style>  /*buttonpaypal*/
	
.buttonpp { //background-image: linear-gradient(#A9A932, #E5D153, #E9CC0E);
 //width: 170px; //change width of button here
  height: 32px;
 color: #2e3192;
 text-decoration: none;
 cursor: pointer;
 display: block;
 text-align: center;
 position: relative;

 /* BACKGROUND GRADIENTS */
 background: #FEE1A5;
 background: -moz-linear-gradient(top, #FFF, #FEE1A5 50%, #FFB829 51%,
#FEE1A5 95%, #FEE1A5);
 background: -webkit-gradient(linear, left top, left bottom,
color-stop(0, #FFF), color-stop(.5, #FEE1A5), color-stop(.51, #FFB829),
color-stop(.95, #FEE1A5), color-stop(.96, #FEE1A5), to(#FEE1A5));

 /* BORDER RADIUS */
 -moz-border-radius: 18px;
 -webkit-border-radius: 18px;
 border-radius: 18px;

 border-bottom: 1px solid #FFF;
 border-top: 1px solid #FFB829;
 border-left: 1px solid #FEE1A5;
 border-right: 1px solid #FEE1A5;

 /* TEXT SHADOW */

 text-shadow: 0px 1px 1px white;

 /* BOX SHADOW */
 -moz-box-shadow: 0 1px 3px #777;
 -webkit-box-shadow: 0 1px 3px #777;
 box-shadow: 0 1px 3px #777;
 font: italic bold 18px/32px helvetica, arial;
}

 /* WHILE HOVERED */
 .buttonpp:hover {
 background: #FEE1A5;
 background: -moz-linear-gradient(top, #FFF, #FEE1A5 50%,
#FFB829 51%, #FEE1A5 95%, #FEE1A5);
 background: -webkit-gradient(linear, left top, left bottom,
color-stop(0, #FFF), color-stop(.5, #FEE1A5), color-stop(.51, #FFB829),
color-stop(.95, #FEE1A5), color-stop(.96, #FEE1A5), to(#FEE1A5));
 -moz-box-shadow: 0 1px 2px black;
 -webkit-box-shadow: 0 1px 2px black;
 }

 /* WHILE BEING CLICKED */
 .buttonpp:active {
 -moz-box-shadow: 0 2px 6px black;
 -webkit-box-shadow: 0 2px 6px black;
}
</style>
<style> //menu
.menui {
  display: inline-block;
  cursor: pointer;
}

.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: #fff;
  margin: 6px 0;
  transition: 0.4s;
}

.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px);
  transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px);
  transform: rotate(45deg) translate(-8px, -8px);
}
</style>

<script>

	
</script>
<script> <!-- cookie -->
function setCookie(cname,cvalue,exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires=" + d.toGMTString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
function gentoken(){
	document.getElementById('token').value=md5(Math.random()+document.getElementById('email').value);
}
function test(){
	// var token=getCookie("bpmfund");				
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "index.php", true);
	var params = 'action=test';
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	//xhttp.onreadystatechange = function () {OnReadyStateChanged (xhttp, form)};;
	xhttp.onreadystatechange = function () { 
		// obj = JSON.parse(xhttp.responseText);			  
		// document.getElementById('amount').value=Number(obj.amount).toString();
		// document.getElementById('comment').value=(obj.comment).toString();
		// document.getElementById('name').value=(obj.name).toString();
		// document.getElementById('email').value=(obj.email).toString();
		// amountFunction();
		console.log("resp1: "+xhttp.responseText);
		// if(xhttp.responseText.includes('added')){
		// Swal.fire("E-mail confirmado. Escolha a quantia a investir e salve." ,'', 'success');
		// }else{
		// 
		// }
		
		
	}; 
	
	xhttp.send(params); 
	
} 
test();
function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
};
</script>



</head>
<body> 
<div id="mdiv" style=" max-width: 690px;  position: fixed;  margin:   auto; left: 0; right: 0; top:0px; z-index:1;  width: 100%; height:52px; color: #fff;   background-image:url(fundoshelf.jpg) ">
	
<script>//add image laterals
var div = document.createElement("div");
var divr1 = document.createElement("div");
var divr = document.createElement("div");
document.body.appendChild(div);
document.body.appendChild(divr);
document.body.appendChild(divr1);
function adjust(){
	if(window.innerWidth<900){div.style.width="0px"; return;}
	var  dw=(window.innerWidth-mdiv.offsetWidth)/2-8;
	var  dh=(window.innerHeight );
	div.style.position = "fixed";
	div.style.width = dw+"px";
	div.style.height = dh+"px";
	div.style.left = "0px";
	div.style.top = "0px";
	div.style.background = "#8B0000";
	div.style.color = "white";
	div.style.zIndex  = "0";
	div.innerHTML = '<img src="batata-doce-cozida-no-micro-ondas-1024x576.jpg" style="width:100%;height:auto;"/>';
	
	divr1.style.position = "fixed";
	divr1.style.width = dw+"px";
	divr1.style.height = dh+"px";
	divr1.style.right = "0px";
	divr1.style.top = "0px";
	divr1.style.background = "#8B0000";
	divr1.style.color = "white";
	divr1.style.zIndex  = "0";
	divr1.innerHTML = '<img src="Garden_strawberry_(Fragaria_??_ananassa)_single2.jpg" style="width:100%;height:auto;"/>  <img src="como-plantar-batata-doce-em-vaso-3.jpg" style="width:100%;height:auto;"/>';
	
 
} 
adjust(); 
/*
var xhttp = new XMLHttpRequest(); 
// <?php compilefilehtmlcssinline("calculator.html"); ?>
// xhttp.open("POST", "cis_calculator.html", true);
xhttp.open("POST", "calculator.html", true);
xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
xhttp.onreadystatechange = function () {   
	const scriptEl = document.createRange().createContextualFragment(xhttp.responseText);
	divr.innerHTML="";
	divr.appendChild(scriptEl);
	// divr.innerHTML=xhttp.responseText;
	// var scripts = divr.getElementsByTagName("script");
	// for (var i = 0; i < scripts.length; i++) {
		// eval(scripts[i].innerText);
	// }
}; 
xhttp.send("");
*/
window.onresize = function(){adjust();};
	
</script>
	
	
	<div style="margin: auto;"> 
	
	<div id="divEntrar" style=" max-width: 690px;  position: fixed;  margin:   auto; left: 0; right: 0; top:0px; z-index:2;  width: 100%; height:50px; font-size: 10px;  "> 
	
		<div id="div_menu_x" class="menui" style="float:left; margin-left:5px; " onclick="menuf(this)">
		  <div class="bar1"></div>
		  <div class="bar2"></div>
		  <div class="bar3"></div>
		</div>
		<div style=" margin-right: auto;  margin-left: auto;   max-width:250px;  ">
			<div style="  padding-left:0px;  word-wrap: break-word;  ">Vision - <?php echo d('Fighting hunger') ?><br> </div>

			<button id="button_makp" class="btn btn-primary" style="max-width:110px; float:left; margin-top:10px; font-size: 10px; color:#000; background-image: linear-gradient(0deg, rgba(34,195,160,1) 0%, rgba(113,136,42,1) 23%, rgba(133,199,144,1) 42%, rgba(240,204,126,1) 100%);  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;" onclick="button_makpf();"><?php echo d('near you')?></button>
			
			
			
		</div>

		<script> 
		function webview(){ 
			if( /Android|iPhone|iPad|iPod/i.test(navigator.userAgent)  && <?php echo $webview;?>) {
				window.location="intent:googlechrome://navigate?url=promissionsave.com?i=1#Intent;end";	
			}  
		}
		</script>
		<button id="buttonEntrar" class="buttonpp notranslate" style="float:right;  " onclick='webview(); btentrar();'><?php echo d('login')?></button>
		
		<button id="buttonCarregar" class="buttonpp" style="max-width:110px; float:right; margin-top:0px;  display:none; color:#000; " onclick='webview(); btcarregarf();'><?php echo d('buy')?></button>
		
		<div id="div_balance" style="border-left:solid; border-right:solid; border-top:solid; float:right; margin-right:10px; padding: 5px 10px; "><?php echo d("Balance").":<br>".$balance."EUR"; ?>
		</div>
	</div>
	
	
 
	</div>
<style>
.btn_menu{ 
	padding-top:22px;
	font-size:12px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white; 
}
</style>

	<div id="div_menu" style="max-width: 690px;  position: fixed;  margin:   auto; left: -380px;   top:0px;   width: 350px; height:350px; top:52px;  z-index:2; color:#000;  -moz-opacity:.80; filter:alpha(opacity=80); background-color: #fff;  box-shadow: 10px 10px grey; display:flex; ">
		<div style="display:flex; flex-direction: column ;">
		<br>
			<div class='notranslate' style="display:flex; flex-direction: row ;">
				<?php 
					
					$a='<a   class="buttonpp" style="padding:0px 10px; margin:auto; font-size:14px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;"id="btn_donate_funds" onClick="div_langf(&quot;langbr&quot; )">langbr</a>';
					$b="";
					for ($i = 0; $i < count($idioms); $i++) { 
						if($idioms[$i]==$langbr)continue;
						$b.=str_replace("langbr",$idioms[$i],$a); 
					}
					echo $b;
				
				?>
			</div>
		<br>
		<a   class="buttonpp" style="padding:0px 10px; margin:auto; font-size:14px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;"id="btn_donate_funds" onClick="div_don_fundsf();">
				Donate funds to poor people
			</a>
		<br>	
		<a href="" class="buttonpp" style="padding:0px 10px; margin:auto; font-size:13px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;" id="btn_donate_funds" onClick="">
				Transfer funds between our accounts - Planned
		</a>
		<br>	
		
		<!--<a href="biography.html" class="buttonpp" style="margin:auto; font-size:12px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;"id="btn_donate_funds" onClick="">
				Biography - Planed
		</a>
		<br>-->	
		
		<a href="" class="buttonpp" style="padding:0px 10px; margin:auto; font-size:12px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;"id="btn_donate_funds" onClick="document.cookie = 'vivision' +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;'; location.reload();">
				Logout
		</a>
		<br>	
		
		<a   class="buttonpp" style="padding:0px 10px; margin:auto; font-size:12px;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue; color:white;"id="btn_donate_funds" onClick="btn_qrf(); ">
				Share the site
		</a>
		</div>
	</div>
	
	
	<div id="divlog" style="margin-top:52px; border-top: 2px solid #928F86;">
	
	</div>
	 
</div>
<?php //head

if(@$_GET['action']=="paypal_confirm"){
	echo '<script>Swal.fire("Dep??sito em processamento. Obrigado pela sua confian??a. Fa??a refresh se o seu saldo ainda n??o est?? actualizado." ,"", "success");</script>';
}
?>
<?php //se logged
	if($email!="email") 
		echo '<script>document.getElementById("buttonEntrar").style.display="none";document.getElementById("buttonCarregar").style.display="block";</script>';
 
?>



<div id="divCarregar" class="w3-card-4" style="margin:   auto; left: 0; right: 0; max-width: 600px; position: absolute; float:right; left:0px; top:50px;  width: 100%; overflow-x:hidden; height:0px; border:none;  ">
	<div class="w3-container w3-brown" style="text-align:center; ">
		<h3>Enter the amount to charge:</h3>
	</div>
		<!-https://www.paypal.com/lv/smarthelp/article/how-do-i-add-paypal-checkout-to-my-custom-shopping-cart-ts1200 ->
	<form autocomplete="off" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
		<input type='hidden' name='business' value='superbem@gmail.com'> 
		<input type='hidden' name='image_url' value='<?php echo $site; ?>/logo.gif'> 			
		<input type='hidden' name='item_name' value='Deposito para <?php echo $name;?>'>
		<input type='hidden' name='item_number' value='1'> 
		<input type='hidden' name='no_shipping' value='1'> 
		<input type='hidden' name='currency_code' value='EUR'>
		<input type='hidden' name='notify_url' value='<?php echo $site; ?>/notify.php'>
		<input type='hidden' name='cancel_return' value='<?php echo $site; ?>/cancel.php'>
		<input type='hidden' name='return' value='<?php echo $site; ?>/?action=paypal_confirm'>
		<input type="hidden" name="cmd" value="_xclick">  
		<label class="w3-text-brown"><b>Valor do dep??sito:</b></label>
		<div style="display: flex; justify-content: center;  margin: auto; left: 0; right: 0; max-width: 600px; ">      
			<input id="inputPay"  autocomplete="false" style="float:right; text-align: right; width:100px;" name="amount" onfocus="input_pay_f(); " step="1" value="10" min="10" type="tel" onkeyup="input_pay_f();"> 
			<label class="w3-text-brown" style="float:right; margin-top:3px;margin-left:10px; "><b>EUR</b></label>
		</div>
		<div style="display: flex; justify-content: center; top:140px; width: 50%; margin: auto; left: 0; right: 0; max-width: 1000px; position: absolute;"> 
			<input style="width: 80px; " type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but03.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
		</div>
	</form>	
		<div id="div_pay_label" style="margin-top:80px; line-height: 1.0;" >
		</div>
</div>


<div id="div_don_funds" class="w3-card-4" style="margin:   auto;padding-top:10px; left: 0; right: 0; max-width: 600px; position: absolute; float:right; left:0px; top:50px;  width: 100%; overflow-x:hidden; height:0px; border:none;  ">

	Donate Funds to poor people, we already are donating 30% of all our production, but with you we can donate more.<br>
	We give a hand full of 3 strawberries to each children in need everyday.
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_donations"><input type="hidden" name="business" value="danielchanfana@gmail.com"><input type="hidden" name="lc" value="PT"><input type="hidden" name="item_name" value="Mission Save"><input type="hidden" name="no_note" value="0"><input type="hidden" name="currency_code" value="EUR"><input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest"><input type="image" src="https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - A forma mais f??cil e segura de efetuar pagamentos online!"><img alt="" border="0" src="https://www.paypalobjects.com/pt_PT/i/scr/pixel.gif" width="1" height="1"></form>

</div>


<script>
	function btentrar(){ 
	
	// https://myaccount.google.com/u/2/permissions?continue=https%3A%2F%2Fmyaccount.google.com%2Fu%2F2%2Fsecurity
	google.accounts.id.initialize({
      client_id: '<?php echo $clientID; ?>',
      callback: handleCredentialResponse
    });
    google.accounts.id.prompt(); 
	
	intervalmovdiv = setInterval(my_timer_login_descend, 100);
	div_login.style.height=230+"px";
	div_login1.style.left= 0+"px";
	div_login2.style.left="1200px";
	div_login3.style.left="2400px";
	document.documentElement.scrollTop=0;
}
</script>

<div id="div_login" class="w3-card-4" style="margin:   auto; left: 0; right: 0; max-width: 600px; position: absolute; float:right; left:0px; top:50px;  width: 100%; overflow-x:hidden; height:0px; border:none;  ">
	 
	 <div id="div_login1" style="margin:   auto; left: 0; right: 0; max-width: 600px; position: absolute; float:right; left:0px;   width: 100%; overflow-x:hidden;   border:none;  ">
	  
		<a id="btn_login_facebook" style="  display: flex; justify-content: center;  margin: auto; margin-top:20px; left: 0; right: 0; max-width: 200px; " onclick='div_loader.style.display="block";'  class="btn btn-primary" href="<?php echo $site."?action=fblogin"; ?>" >Enter with Facebook</a>

		
		<div style="   justify-content: center;  margin: auto;  margin-top:20px; left: 0; right: 0; max-width: 200px;">
			<div class="decorated"><span>or</span></div> 
		</div>


		<a id="btn_login_google" class="btn btn-primary" style=" display: flex; justify-content: center;  margin: auto;  margin-top:20px; left: 0; right: 0; max-width: 200px; background-color: #8064A2 !important"  onclick='div_loader.style.display="block";'  href="<?php echo $client->createAuthUrl(); ?>" >Enter with Google</a>

		
		
		
		<!--<a id="btn-fblogin" class="btn btn-primary" style=" display: flex; justify-content: center;  margin: auto;  margin-top:20px; left: 0; right: 0; max-width: 200px; background-color: #00cc00 !important" onclick="move_div_login();" >Enter with email</a>-->
	</div>
	
	
	 <div id="div_login2" style="margin:   auto; left: 600px; right: 0; max-width: 600px; position: absolute; float:right;     width: 100%; overflow-x:hidden;   border:none; overflow-y:hidden; ">
	  
		<div class="input-group mb-3" style="max-width: 200px; margin: auto;  margin-top:10px; left: 0; right: 0; z-index: 0; !important;"> 
			<input name="email" type="text" class="form-control" placeholder="Endere??o de e-mail" aria-label="Username" aria-describedby="basic-addon1">
		</div>
		
		<div class="input-group mb-3" style="max-width: 200px; margin: auto;  margin-top:10px; left: 0; right: 0; z-index: 0; !important;"> 
			<input name="password" type="text" class="form-control" placeholder="Palavra-passe" aria-label="Username" aria-describedby="basic-addon1">
		</div>
		
		<a id="btn-fblogin" class="btn btn-primary" style=" display: flex; justify-content: center;  margin: auto;  margin-top:10px; left: 0; right: 0; max-width: 200px; background-color: #8064A2 !important" href="<?php   ?>" >Enter</a>
		
		<div style="   justify-content: center;  margin: auto;  margin-top:10px; left: 0; right: 0; max-width: 200px;">
		<div class="decorated"><span>ou</span></div> 
		</div>
		
		<a id="btn-fblogin" class="btn btn-primary" style=" display: flex; justify-content: center;  margin: auto;  margin-top:0px; left: 0; right: 0; max-width: 200px; background-color: #00cc00 !important" onclick="move_div_login_to3();" >Create account</a>
	</div>
	
	 <div id="div_login3" style="margin:   auto; left: 600px; right: 0; max-width: 600px; position: absolute; float:right;     width: 100%; overflow-x:hidden;   border:none; overflow-y:hidden; ">
	  
		<div class="input-group mb-3" style="max-width: 200px; margin: auto;  margin-top:10px; left: 0; right: 0; z-index: 0; !important;"> 
			<input name="email" type="text" class="form-control" placeholder="e-mail address" aria-label="Username" aria-describedby="basic-addon1">
		</div>
		
		<div class="input-group mb-3" style="max-width: 200px; margin: auto;  margin-top:10px; left: 0; right: 0; z-index: 0; !important;"> 
			<input name="password" type="text" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
		</div>
		
		<div class="input-group mb-3" style="max-width: 200px; margin: auto;  margin-top:10px; left: 0; right: 0; z-index: 0; !important;"> 
			<input name="passwordr" type="text" class="form-control" placeholder="Repeat password" aria-label="Username" aria-describedby="basic-addon1">
		</div>
		
		<a id="btn-fblogin" class="btn btn-primary" style=" display: flex; justify-content: center;  margin: auto;  margin-top:10px; left: 0; right: 0; max-width: 200px; background-color: #8064A2 !important" href="<?php echo $site."?action=fblogin"; ?>" >Enter</a>
		 
		 
	</div>
	
	
	
</div>

 

<script>
	 div_body.style.display="block";
</script>

<div id="div_container" style="box-shadow: 0 0 0.5cm rgba(0,0,0,0.1);  margin: auto; left: 0; right: 0; max-width: 690px; position: absolute; overflow-x:hidden; padding:0; left:0px; top:55px;  width: 100%;   background-color:white;   ">

<div id="divNews" onscroll="divNewsscrollf()" style="line-height: 1.6;">
<!--img style="float:right; width:100px; height:auto;"src="sweet_potatoes_oven_baked-1125x1500.webp"></img>-->
<img style="float:right; width:100px; height:auto;"src="images/plantel-de-fresones-albion-520x520.jpeg?"></img>


  <script type="text/javascript" src="https://www.gstatic.com/_/translate_http/_/js/k=translate_http.tr.en_GB.jUY4_WDT6tY.O/d=1/exm=ajaxproxy,el_conf/ed=1/rs=AN8SPfo-BMNf26XhheE95_VcZtMnJF0ToQ/m=navigationui" data-environment="prod" data-proxy-url="https://promissionsave-com.translate.goog" data-proxy-full-url="https://promissionsave-com.translate.goog/index1.html?_x_tr_sl=en&amp;_x_tr_tl=fr&amp;_x_tr_hl=pt-PT&amp;_x_tr_pto=wapp" data-source-url="https://promissionsave.com/index1.html" data-source-language="en" data-target-language="<?php echo $langbr;?>" data-display-language="pt-PT" data-detected-source-language="" data-is-source-untranslated="false" data-source-untranslated-url="https://translate.google.com/website?sl=en&amp;tl=fr&amp;hl=pt-PT&amp;client=webapp&amp;u=https://promissionsave.com/index1.html&amp;anno=2" data-use-in-place-translation="true" data-client="tr"></script>
  <script>function gtElInit() {var lib = new google.translate.TranslateService();lib.translatePage('', '<?php echo $langbr;?>', function () {});}</script>
  <?php if($langbr!="en") 
  echo '<script src="https://translate.google.com/translate_a/element.js?cb=gtElInit&amp;hl=pt-PT&amp;client=wt" type="text/javascript"></script>'; ?>
<style>
#goog-gt-tt, .goog-te-balloon-frame{display: none !important;} 
.goog-text-highlight { background: none !important; box-shadow: none !important;}
</style>



<?php 

// $ff=file_get_contents("https://promissionsave-com.translate.goog/index1.html?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt-PT&_x_tr_pto=wapp");
// echo $ff;
// file_put_contents("ff.txt",$ff);
// echo parcegoogledoc("Vivisionhome.html",array(
// echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vThTN29m3TTNojOyGrgPVYfV9Gdx56KklDlD_t-l8MlU31oGsv8vMZkbstOkURjGT4FNTFSXIiW2UPH/pub",array(
// echo parsegooglehttp("https://promissionsave-com.translate.goog/index1.html?_x_tr_sl=pt&_x_tr_tl=en&_x_tr_hl=pt-PT&_x_tr_pto=wapp",array(

echo parsegooglehttp("https://docs-google-com.translate.goog/document/d/e/2PACX-1vThTN29m3TTNojOyGrgPVYfV9Gdx56KklDlD_t-l8MlU31oGsv8vMZkbstOkURjGT4FNTFSXIiW2UPH/pub?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt-PT&_x_tr_pto=wapp",array(
'"><img alt="" src="images/image1.png"' => ' float:left;"><img alt="" src="images/image1.png"', 
),"",1);
?>
</div>
<!--<iframe title='People who died from hunger' src='https://www.theworldcounts.com/embed/challenges/2?background_color=white&color=black&font_family=%22Helvetica+Neue%22%2C+Arial%2C+sans-serif&font_size=14' style='border: none' height='100' width='300'></iframe>-->
<style>
p{line-height: 1.1;}
</style>

<style>#google_translate_element,.skiptranslate{display:none;}body{top:0!important;}</style>

<div id="div_maknear" style="  margin: auto; max-height:200px; overflow:hidden;">  
	<div id="button_near" class="center_flex" style="  padding-left: 20px; padding-right: 20px; ">
		<button  class="button" style=" font-size: 16px;  " onclick="button_makpf(); geoFindMe1();"><?php echo d('Please click here to see if there is a <b>food machine</b> near you')?></button><br>
	</div>	
	<div id="cong_ml2" class="ml2"></div>
	<div id="cong_ml3" class="ml3"></div>
	<span id="span_maknear" style="color:green; display:none; "><b><?php echo d('There is a plan to put a machine selling strawberries and roasted sweet potatoes near you')?>:</b></span>
</div>




<div id="divNews1" onscroll="divNewsscrollf()" style="line-height: 1.6;">
<style>
.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
}
.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
<?php 
// echo parcegoogledoc("wfp/WFP.html",array(
// echo parsegooglehttp("index1.html",array(
echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vSAox75sL1yTcN4gbYaycpQmS5McJ63H0wgvMc-c5I8qo_HSk15tUJrkLwM2FaLG3Yq6Wa4vHWKqDxz/pub",array(
'width: 657.50px; height: 374.62px;' => ' width: 100% !important; height: auto !important;',
'width: 660.50px; height: 469.59px;' => ' width: 100% !important; height: auto !important;',
'"><img alt="img1"' => ' width: 100% !important; height: auto !important;"><img alt="img1"',
'"><img alt="img2"' => ' width: 100% !important; height: auto !important;"><img alt="img2"',
'"><img alt="estrutura"' => ' float:left;"><img alt="estrutura"',
'"><img alt="" src="images/image3.png"' => ' float:left;!important;"><img alt="" src="$addpathimages/image3.png"',
'"><img alt="" src="images/image2.png" style="' => ' width: 100% !important; height: auto !important;"><img alt="" src="$addpathimages/image2.png" style="width: 100% !important; height: auto !important; ',
'"><img alt="" src="images/image1.png" style="' => ' width: 100% !important; height: auto !important;"><img alt="" src="$addpathimages/image1.png" style="width: 100% !important; height: auto !important; ',
'&lt;t video1&gt;' => '<div class="video-container"><iframe style="width:100%; "    src="https://www.youtube.com/embed/_EygIwvFI0Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>',
),"wfp/");     
?>
</div>

<div id="div_embed" style="top:400px; padding: 0px;  ">
<?php 
	$p=@$_GET['p'];
	if($p!=""){
		$p=explode("/",$p);
		$p=$p[ count($p)-1 ];
		$p=explode(".",$p)[0];
		// echo "->".$p;
		$f=$p."/";
		// include( $p."/index.php?f=".$p."/");
		if(file_exists($p."/index.php"))include( $p."/index.php");
		echo "<script>divbody.style.all='unset'; div_maknear.style.display='none'; divNews.style.display='none'; divNews1.style.display='none';</script>";
		
	}
?>
</div>



</div>



 
<!--Global vars-->
<script>
// console.log(tab_mak);
var top1=100;
var output = document.getElementById("divlog"); 
var divCarregar = document.getElementById("divCarregar"); 
var div_login = document.getElementById("div_login"); 
var div_login1 = document.getElementById("div_login1"); 
var div_login2 = document.getElementById("div_login2"); 
var div_login3 = document.getElementById("div_login3"); 
var div_pay_label = document.getElementById("div_pay_label"); 
var divNews = document.getElementById("div_container"); 
var div_maknear = document.getElementById("div_maknear");  
var inputPay = document.getElementById("inputPay"); 
var intervalmovdiv; 

var balance=<?php echo $balance; ?>;

function div_don_fundsf(tog=1){ 
	history.pushState({}, null, "https://promissionsave.com/?s=donate");
	if(tog)menuf(div_menu_x);
	document.documentElement.scrollTop=0;
	intervalmovdiv = setInterval(myTimer, 10);
	// console.log("w");
	div_don_funds.style.height=220+"px";
}

function btcarregarf(){
	intervalmovdiv = setInterval(myTimer, 10);
	// console.log("w");
	divCarregar.style.height=220+"px";
	// divNews.style.top= top1+333+"px";
	inputPay.type = 'tel';
	inputPay.setSelectionRange(2, 2);
	inputPay.type = 'Number';
	inputPay.focus();
	inputPay.removeAttribute('autocomplete');
	document.documentElement.scrollTop=0;
	console.log("d",divNews.scrollTop,divNews.style.top);
	console.log(document.documentElement.scrollTop  );
}
function myTimer() {
	// console.log(divNews.style.top);
	var divtop=parseInt(divNews.style.top, 10);
	if(divtop>=280){
		clearInterval(intervalmovdiv);
		console.log(divNews.clientHeight);
		return;
	}
	divNews.style.top=  divtop+10+"px";
	// divNews.style.left=  divtop+10+"px";
}

function paypal_confirm(){
	console.log("da");
}

function my_timer_login_descend() {
	// console.log(divNews.style.top);
	var divtop=parseInt(divNews.style.top, 10);
	var divmakn=parseInt(div_maknear.style.top, 10);
	if(divtop>=280){
		clearInterval(intervalmovdiv);
		console.log(divNews.clientHeight);
		return;
	}
	divNews.style.top=  divtop+30+"px";
	div_maknear.style.top=  divmakn+20+"px";
	// divNews.style.left=  divtop+10+"px";
}
function handleCredentialResponse(response){
	// console.log(response);
	var credential=response["credential"];
	// console.log(credential);
	window.location='<?php echo $site; ?>/?credential='+credential;
}


function move_div_login(){
	console.log(div_login1.style.left);
	div_login2.style.left="1200px";
	div_login3.style.left="2400px";
	intervalmovdiv = setInterval( function() { timer_move_div_login(2); }, 10);
	
}
function timer_move_div_login(topos){ 
	var divp=parseInt(div_login1.style.left, 10);
	var divp2=parseInt(div_login2.style.left, 10);
	var divp3=parseInt(div_login3.style.left, 10);
	if( (topos==2 && divp2<=0) || (topos==3 && divp3<=0)  ){
		clearInterval(intervalmovdiv); 
		return;
	}
	div_login1.style.left=  divp-20+"px";
	div_login2.style.left= divp2-20+"px";
	div_login3.style.left= divp3-20+"px";
	// console.log(div_login1.style.left);
}
function move_div_login_to3(){
	console.log(div_login1.style.left);
	// div_login1.style.left="-1000px";
	intervalmovdiv = setInterval( function() { timer_move_div_login(3); }, 10);
	
}
 

function input_pay_f(){
	div_pay_label.innerHTML="Fa??a j?? o check out para poder levantar "+(balance+ parseInt(inputPay.value))+" EUR em batatas doces assadas nas futuras m??quinas." ;
	
}
 
var div_menu_visible=0;
function button_makpf(){ 
	if(div_menu_visible)menuf(div_menu_x);
	if(div_maknear.style.display=="none")div_maknear.style.display;
	div_maknear.style.display="block";
	const y = div_maknear.getBoundingClientRect().top + window.scrollY;
	window.scroll({
	  top: y-50,
	  behavior: 'smooth'
	});
}

function menuf(x) {
	x.classList.toggle("change");
	if(div_menu_visible){
		div_menu_visible=0;
		div_menu.style.display="none";
	}else{
		div_menu_visible=1;
		div_menu.style.display="block";
		// intervalmovdiv = setInterval( function() { timer_move_div_login(3); }, 10);
	}
	div_menu.style.left=div.offsetWidth+"px";
	// console.log(div.offsetWidth);
}

function logged(){
	
}
logged();

function divNewsscrollf(){
	return;
	console.log("d",divNews.scrollTop,divNews.style.top);
	console.log(document.documentElement.scrollTop  );
	// if(divNews.scrollTop<top1)divNews.scrollTop=top1;
}
 
function btn_qrf(){ 
	var div_qr = document.createElement("div");
	document.body.appendChild(div_qr);
	var div_qrx = document.createElement("div");
	document.body.appendChild(div_qrx);
// function adjust(){ 
	var  dw=(mdiv.offsetWidth)-80;
	var  dh=(window.innerHeight )-160;
	var dl= (window.innerWidth-dw)/2;
	div_qr.style.position = "fixed";
	div_qr.style.width = dw+"px";
	div_qr.style.height = dh+"px";
	div_qr.style.left = dl+"px";
	div_qr.style.top = "100px";
	div.style.background = "#8B0000";
	// div.style.color = "white";
	div.style.zIndex  = 100000;
	div_qr.innerHTML = '<img src="visitcard/frame.png" style="width:100%;height:auto;"/>';
	
	
	div_qrx.style.position = "fixed";
	div_qrx.style.width = 40+"px";
	div_qrx.style.height = 40+"px";
	div_qrx.style.right = dl+"px";
	div_qrx.style.top = "100px";
	div_qrx.innerHTML = '<img src="Windows_Close_Program_22531.png" style="width:40px ;height:auto;"/>';
	div_qrx.onclick = function(){
		div_qr.remove();
		div_qrx.remove();
	};
	menuf(div_menu_x); 
	
}  


window.onscroll =divNewsscrollf;
// window.onscroll = function () {
   // console.log(document.documentElement.scrollTop || document.body.scrollTop);
 // };
window.onload=function(){
	div_loader.style.display="none";
}
</script>
  


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry"></script>
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


<?php //get machines json
	
	// require_once('connect.php');
	$stmt = $db -> prepare("select * from  `tabMak` where virtual=1");
	$stmt -> execute( );
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//problema com acentos eg santar??m
	$results = mb_convert_encoding($results, "UTF-8", "auto");
	// foreach(mb_list_encodings() as $chr){
        // $t= mb_convert_encoding($results, 'UTF-8', $chr);  
		// echo json_encode($t);
	// }
	$js = json_encode($results); 
	// echo json_last_error_msg();
	// print_r($results);
	echo '<script>var tab_mak='.$js.';</script>'; 
?>

<script> 
var tab_mak_sorted=[];
function get_mak(lat,longi){
	var loc1 = new google.maps.LatLng(lat,longi);
	// var loc1 = new google.maps.LatLng(39.331058,-8.9361147);
	console.log(lat,longi);
	console.log(tab_mak.length);
	for (var i = 0; i < tab_mak.length; i++){
		var loc2 = new google.maps.LatLng(parseFloat(tab_mak[i].lat),parseFloat(tab_mak[i].longi));
		tab_mak[i].dist=loc2.distanceFrom(loc1)/1000;
		// tab_mak[i].dist=google.maps.geometry.spherical.computeDistanceBetween (loc1, loc2)/1000;
		// console.log(tab_mak[i]);
	}
	var b = Object.keys(tab_mak);
	b.sort(function(x,y){return tab_mak[x].dist-tab_mak[y].dist});
	// console.log(b);	
	for (var i = 0; i < tab_mak.length; i++){
		tab_mak_sorted[i]=tab_mak[ b[i] ];
	}
	console.log(tab_mak_sorted);
	
	for (var i = 0; i < tab_mak.length; i++){
		var iDiv = document.createElement('div');
		var tms=tab_mak_sorted[i];
		iDiv.id = 'div_mak_'+i; 
		var km=tms.dist;
		var miles=km*0.621371192;
		if(km<10){
			km=Math.round(km* 10) / 10;
			miles=Math.round(miles* 10) / 10;
		}else{
			km=Math.round(km )  ;
			miles=Math.round(miles );
		}
		var fi="City: "+tms.city+" at "+km+"km / "+miles+"miles "+ (tms.url==null?"":("<a href='"+tms.url+"'><u>Map</u></a> ") );
		var url="https://www.google.com/maps/@"+(tms.lat)+","+(tms.longi)+",13z";
		fi+="<a target=???_blank??? href='"+url+"'><u>Map</u></a>";
		if(i==0)fi="<b>"+fi+"</b>";
		
		// https://www.google.com/maps/@39.5993519,-107.90978,10z
		
		iDiv.innerHTML=fi;
		div_maknear.appendChild(iDiv);
	}
	div_maknear.innerHTML+="<br>";
	
}
function soblabel(){
	// var textWrapper = document.querySelector('.ml2');
	var textWrapper = cong_ml2;
	var ht ='Congratulations'; 
	ht=ht.replace(/\S/g, "<span class='word'>$&</span>");
	textWrapper.innerHTML = "<span class='notranslate'>"+ht+"</span>";
	textWrapper.style.opacity=1;
	if(1)
	anime.timeline({loop: false})
	  .add({
		targets: '.ml2 .word',
		scale: [5,1],
		opacity: [0,1],
		translateZ: 0,
		easing: "easeInSine",
		duration: 450,
		delay: (el, i) => 70*i
	  }).add({
		targets: '.ml2',
		opacity: 0,
		duration: 5000,
		easing: "easeInSine",
		delay: 5000
	  });
	setTimeout(()=>{
	// textWrapper = document.querySelector('.ml2');
	textWrapper = cong_ml3;
	ht ='There will be a machine near you'; 
	ht=ht.replace(/\S/g, "<span class='word'>$&</span>");
	textWrapper.innerHTML = "<span class='notranslate'>"+ht+"</span>";
	textWrapper.style.opacity=1;
	textWrapper.style.opacity=1;
	if(1)
	anime.timeline({loop: false})
	  .add({
		targets: '.ml3 .word',
		scale: [5,1],
		opacity: [0,1],
		translateZ: 0,
		easing: "easeInSine",
		duration: 150,
		delay: (el, i) => 80*i
	  }).add({
		targets: '.ml3',
		opacity: 0,
		duration: 3500,
		easing: "easeInSine",
		delay: 3500
	  });
	},1800);
} 
</script>

<script> //geo

// geoFindMe1=function() {
function geoFindMe1() {
//acesso ?? localiza??ao em defini??oes 
// var geolocation = Components.classes["@mozilla.org/geolocation;1"]
                           // .getService(Components.interfaces.nsIDOMGeoGeolocation);
	 div_loader.style.display="block";
	 if (!navigator.geolocation){
	   // output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
	   get_mak(38.7302156,-9.2803685);
	   div_loader.style.display="none";
	   return;
	 }

	 function success(position) {
	   var latitude  = position.coords.latitude;
	   var longitude = position.coords.longitude;

	   // output.innerHTML = '<p>Latitude is ' + latitude + '?? <br>Longitude is ' + longitude + '??</p>';
		button_near.style.display="none";
		
		// setTimeout(	() =>{
			
			get_mak(latitude,longitude);
			// get_mak(38.677511,-75.335495);
			// get_mak(30.659218,-87.746067);
			span_maknear.style.display="block";
			div_loader.style.display="none";
			// soblabel();
		// },3500);
		// get_mak(38.7302156,-9.2803685);
	   // var img = new Image();
	   // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
	   // output.appendChild(img);
	 }

	 function error(err) {
		// button_near.style.display="none";
		console.warn('ERROR(' + err.code + '): ' + err.message);
		Swal.fire({title:"Please allow geolocation on your browser and try again ",icon:'none',  showConfirmButton: false}); 
		setTimeout(() =>{Swal.close();},2400);
		div_loader.style.display="none";
		// output.innerHTML ='ERROR(' + err.code + '): ' + err.message;
	   // output.innerHTML = "Unable to retrieve your location";
	   // get_mak(38.7302156,-9.2803685);
	 }

	 // output.innerHTML = "<p>Locating???</p>";

	 navigator.geolocation.getCurrentPosition(success, error);
} 
console.log(Intl.DateTimeFormat().resolvedOptions().timeZone);
 
 navigator.permissions.query({ name: 'geolocation' }).then((result) => {
 console.log("geo",result.state);
 if (result.state === 'granted') {
	geoFindMe1();
 }
});
</script>

<script>
	function div_langf(langbr ){
		div_loader.style.display="block";
		setCookie("lang",langbr,365 ); 
		location.reload();
	};
</script>


</body>

<script>
<?php
	$s=@$_GET["s"]; 
	if($s=="donate")echo 'window.onload=function(){div_don_fundsf(0); div_loader.style.display="none";}';

?>
// div_loader.style.display="none";
</script>


</html>