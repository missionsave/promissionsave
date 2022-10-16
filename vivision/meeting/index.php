<?php  
	/*xhttp.php cópia para meeting.vivision.org de vivision.org*/
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
<title>Meeting Vivision</title>

<link rel="manifest" href="manifest.webmanifest">

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
	var data="<?php echo $res[0]['datem'];?>";
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
<div id="divbody" style="max-width:1000px;  position: absolute;    top:0;    bottom: 0;    left: 0;    right: 0;   margin: auto; overflow:hidden;" >

   
	 
	
	<div id="div_top" style="display:none; opacity:50%; max-width: 1000px;  position: fixed;  margin:   auto; left: 0; right: 0; top:0px; z-index:2;  width: 100%; height:50px; font-size: 10px; background-color:gray;   flex-direction: row;   flex-wrap: nowrap;   justify-content: space-between "> 
		<div id="bt_logout" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " onclick="bt_logoutf()">
			<img src="4115235-exit-logout-sign-out_114030.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>		
		<div id="btnAdd" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " >
			<img src="install-software-download.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>
		<div id="divnear" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;  " onclick="menuf(0)">
			<img src="location_106422.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>		
		<div id="divpm" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(1)">
			<img src="falar.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>	
		<div id="divdonate" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(2)">
			<img src="donate-48_44778.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>
		<div id="divperfil" style="text-align: center; margin:auto;  box-sizing: border-box; cursor: pointer; border-radius: 4px;  max-width: 35px; max-height: 35px;     " onclick="menuf(3)">
			<img src="4213460-account-avatar-head-person-profile-user_115386.png" style="height: auto; width: auto; max-width: 35px; max-height: 35px;" ></img>
		</div>  
	</div>
	
	
<div id="div_entrada" style=" max-width: 800px; position:absolute; top:52px;    "> 
	Este é um site de encontros simples e verdadeiramente gratuito sem custos escondidos e só pessoas reais, que funciona como as pessoas perto do badoo.
	Funcionamos à boa fé das pessoas pelo que aceitamos doações de pessoas que ficam satisfeitas com o serviço, porque esta é uma ferramenta para ver um futuro com pessoas que não só estejam submissas à corrupção do dinheiro que manipula os serviços da internet.
	Simples como o badoo sem despesa e a simplicidade do mirc sem se perder os contatos.
	<br>
	<b>Anti perfis falsos</b>, como a listagem das pessoas é ordenada da mais perto à mais longe, 

	<a id="btn_login_facebook"   class="btn btn-primary botoes_centrados" href="<?php echo $site."?action=fblogin"; ?>" >Entrar com Facebook</a>
	<div class="botoes_centrados" style="margin-top:0px; left: 0; right: 0; max-width: 250px;">Nunca publicamos em seu nome.</div>
	<a id="btn_login_google" class="btn btn-primary botoes_centrados" style="background-color: #8064A2 !important" href="<?php echo $client->createAuthUrl(); ?>" >Entrar com Google</a>

	<img style="border-radius: 50%;" src="<?php echo $just_domain;?>/pic/12.jpg">
</div>


