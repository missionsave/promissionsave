<?php  
	$location="../";
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
	require_once($location."connect.php");	
	require_once($location."token.php");	
	require_once($location."dict.php");	
	require_once($location."vendor/autoload.php");	
	require_once($location."google_login.php");	
	require_once($location."facebook_login.php");	
?>
<?php
	// echo $lat;
?>

<!DOCTYPE html>
<html  >
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="logo.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta charset="UTF-8">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://accounts.google.com/gsi/client"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
	var _location="<?php echo $location;?>";
	var _domain='https://'+window.location.hostname.split('.')[window.location.hostname.split('.').length-2]+'.'+window.location.hostname.split('.')[window.location.hostname.split('.').length-1];
	var id=<?php echo $id;?>;
	var name="<?php echo $name;?>";
	var tes=4;
	
</script>

 


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

#overlay {
	display: none;
    position: fixed; 
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: 0.8;
    filter: alpha(opacity=80);
    z-index:50;
}
</style>
<style>  /*buttonpaypal*/
	
.buttonpp { //background-image: linear-gradient(#A9A932, #E5D153, #E9CC0E);
 width: 170px; //change width of button here
  height: 32px;
 color: #2e3192;
 text-decoration: none;
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
<style>
.botoes_centrados{
	display: flex; justify-content: center;  margin: auto; margin-top:20px; left: 0; right: 0; max-width: 200px;
}
</style>
</head>

<body> 
<div id="overlay"></div>
<div id="divbody" style="max-width:1000px; position: absolute;    top:0;    bottom: 0;    left: 0;    right: 0;   margin: auto; overflow-x:hidden;" >

   
	 
	
	<div id="div_top" style="display:none; opacity:50%; max-width: 1000px;  position: fixed;  margin:   auto; left: 0; right: 0; top:0px; z-index:2;  width: 100%; height:50px; font-size: 10px; background-color:gray;   flex-direction: row;   flex-wrap: nowrap;   justify-content: space-between "> 
		<div id="bt_logout" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " onclick="bt_logoutf()">
			<img src="4115235-exit-logout-sign-out_114030.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>
		<div id="divhome" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " onclick="menuf(this)">
			<img src="1904661-building-dashboard-default-home-house-page-start_122511.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>
		<div id="divnear" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " onclick="menuf(0)">
			<img src="location_106422.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>		
		<div id="divchat_" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(this)">
			<img src="falar.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>	
		<div id="divdonate" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(1)">
			<img src="donate-48_44778.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>
		<div id="divperfil" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(2)">
			<img src="4213460-account-avatar-head-person-profile-user_115386.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>  
	</div>
	
	
<div id="div_entrada" style=" max-width: 1000px; position:absolute; top:52px; height:100%; ">
	Este é um site de encontros simples e verdadeiramente gratuito sem custos escondidos e só pessoas reais, que funciona como as pessoas perto do badoo.
	Funcionamos à boa fé das pessoas pelo que aceitamos doações de pessoas que ficam satisfeitas com o serviço, porque esta é uma ferramenta para ver um futuro com pessoas que não só estejam submissas à corrupção do dinheiro que manipula os serviços da internet.
	Simples como o badoo sem despesa e a simplicidade do mirc sem se perder os contatos.

	<a id="btn_login_facebook"   class="btn btn-primary botoes_centrados" href="<?php echo $site."?action=fblogin"; ?>" >Entrar com Facebook</a><div class="botoes_centrados" style="margin-top:0px; left: 0; right: 0; max-width: 250px;">Nunca publicamos em seu nome.</div>
	<a id="btn_login_google" class="btn btn-primary botoes_centrados" style="background-color: #8064A2 !important" href="<?php echo $client->createAuthUrl(); ?>" >Entrar com Google</a>

	<img style="border-radius: 50%;" src="<?php echo $just_domain;?>/pic/12.jpg">

</div>


<div id="div_body" style="display:none; max-width: 1000px; width:100%; position:absolute; top:52px; height:100%; flex-direction: row;  ">
	<div id="div_perfil" >
	div_perfil<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
	<img style="width:100px; height:100px; border-radius: 50%;" src="<?php echo $just_domain;?>/pic/12.jpg">
	</div>	
	<div id="div_donate">
	div_donate<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
	<img style="width:100px; height:100px; border-radius: 50%;" src="<?php echo $just_domain;?>/pic/13.jpg">
	</div>
	<div id="div_near">
	div_near<br>Sem namorado? Entre neste website totalmente gratuito sem custos escondidos, para encontrar um bom namorado.em namorado? Entre neste website totalmente gratuito sem custos escondidos, para encontrar um bom namorado.<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
	<img style="width:100px; height:100px; border-radius: 50%;" src="<?php echo $just_domain;?>/pic/13.jpg">
	</div>
</div>
</div>

</body>
 <?php //se logged
	if($email!="email") 
		echo '<script>
			document.getElementById("div_top").style.display="flex";
			document.getElementById("div_body").style.display="flex";
			document.getElementById("div_entrada").style.display="none";
			</script>';
 
?>
<script>
var divbody_width=document.getElementById("divbody").offsetWidth;
var div_slider=[document.getElementById("div_near"),document.getElementById("div_donate"),document.getElementById("div_perfil")];
for(var i=0;i<div_slider.length;i++){
	div_slider[i].style.position="absolute";
	div_slider[i].style.width="100%";
	div_slider[i].style.left=divbody_width*i + "px";
}
function menuf(idx){
	for(var i=0;i<div_slider.length;i++){ 
		div_slider[i].style.left=(i-idx)*divbody_width + "px";
		console.log(i,div_slider[i].style.left);
	}	
}
	
	// console.log(divbody_width);
	// div_slider[0].innerHTML ="ok";
	// div_slider[0].style.width=600 +"px";
	// div_slider[1].style.left=400 +"px";
</script>
<script>
function handleCredentialResponse(response){ 
	var credential=response["credential"]; 
	window.location='<?php echo $site; ?>/?credential='+credential;
}
function btentrar(){  
	// https://myaccount.google.com/u/2/permissions?continue=https%3A%2F%2Fmyaccount.google.com%2Fu%2F2%2Fsecurity
	google.accounts.id.initialize({
      client_id: '<?php echo $clientID; ?>',
      callback: handleCredentialResponse
    });
    google.accounts.id.prompt(); 
}
<?php if($email=="email") echo 'btentrar();' ?>
function bt_logoutf(){
	Swal.fire({
	title: 'Sair da App',
	text: "Tem a certeza que quer sair?",
	icon: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	cancelButtonText: 'Cancelar',
	confirmButtonText: 'Sair'
	}).then((result) => {
	if (result.isConfirmed) {
		document.cookie = "vivision=;";
		document.location="<?php echo $site; ?>";
	}
	});
}

</script>

<script> //geo
 
function geoFindMe() {
	navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
	if (PermissionStatus.state == 'granted') {
		//allowed
	} else if (PermissionStatus.state == 'prompt') {
		// prompt - not yet grated or denied
		document.getElementById('overlay').style.display="block";
		Swal.fire({position: 'top',showConfirmButton: false,text:'Este website precisa da sua localização para funcionar, faça permitir'});
	} else {
		document.getElementById('overlay').style.display="block";
		Swal.fire({position: 'top',showConfirmButton: false,text:'Este website precisa da sua localização para funcionar, faça permitir'});
	}
	});	
	if (!navigator.geolocation){
		document.getElementById('overlay').style.display="block";
		Swal.fire('Este website precisa da sua localização para funcionar');
		return;
	}
	function success(position) {
		Swal.close()
		document.getElementById('overlay').style.display="none";
		var latitude  = position.coords.latitude;
		var longitude = position.coords.longitude; 
		var xhttp = new XMLHttpRequest();
		// /*xhttp cópia para meeting.vivision.org de vivision.org*/
		xhttp.open("POST", "xhttp.php", true);
		var params = 'action=setlatlong&location='+_location+"&lat="+latitude+"&long="+longitude+"&id="+id;
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
		xhttp.onreadystatechange = function () {  
			console.log("resp1: ",xhttp.responseText);   
		}; 
		xhttp.send(params); 
	 };
	function error(err) {
		console.warn('ERROR(' + err.code + '): ' + err.message); 
		document.getElementById('overlay').style.display="block";
		Swal.fire({position: 'top',showConfirmButton: false,text:'Este website precisa da sua localização para funcionar, faça permitir'});
	};
	 navigator.geolocation.getCurrentPosition(success, error);
} 
<?php if($email!="email") echo 'geoFindMe();' ?>


 
</script>



<?php //get near contacts
	// $stmt = $db -> prepare("select id,lat,longi from tabUsers where lat BETWEEN ? AND ? and longi BETWEEN ? AND ? and gender like ?");
	// $stmt -> execute(array(38.5,40.5  ,  -10.12,-8.12 , 1 ));
	// $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// print_r($res);
	
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
		$res=json_decode($response,true);
		echo $res[0]["City"].$res[0]["Country"];
	}
}
// reverse_geo(39.4077,-9.12869);
	// exit;
	
?>




</html>