<!DOCTYPE html>

<?php $indexp="index1.php"; $indexp=""; ?>
<html>

<head>
<meta http-equiv="cache-control" content="no-cache, must-revalidate, post-check=0, pre-check=0" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<link rel="shortcut icon" href="icon.ico?a">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta charset="UTF-8">




<?php //This will remove the annoying confirm submission on refresh
//setcookie("bpm", "cookie_value", time() + (86400 * 30), "/");
//so a ponto e mais nenhuma muito menos a jobs, pporcausa do fileupload, o $_FILES desaparece
if(@$_GET['pg']=='ponto' || @$_GET['pg']=='fund'){ //

	 if (!isset($_SESSION)) {
		session_set_cookie_params(3600000,"/");
		session_start();
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['postdata'] = $_POST;
		unset($_POST);
		header("Location: ".$_SERVER[REQUEST_URI]);
		exit;
	}

	if (@$_SESSION['postdata']){
		$_POST=$_SESSION['postdata'];
		unset($_SESSION['postdata']);
		//print_r($_POST);
	}
}
// 
// session_start(); 
header("Cache-Control: no-cache");
?>


<?php 
$lg=0;
if(@$_GET["l"] ==""){
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	 // echo $lang.$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	if($lang=="pt"){
		$_GET["l"]=0; 	
	}else{		
		$_GET["l"]=1;	
	}
}
$lg=$_GET["l"];
 


if(@$_GET["pg"]=="") {
	$_GET["pg"]="home"; 	
}
if(@$_GET["pg"]=="home" && $lg==1){
	echo '<meta property="og:description" content="This project consists of building a machine that has the function of making 50 doses of good soup a day, 350 a week.">';
}
if(@$_GET["pg"]=="home" && $lg==0){
	echo '<meta property="og:description" content="Este projeto consiste em construir máquina que tem a função de fazer:
50 doses de boa sopa por dia, 350 por semana.
Ramo da indústria alimentar, agricultura e confeção de boa sopa.
Este projeto começa pela criação de uma máquina-estufa que produz sopa de batata doce e soja com máquinas de produção alimentar. O cultivo de batata doce e soja é feito dentro da máquina, que funciona como estufa.">';
}
?>

<?php //dict



$dlg = array("pt", "en");

$dini = array("Inicio", "Home");
$descritiva = array("Memoria Descritiva", "Descriptive Memory");
$ufp = array("Unidade de produção alimentar", "Unit of food production");
$orc = array("Orçamento do Protótipo", "Prototype Budget");
$nutri = array("Factos Nutricionais", "Nutrition Facts");
$jobs = array("Trabalho", "Jobs");
$hiring = array("Contratação", "Hiring");
$schedule = array("Ponto", "Schedule");
$strat = array("Estratégia", "Strategy");
$contact = array("Contacto", "Contact");
$doar = array("Doar", "Donate");
$dev = array("Desenvolvimento", "Development");
$plan = array("Plano de negócio", "Business plan");
$fund = array("Fundo de investimento", "Investment fund");
$ling = array("Idioma", "Language");
$idiom = array("English", "Português");
$mission= array("Missão", "Mission");
$fab= array("Fábrica", "Factory");

$pol= array("Este site usa cookies para garantir que você obtenha a melhor experiência conosco", "This website uses cookies to ensure you get the best experience with us.")[$lg];
$polgo= array("Saber mais", "Learn more")[$lg];
$polok= array("Entendi, não voltar a mostrar", "Got it, don't show it again")[$lg];


?>





<script>
//Não sei pk meti isto aki
// var sse = new EventSource("index.php");
// sse.onmessage = function(event) {
// document.write(event.data);
// }
function resizeIframe(obj) {
    //obj.style.height = obj.contentWindow.document.body.scrollHeight+40 + 'px';
  var x= document.getElementById("movief").offsetWidth;
	//alert(x);
    document.getElementById("movief").style.height = x*(9.0/16.0) + 'px';
  }
  
window.addEventListener("resize", resizemovie);
function resizemovie() {
	var x= document.getElementById("movief").offsetWidth;
	//alert(x);
    document.getElementById("movief").style.height = x*(9.0/16.0) + 'px';
  }
</script>