<div id="div_body" style="display:none; max-width: 1000px; width:100%; height:100%; position:absolute; top:52px;   flex-direction: row;  ">
	<div id="div_pm" >
	div_pm<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
	<img style="width:100px; height:100px; border-radius: 50%;" src="<?php echo $just_domain;?>/pic/12.jpg">
	</div>	
	<div id="div_perfil" > 
		<div id="perfil_1">
		<label class="botoes_centrados" style="text-align:left; justify-content:left; font-weight: normal;">És: </label>
		<div id="div_perfil_first" class="botoes_centrados" style="text-align:left; justify-content:left; margin-top:0px;">
			<input type="radio" id="gender" name="gender" value="1" checked onclick="gender_click(1)">
			<label for="gender" style="margin-right:20px;">Homem</label>
			<input type="radio" id="gender" name="gender" value="0" style="margin-left:5px; " onclick="gender_click(0)">
			<label for="gender">Mulher</label>
		</div>
		<label class="botoes_centrados" style="text-align:left; justify-content:left; font-weight: normal;">Procuras: </label> 
		<div class="botoes_centrados"  style="text-align:left; justify-content:left; margin-top:0px;">
			<input type="radio" id="gender_looking1" name="gender_looking" value="1" style="" >
			<label for="gender_looking"  style="margin-right:20px;">Homem</label>
			<input type="radio" id="gender_looking0" name="gender_looking" value="0" checked style="margin-left:5px;">
			<label for="gender_looking">Mulher</label>	
		</div>
		
		<label class="botoes_centrados" style="text-align:left; justify-content:left; font-weight: normal;">Data de nascimento: </label>
		<div class="botoes_centrados"  style="text-align:left; justify-content:left; margin-top:0px;">
		<select data-val="true" data-val-number="The field Day must be a number." data-val-required="The Day field is required." id="DateOfBirth_Day" name="DateOfBirth.Day" >
		<option value="">Dia</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
		<option value="25">25</option>
		<option value="26">26</option>
		<option value="27">27</option>
		<option value="28">28</option>
		<option value="29">29</option>
		<option value="30">30</option>
		<option value="31">31</option>
		</select>
		<select class="minimum18Years" data-val="true" data-val-number="The field Month must be a number." data-val-required="The Month field is required." id="DateOfBirth_Month" name="DateOfBirth.Month" style="margin-left:8px; width:110px;"><option value="">M&#234;s</option>
		<option value="1">Janeiro</option>
		<option value="2">Fevereiro</option>
		<option value="3">Mar&#231;o</option>
		<option value="4">Abril</option>
		<option value="5">Maio</option>
		<option value="6">Junho</option>
		<option value="7">Julho</option>
		<option value="8">Agosto</option>
		<option value="9">Setembro</option>
		<option value="10">Outubro</option>
		<option value="11">Novembro</option>
		<option value="12">Dezembro</option>
		</select>
		<select data-val="true" data-val-number="The field Year must be a number." data-val-required="The Year field is required." id="DateOfBirth_Year" name="DateOfBirth.Year" style="margin-left:8px; width:80px;"><option value="">Ano</option>
		<option value="2003">2003</option>
		<option value="2002">2002</option>
		<option value="2001">2001</option>
		<option value="2000">2000</option>
		<option value="1999">1999</option>
		<option value="1998">1998</option>
		<option value="1997">1997</option>
		<option value="1996">1996</option>
		<option value="1995">1995</option>
		<option value="1994">1994</option>
		<option value="1993">1993</option>
		<option value="1992">1992</option>
		<option value="1991">1991</option>
		<option value="1990">1990</option>
		<option value="1989">1989</option>
		<option value="1988">1988</option>
		<option value="1987">1987</option>
		<option value="1986">1986</option>
		<option value="1985">1985</option>
		<option value="1984">1984</option>
		<option value="1983">1983</option>
		<option value="1982">1982</option>
		<option value="1981">1981</option>
		<option value="1980">1980</option>
		<option value="1979">1979</option>
		<option value="1978">1978</option>
		<option value="1977">1977</option>
		<option value="1976">1976</option>
		<option value="1975">1975</option>
		<option value="1974">1974</option>
		<option value="1973">1973</option>
		<option value="1972">1972</option>
		<option value="1971">1971</option>
		<option value="1970">1970</option>
		<option value="1969">1969</option>
		<option value="1968">1968</option>
		<option value="1967">1967</option>
		<option value="1966">1966</option>
		<option value="1965">1965</option>
		<option value="1964">1964</option>
		<option value="1963">1963</option>
		<option value="1962">1962</option>
		<option value="1961">1961</option>
		<option value="1960">1960</option>
		<option value="1959">1959</option>
		<option value="1958">1958</option>
		<option value="1957">1957</option>
		<option value="1956">1956</option>
		<option value="1955">1955</option>
		<option value="1954">1954</option>
		<option value="1953">1953</option>
		<option value="1952">1952</option>
		<option value="1951">1951</option>
		<option value="1950">1950</option>
		<option value="1949">1949</option>
		<option value="1948">1948</option>
		<option value="1947">1947</option>
		<option value="1946">1946</option>
		<option value="1945">1945</option>
		<option value="1944">1944</option>
		<option value="1943">1943</option>
		<option value="1942">1942</option>
		<option value="1941">1941</option>
		<option value="1940">1940</option>
		<option value="1939">1939</option>
		<option value="1938">1938</option>
		<option value="1937">1937</option>
		<option value="1936">1936</option>
		<option value="1935">1935</option>
		<option value="1934">1934</option>
		<option value="1933">1933</option>
		<option value="1932">1932</option>
		<option value="1931">1931</option>
		<option value="1930">1930</option>
		<option value="1929">1929</option>
		<option value="1928">1928</option>
		<option value="1927">1927</option>
		<option value="1926">1926</option>
		<option value="1925">1925</option>
		<option value="1924">1924</option>
		<option value="1923">1923</option>
		<option value="1922">1922</option>
		</select>
		</div>
		<a id="btn_perfil_continuar"   class="btn btn-primary botoes_centrados" onclick="btn_perfil_continuarf()" >Continuar</a>
		</div>
	
		<div id="perfil_2" style="display:none;">
		
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Foto: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<form id="image_form" action="xhttp.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value=<?php echo $id; ?> />
			<input type="hidden" name="location" value=<?php echo $location; ?> />
			<input type="file" style="display:none;" name="image" id="image" accept="image/*" /> 
			<img id="imgsrc" src="<?php echo $just_domain.'/pic/'.$id.'.jpg?'.$res[0]['datem'];?>" style="width:80px; height:80px; border-radius: 50%;" onclick="document.getElementById('image').click();">
			</form>
			</div>
					
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Nome: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">			
			<input class="form-control" data-val="true" data-val-length="O nome deve ter no mínimo 3 e no máximo 50 caracteres." data-val-length-max="50" data-val-length-min="3"  id="nome" style="width:200px;" type="text"  />
			<span class="field-validation-valid" data-valmsg-for="Profession" data-valmsg-replace="true"></span>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Sobre ti: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<textarea id="aboutme" name="w3review" rows="4" cols="150" autofocus ></textarea>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Altura: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<input id="altura" type="Number" style="width:50px; text-align:right;" value="<?php echo $res[0]['altura']; ?>">cm
			</div>
 			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Aparência: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<select  " data-val="true" data-val-number="The field Month must be a number." data-val-required="The Month field is required." id="look"   style="margin-left:0px; width:110px;"><option value="0">Selecione</option>
			<option value="1">Magro</option>
			<option value="2">Normal</option>
			<option value="3">Uns quilos a mais</option> 
			</select>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Filhos: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<select data-val="true" data-val-required="O campo &#39;Filhos&#39; é necessário." id="children" name="Children" style="width:275px;">
			<option value="0">Selecione</option>
			<option value="1">N&#227;o tenho filhos</option> 
			<option value="2">Tenho filhos e n&#227;o vivem comigo</option> 
			<option value="3">Tenho filhos e vivem comigo</option>
			</select>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Educação: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<select data-val="true" data-val-required="O campo &#39;Habilitações&#39; é necessário." id="education" name="Education" style="width:200px;">
			<option value="0">Selecione</option>
			<option value="1">Ensino b&#225;sico</option> 
			<option value="2">Ensino secund&#225;rio</option>
			<option value="3">Ensino universit&#225;rio</option> 
			</select>
			</div>
						
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Profissão: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">			
			<input class="form-control" data-val="true" data-val-length="&#39;Profissão&#39; deve ter no mínimo 3 e no máximo 50 caracteres." data-val-length-max="50" data-val-length-min="3" data-val-required="O campo &#39;Profissão&#39; é necessário." id="profession" name="Profession" style="width:200px;" type="text" value="Desenhador" />
			<span class="field-validation-valid" data-valmsg-for="Profession" data-valmsg-replace="true"></span>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Bebidas alcoólicas: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<select data-val="true" data-val-required="O campo &#39;Bebidas alcoólicas&#39; é necessário." id="drink" name="AlcoholConsumption" style="width:230px;"><option value="0">Selecione</option>
			<option value="1">N&#227;o bebo bebidas alco&#243;licas</option>
			<option value="2">Bebo socialmente</option>
			<option value="3">Bebo com frequ&#234;ncia</option>
			</select>
			</div>
			
			<label class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; font-weight: normal;">Fumar: </label>
			<div class="botoes_centrados" style="max-width:350px; text-align:left; justify-content:left; margin-top:0px;">
			<select data-val="true" data-val-required="O campo &#39;Fumador&#39; é necessário." id="smoke" name="SmokingHabit" style="width:230px;">
			<option value="0">Selecione</option>
			<option value="1">N&#227;o fumo</option>
			<option value="2">Fumo mas estou a tentar deixar</option>
			<option value="3">Fumo &#224;s vezes</option>
			<option value="4">Fumo regularmente</option>
			</select>
			</div>
			
			<a id="btn_perfil_salvar"  class="btn btn-primary botoes_centrados" style="margin-bottom:50px;" onclick="btn_perfil_salvarf()" >Salvar alterações</a>
		</div>
	
	</div>	
	<div id="div_donate">
	div_donate<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
	<img style="width:100px; height:100px; border-radius: 50%;" src="<?php echo $just_domain;?>/pic/13.jpg">
	</div>
	<div id="div_near">
	div_near<br>Sem namorado? Entre neste website totalmente gratuito sem custos escondidos, para encontrar um bom namorado. Sem namorado? Entre neste website totalmente gratuito sem custos escondidos, para encontrar um bom namorado.<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>Teste<br>teste<br>
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
var divbody_height=document.getElementById("divbody").offsetHeight;
var div_slider=[document.getElementById("div_near"),document.getElementById("div_pm"),document.getElementById("div_donate"),document.getElementById("div_perfil")];
var div_slider_buttons=[document.getElementById("divnear"),document.getElementById("divpm"),document.getElementById("divdonate"),document.getElementById("divperfil")];
for(var i=0;i<div_slider.length;i++){
	div_slider[i].style.position="absolute";
	div_slider[i].style.width="100%";
	div_slider[i].style.height=divbody_height-50 +"px";
	div_slider[i].style.overflowY="auto";
	div_slider[i].style.left=divbody_width*i + "px";
}
div_entrada.style.height=divbody_height-50 +"px";
div_entrada.style.overflowY="auto";
var intervalmovdiv;
function timerSlide(left0){
	var divl0=parseInt(div_slider[0].style.left, 10);
	var dir=1; 
	if(divl0>=left0)dir=-1; 
	for(var i=0;i<div_slider.length;i++){ 
		if(i==0){
			var divl=parseInt(div_slider[0].style.left, 10);
			if(dir==1 && divl-left0>=0){clearInterval(intervalmovdiv);return;}
			if(dir==-1 && divl-left0<=0){clearInterval(intervalmovdiv);return;}
		}
		var divi=parseInt(div_slider[i].style.left, 10);
		div_slider[i].style.left=divi+(dir*40) + "px"; 
	}
}
function menuf(idx){
	var left0=(-idx)*divbody_width;
	intervalmovdiv = setInterval( function() { timerSlide(left0); }, 10 ); 
	for(var i=0;i<div_slider.length;i++)div_slider_buttons[i].style.backgroundColor="transparent";
	div_slider_buttons[idx].style.backgroundColor="pink";
} 
menuf(3);
<?php if($res[0]["gender"]!="")echo 'document.getElementById("perfil_1").style.display="none";	document.getElementById("perfil_2").style.display="block"; document.getElementById("aboutme").focus();	' ?>

