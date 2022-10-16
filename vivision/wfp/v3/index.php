<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="../logo.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Vivision WFP</title>
<style>
h3{font-size:17px; font-weight: bold;}
</style>
<div id="divbody" style="  max-width:690px; position:absolute; top:0; bottom:0; left: 0; right: 0; margin: auto;">
<div id="a4" style="  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); max-width:690px;  top:0; bottom:0; left: 0; right: 0; margin: auto;">
<div id="content" style="  max-width:640px; top:0; bottom:0; left: 0; right: 0; margin: auto;">


<?php 
$your_text_variable=file_get_contents ("WFP.html");
//hack doc
$your_text_variable=str_replace('Vivision.org','<span class="notranslate"> Vivision.org </span>',$your_text_variable);
$your_text_variable=str_replace('Vivision ','<span class="notranslate">Vivision </span>',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image3.png"',' float:left;"><img alt="" src="images/image3.png"',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image2.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="images/image2.png" style="width: 100% !important; height: auto !important; ',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image1.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="images/image1.png" style="width: 100% !important; height: auto !important; ',$your_text_variable);

echo $your_text_variable;
?>



<div style="text-align:right;"><?php echo  date ("F d Y", filemtime("index.php")); ?></div>


 

</div>
</div>
</div>
<script>
window.onload = function(e){ 
// content.style.height=content.offsetHeight-0 +"px";
// a4.style.height=content.offsetHeight-0 +"px";
}
function popup(){
	if(screen.width>500)return;
	var win = window.open("robot.html", "Title", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=200,top="+(screen.height-400)+",left="+(screen.width-840)); 
}
</script>
</html>