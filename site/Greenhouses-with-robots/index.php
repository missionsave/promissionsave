<?php //links usefull
// https://oklahoma.gov/okdhs/services/snap.html
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="../logo.png"> 
<title>Promition</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
h3{font-size:17px; font-weight: bold;}
</style>
<div id="divbody" style="  max-width:690px; position:absolute; top:50px; bottom:0; left: 0; right: 0; margin: auto;">
<div id="a4" style="  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); max-width:690px;  top:0; bottom:0; left: 0; right: 0; margin: auto;">
<div id="content" style="  max-width:640px; top:0; bottom:0; left: 0; right: 0; margin: auto;">


<div style="text-align:right;"><?php echo  "Last Modified: ".date ("F d Y", filemtime("index.php")); ?></div>

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
require_once("../vendor/autoload.php");
require_once("../parser.php"); 
}





echo parsegooglehttp("https://docs.google.com/document/d/e/2PACX-1vQNDDOzKkrczul9TXoSsXxzW25DJmW2PomzSwh8zJtLwcUuLfKKYSa7JMAA0Sjzs5bqatjAOBhrOtxg/pub",array(
'"><img alt="" src="images/image1.png"' => ' float:left;"><img alt="" src="images/image1.png"', 
),"",1);





?>
</div>



<!-- <a href="https://www.vivision.org/wfp/" style="text-align:center;">Further reading, why don't you read our open site with WFP</a> -->
Further reading, click <a href="https://www.promition.org" style="text-align:center;">root</a>

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