document.getElementById('drink').value="<?php echo @$res[0]["drink"]==''?0:$res[0]["drink"]; ?>";
document.getElementById('smoke').value="<?php echo @$res[0]["smoke"]==''?0:$res[0]["smoke"]; ?>";
document.getElementById('children').value="<?php echo @$res[0]["children"]==''?0:$res[0]["children"]; ?>";
document.getElementById('look').value="<?php echo @$res[0]["look"]==''?0:$res[0]["look"]; ?>";
document.getElementById('education').value="<?php echo @$res[0]["education"]==''?0:$res[0]["education"]; ?>";
document.getElementById('aboutme').value='<?php echo @$res[0]["aboutme"]; ?>';
document.getElementById('nome').value='<?php echo @$res[0]["name"]; ?>';
document.getElementById('profession').value='<?php echo @$res[0]["profession"]; ?>';

function gender_click(val){
	if(val==0)document.getElementById("gender_looking1").checked=1;
	if(val==1)document.getElementById("gender_looking0").checked=1;
}

function btn_perfil_continuarf(){
	var gender=document.querySelector('input[name="gender"]:checked');
	var gender_looking=document.querySelector('input[name="gender_looking"]:checked');
	// Swal.fire(gender.value);
	var dateobd=document.getElementById("DateOfBirth_Day");
	var dateobm=document.getElementById("DateOfBirth_Month");
	var dateoby=document.getElementById("DateOfBirth_Year");
	if(dateobd.value=="" || dateobm.value=="" || dateoby.value==""){
		Swal.fire("Preencha a data de nascimento");
		return;
	}
	var xhttp = new XMLHttpRequest();
	// /*xhttp cópia para meeting.vivision.org de vivision.org*/
	xhttp.open("POST", "xhttp.php", true);
	var params = 'action=perfil_1_set&location='+_location+"&id="+id+"&gender="+gender.value+"&gender_looking="+gender_looking.value+"&birth="+dateoby.value+"-"+dateobm.value+"-"+dateobd.value;
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () {  
		console.log("perfil_1_set: ",xhttp.responseText); 
		document.getElementById("perfil_1").style.display="none";
		document.getElementById("perfil_2").style.display="block";
		document.getElementById("aboutme").focus();
		window.location='<?php echo $site; ?>';
	}; 
	xhttp.send(params);
}