<?php 	
	if( $_GET["pg"]=="fund")$stitle=$fund[$lg]; 
	if( $_GET["pg"]=="plan")$stitle=$plan[$lg]; 
	if( $_GET["pg"]=="donate")$stitle=$doar[$lg];
	if( $_GET["pg"]=="estrategia")$stitle=$strat[$lg];
	if( $_GET["pg"]=="jobs")$stitle=$jobs[$lg];
	if( $_GET["pg"]=="descritiva")$stitle=$ufp[$lg]; 
	if( $_GET["pg"]=="develop")$stitle=$dev[$lg];  
	if( $_GET["pg"]=="budget")$stitle=$orc[$lg];       
?>

<title>Better Planet Mission <?php echo @$stitle; ?></title>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<style>
p  { text-align: justify;}

.topnav {  

  overflow: hidden;
  background-color: #333; 
  //background-image: linear-gradient(gray, #333);
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
	
	align:right;
  display: none;
}

.dropdown1 {
	
  float: left; 
  overflow: auto;
}

.dropdown1 .dropbtn {

  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
	background-color: #333; 
	//background-image: linear-gradient(gray, #333);
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
		
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
 
}

.topnav a:hover, .dropdown1:hover .dropbtn {
  background-color: #555;
  color: white;  
}
.topnav a:not(.icon):hover { text-decoration: underline; }
	

.dropdown-content a:hover {
  text-decoration: underline;
  background-color: #ddd;
  color: black;
}






@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown1 .dropbtn {
    display: none;
  }
  .topnav a.icon {
	 
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
	
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left; z-index: 2000;
  }
  .topnav.responsive .dropdown1 {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown1 .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
  
  
.show {display:block;}
}

 
html {  
    margin: auto;
	text-align: justify;
}
 
body {
	
	margin:0px;
	font-family: Arial, Helvetica, sans-serif;
    display: inline;

}
 
.htr {    
    max-width: 21cm;
	margin:10px auto;
	font-family: Arial, Helvetica, sans-serif; 
    color:black;
    text-align:left;
	padding-left:10px;
	padding-right:10px;
	    
	
}

.topheader {
	z-index:1;
  position:fixed;
  width: 100%;  
}
@media screen and (min-width: 600px) {
	.dropdown1:hover .dropdown-content {
	  display: block; 
	}
}

 	
</style>
 
 
</head>
<body  onresize="onresizeFunction()">	
	
<div class="topheader" id="topheaderid">
<div class="topnav" id="myTopnav">
	<a href="	<?php echo  $indexp.'?pg=home'.'&l='.$lg;	?>" class="active">Better Planet Mission</a>
  
    <div class="dropdown1">
    <button onclick="dropdownFunction('myDropdown1')" class="dropbtn"><?php echo $ufp[$lg];?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div  id="myDropdown1" class="dropdown-content">
	<a href="	<?php echo  $indexp.'?pg=descritiva'.'&l='.$lg;	?>  "><?php echo $descritiva[$lg];?></a>
	<a href="	<?php echo  $indexp.'?pg=budget'.'&l='.$lg;	?>  "><?php echo $orc[$lg];?></a>
	<a href="	<?php echo  $indexp.'?pg=nutri'.'&l='.$lg;	?>  "><?php echo $nutri[$lg];?></a>
    </div>
	</div>
  
  
	<a href="	<?php echo  $indexp.'?pg=mission'.'&l='.$lg;	?>  "><?php echo $mission[$lg];?></a>
   
	
	
	<!-- <a href="	<?php echo  $indexp.'?pg=jobs'.'&l='.$lg;	?>  "><?php echo $jobs[$lg];?></a> -->
    
    <div class="dropdown1">
    <button onclick="dropdownFunction('myDropdown3')" class="dropbtn"><?php echo $jobs[$lg];?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div  id="myDropdown3" class="dropdown-content">
	<a href="	<?php echo  $indexp.'?pg=jobs'.'&l='.$lg;	?>  "><?php echo $hiring[$lg];?></a> 
	<a href="	<?php echo  $indexp.'?pg=ponto'.'&l='.$lg;	?>  "><?php echo $schedule[$lg];?></a> 
    </div>
	</div>	
	
	
	
	
	
	<a href="	<?php echo  $indexp.'?pg=donate'.'&l='.$lg;	?>  "><?php echo $doar[$lg];?></a>
	<a href="	<?php echo  $indexp.'?pg=develop'.'&l='.$lg;	?>  "><?php echo $dev[$lg];?></a> 
  
    
    <div class="dropdown1">
    <button onclick="dropdownFunction('myDropdown2')" class="dropbtn"><?php echo $fab[$lg];?>
      <i class="fa fa-caret-down"></i>
    </button>
    <div  id="myDropdown2" class="dropdown-content">
	<a href="	<?php echo  $indexp.'?pg=plan'.'&l='.$lg;	?>  "><?php echo $plan[$lg];?></a> 
    </div>
	</div>
	
 
		<a href="	<?php echo  $indexp.'?pg=fund'.'&l='.$lg;	?>  "><?php echo $fund[$lg];?></a> 
	
	<a href="	<?php echo  $indexp.'?pg=faq'.'&l='.$lg;	?>  "><?php echo 'FAQ';?></a> 
	
