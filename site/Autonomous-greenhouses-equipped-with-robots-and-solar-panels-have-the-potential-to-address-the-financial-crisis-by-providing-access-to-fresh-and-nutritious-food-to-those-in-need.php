<?php  
	/*xhttp.php cópia para meeting.promition.org de promition.org*/
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
	$coin="USD";
	if(@$_SERVER['HTTP_ACCEPT_LANGUAGE'])$langbr = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if( @$_COOKIE['lang'] )$langbr=$_COOKIE['lang'];
	// $langbr="ar";
	// $langbr="en";
	if($langbr!="en")$coin="EUR";
	$balance=0;
	require_once("connect.php");	
	require_once( "token.php");	
	require_once( "dict.php");	
	require_once($location."vendor/autoload.php");	
	require_once($location."google_login.php");	
	require_once($location."facebook_login.php");
	require_once("parser.php");
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
<meta property="og:title"              content="Promition" />
<meta property="og:description"        content="By buying strawberries and roasted sweet potatoes here, you are saving people from hunger." />
<meta property="og:image"              content="https://promition.org/images/plantel-de-fresones-albion-520x520.jpeg" />


<title class='notranslate'>Promition Autonomous greenhouses equipped with robots and solar panels have the potential to address the financial crisis</title>

<script>
    function gtElInit() {
        var lib = new google.translate.TranslateService();
        lib.translatePage('en', '<?php echo $langbr;?>', function () {
        // div_loader.style.display="none"; div_all.style.display="block"; 
    });}
</script>
<?php if($langbr!="en") 
     echo '<script src="https://translate.google.com/translate_a/element.js?cb=gtElInit&amp;hl=pt-PT&amp;client=wt" type="text/javascript"></script>'; 
?>
<?php 


echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vQNDDOzKkrczul9TXoSsXxzW25DJmW2PomzSwh8zJtLwcUuLfKKYSa7JMAA0Sjzs5bqatjAOBhrOtxg/pub",array(
'"><img alt="" src="images/image1.png"' => ' float:left;"><img alt="" src="images/image1.png"', 
),"",1);
?>