function btn_perfil_salvarf(){
	var date = new Date(); 
	// date = new Date(date.getTime() + (date.getTimezoneOffset() * 60 * 1000));
	// var data=date.toISOString().slice(0,19);
	data=date.getUTCFullYear()+'-'+(date.getUTCMonth()+1)+'-'+date.getUTCDate()+' '+date.getUTCHours()+':'+date.getUTCMinutes()+':'+date.getUTCSeconds();
	// console.log(data);
	var xhttp = new XMLHttpRequest();
	// /*xhttp cópia para meeting.vivision.org de vivision.org*/
	xhttp.open("POST", "xhttp.php", true);
	var params = 'action=perfil_2_set&location='+_location+"&id="+id+"&data="+data+"&nome="+nome.value+"&aboutme="+aboutme.value+"&altura="+(altura.value==""?0:altura.value)+"&look="+look.value+"&drink="+drink.value+"&smoke="+smoke.value+"&children="+children.value+"&education="+education.value+"&profession="+profession.value;
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
	xhttp.onreadystatechange = function () {  
		console.log("perfil_2_set: ",xhttp.responseText);  
		Swal.fire({title:"Perfil salvo",icon:'success',  showConfirmButton: false}); 
		setTimeout(() =>{Swal.close();},1400);

	}; 
	xhttp.send(params);
}