<!--	<a href="	<?php echo  $indexp.'?pg=nutri'.'&l='.$lg;	?>  "><?php echo 'Sobre';?></a> -->
 
	
	<a href="	<?php echo  $indexp.'?pg='.$_GET['pg'].'&l='.($lg==1?'0':'1') ;	?>  "><?php echo $idiom[$lg];?></a> 



<!--  
  <div class="dropdown1">
    <button onclick="dropdownFunction('myDropdown1')" class="dropbtn">tester
      <i class="fa fa-caret-down"></i>
    </button>
    <div  id="myDropdown1" class="dropdown-content">
      <a href="	<?php echo  $indexp.'?pg='.$_GET['pg'].'&l=0';	?>  ">l1</a>
      <a href="	<?php echo  $indexp.'?pg='.$_GET['pg'].'&l=1';	?>  ">l2</a> 
    </div>
  </div> 
--> 
 
 
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()"><b>&#9776;</b></a>
</div>
</div>

<div id="nexttotop"  align="center"  style="padding-left:10px; padding-right:10px;">

<script type="text/javascript">
function onresizeFunction(){ 
   	var clientHeight = document.getElementById("topheaderid").clientHeight; 
	document.getElementById('nexttotop').style.paddingTop = clientHeight+'px' ;
}
   	onresizeFunction(); 
</script>




<?php echo '<h2>'.@$stitle.'</h2>';  ?>
 </div>
 
 

 
 
<div    class="htr" <?php 	if( $_GET["pg"]=="plan") echo 'style="min-width:500px"'; ?> >

 




<?php //filter htmltext
function filterHtmlShow($file){
	$filestr = file_get_contents($file, true);

	$filestr = str_replace('<?xml version="1.0" encoding="UTF-8"?>','',$filestr);
	
	//home page center image
	$filestr = str_replace('height:6.666cm;width:8.888cm; padding:0;  float:left;','',$filestr);
	
	$filestr = str_replace('margin-left:2cm; margin-right:2cm;','',$filestr);
	
	//$filestr = str_replace('<html>','',$filestr);
	//$filestr = str_replace('</html>','',$filestr);
	
	//$filestr = str_replace('<body>','',$filestr);
	//$filestr = str_replace('</body>','',$filestr);
	
	$filestr = str_replace('<t video1>','<video controls width="100%"  muted>  <source src="movie.mp4?b" type="video/mp4"></video>',$filestr);
		
	$filestr = str_replace('<t video1="">','<video controls width="100%"  muted>  <source src="movie.mp4?b" type="video/mp4"></video>',$filestr);
	
	
	$filestr = str_replace('<t imgdonate>','<img style="float:left; position:relative; height:8.16cm;width:8.724cm; margin:10px;" alt="" src="fometec.jpg"/>',$filestr);
	
	
	$filestr = str_replace('http://localhost/proj/fund_pt.html','',$filestr);
	if(@$_GET['l']==1) $filestr = str_replace('l=0','l=1',$filestr);
	
	
	//corrige o google tradutor 
	$filestr = str_replace('7th','7',$filestr);
	$filestr = str_replace('>€ ','>€',$filestr);
	$filestr = str_replace('Electrical engineer','Electrical Engineer',$filestr);
	
	//tira o logo translate 
	$filestr = str_replace('<div class="logo"><img src="./','<div class="logo"><img t="./',$filestr);
	
	//Calc alinha ao centro
	$filestr = str_replace('font-size:x-small',' margin-left: auto; margin-right: auto;',$filestr);
	
	$filestr = str_replace('* { margin:0;}','',$filestr);

	$filestr = str_replace('<a href="http://www.youtube.com/embed/QZ-5ADFl6WQ" class="Internet_20_link">http://www.youtube.com/embed/QZ-5ADFl6WQ</a>','<iframe title="YouTube video player" class="youtube-player" type="text/html" width="100%" height="390" src="http://www.youtube.com/embed/QZ-5ADFl6WQ" frameborder="0" allowFullScreen></iframe>',$filestr);

	$filestr = str_replace('position:relative;','',$filestr);
	$filestr = str_replace('<t buttondoar>','<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_donations"><input type="hidden" name="business" value="danielchanfana@gmail.com"><input type="hidden" name="lc" value="PT"><input type="hidden" name="item_name" value="Mission Save"><input type="hidden" name="no_note" value="0"><input type="hidden" name="currency_code" value="EUR"><input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest"><input type="image" src="https://www.paypalobjects.com/pt_PT/PT/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - A forma mais fácil e segura de efetuar pagamentos online!"><img alt="" border="0" src="https://www.paypalobjects.com/pt_PT/i/scr/pixel.gif" width="1" height="1"></form>',$filestr);
	$filestr = str_replace('<t buttondoar="">','<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top"><input type="hidden" name="cmd" value="_donations"><input type="hidden" name="business" value="danielchanfana@gmail.com"><input type="hidden" name="lc" value="US"><input type="hidden" name="item_name" value="Mission Save"><input type="hidden" name="no_note" value="0"><input type="hidden" name="currency_code" value="EUR"><input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>',$filestr);
	echo $filestr; 
	
}
?>
 <?php 
 // function translate($q, $sl, $tl){
	// $var="https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q); //$var1= $_SERVER['DOCUMENT_ROOT']."/transes.html"; nao percebo pk isto
    // $res= file_get_contents($var);
    // $res=json_decode($res);
	// // echo $var; 
    // return $res[0][0][0];