document.getElementById('image').onchange = function() {
	var xhr = new XMLHttpRequest();
	xhr.open("POST", "xhttp.php"); 
	xhr.onload = function(event){ 
	console.log("image_set: ",xhr.responseText);	// alert("Success, server responded with: " + event.target.response); // raw response
		document.getElementById('imgsrc').src=_domain+'/pic/'+id+'.jpg?'+Math.random();
		
	}; 	// or onerror, onabort
	var formData = new FormData(document.getElementById("image_form")); 
	xhr.send(formData);
}
</script>
 <script>
 // https://developer.mozilla.org/en-US/docs/Web/API/Window/onbeforeinstallprompt
 // https://stackoverflow.com/questions/50762626/pwa-beforeinstallprompt-not-called
 // https://mdn.github.io/pwa-examples/a2hs/
 // https://www.simicart.com/blog/pwa-app-stores/
 var addBtn=document.getElementById("btnAdd");
 if ('serviceWorker' in navigator) {
  navigator.serviceWorker
    .register('/sw.js')
    .then(() => { console.log('Service Worker Registered'); });
}
let deferredPrompt;
 
//ve se está instalado
(async function () {
	const relatedApps = await navigator.getInstalledRelatedApps();
	// alert(relatedApps);
	// console.log(relatedApps);
	relatedApps.forEach((app) => {
		// alert(app.id,app.name);
		// console.log(app.id, app.platform, app.url);
		addBtn.style.display = 'none';
	});
})();
// if (window.matchMedia('(display-mode: standalone)').matches) {
	// addBtn.style.display = 'none';
// } 
var listener = function (event) {
  Swal.fire("De momento, para instalar tem que ser por via do chrome. Abra no chrome e tente novamente.");
};
addBtn.addEventListener('click', listener,false);

window.addEventListener('beforeinstallprompt', (e) => {
	console.log("before");
  addBtn.removeEventListener('click', listener,false);
  // Prevent Chrome 67 and earlier from automatically showing the prompt
  e.preventDefault();
  // Stash the event so it can be triggered later.
  deferredPrompt = e;
  // Update UI to notify the user they can add to home screen
  addBtn.style.display = 'block';

  addBtn.addEventListener('click', () => {
    // hide our user interface that shows our A2HS button
    addBtn.style.display = 'none';
    // Show the prompt
    deferredPrompt.prompt();
    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the A2HS prompt');
      } else {
        console.log('User dismissed the A2HS prompt');
      }
      deferredPrompt = null;
    });
  });
});

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