// }



 
 
$file= $_GET["pg"]."_".$dlg[$lg].".html";
if(!file_exists($file))$file= "home_".$dlg[$lg].".html";

if( $_GET["pg"]=="fund"){
	filterHtmlShow("fund_".$dlg[$lg].".html");
	require	"fund.php";
	$file="";
}
if( $_GET["pg"]=="ponto"){
	require	"ponto.php";
	$file="";
}
if($file!=""){
	filterHtmlShow($file);
}

if( $_GET["pg"]=="jobs"){
	require "jobs.php";
	filterHtmlShow("jobsfoot_".$dlg[$lg].".html");
}
// if( $_GET["pg"]=="home"){ 
	// echo '<br><br>';
	// filterHtmlShow("nutri_".$dlg[$lg].".html");
// }

//https://developers.facebook.com/tools/debug/sharing/?q=http%3A%2F%2Fwww.betterplanetmission.com%2F%3Fl%3D0
//<meta property="og:description" content=" ">
?>

</div>


</body>
<script>


function dropdownFunction() { 
  document.getElementById(arguments[0]).classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it, nao funciona n sei porque
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) { 
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) { 
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function myFunction() { 
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

</script>

<!-- https://www.websitepolicies.com/create/cookie-consent-banner -->
<link rel="stylesheet" type="text/css" href="//wpcc.io/lib/1.0.2/cookieconsent.min.css"/><script src="//wpcc.io/lib/1.0.2/cookieconsent.min.js"></script><script>window.addEventListener("load", function(){window.wpcc.init({"colors":{"popup":{"background":"#2a5b12","text":"#ffffff","border":"#b5e1a0"},"button":{"background":"#b5e1a0","text":"#000000"}},"content":{"href":"?pg=policycook","target":"_self","button":"<?php echo $polok; ?>","link":"<?php echo $polgo; ?>","message":"<?php echo $pol; ?>"},"margin":"none","transparency":"25","fontsize":"tiny","padding":"none"})});</script>

<?php //Visitas
	require('connect.php');
	$pag=$_GET["pg"].'_'.$dlg[$lg];
	$stmt = $db -> prepare("SELECT id FROM `tabVisits` WHERE day=CURRENT_DATE and pag=?");
	$stmt -> execute( array( $pag  ));
	if($stmt->rowCount()==0){
		$stmt = $db -> prepare("insert into `tabVisits` (day,pag) values (CURRENT_DATE, ? ) ");
		$stmt -> execute( array( $pag  ));
	}else{
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = $db -> prepare("update `tabVisits` set pag=?, amount=amount+1 where id=? ");
		$stmt -> execute( array( $pag , $res[0]['id'] ));		
	}
?>
</html>


