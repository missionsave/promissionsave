<?php //links usefull
// https://oklahoma.gov/okdhs/services/snap.html
?>
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
<div id="divbody" style="  max-width:690px; position:absolute; top:50px; bottom:0; left: 0; right: 0; margin: auto;">
<div style="text-align:right;"><?php echo  "Last Modified: ".date ("F d Y", filemtime("index.php")); ?></div>
<div id="a4" style="  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); max-width:690px;  top:0; bottom:0; left: 0; right: 0; margin: auto; margin-top:-40px;">
<div id="content" style="  max-width:640px; top:0; bottom:0; left: 0; right: 0; margin: auto;">

 
 
<?php  
$your_text_variable=file_get_contents ($f."WFP.html");
//hack doc
$your_text_variable=str_replace('Vivision.org','<span class="notranslate"> Vivision.org </span>',$your_text_variable);
$your_text_variable=str_replace('Vivision ','<span class="notranslate">Vivision </span>',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image3.png"',' float:left;"><img alt="" src="'.$f.'images/image3.png"',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image2.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="'.$f.'images/image2.png" style="width: 100% !important; height: auto !important; ',$your_text_variable);
$your_text_variable=str_replace('"><img alt="" src="images/image1.png" style="',' width: 100% !important; height: auto !important;"><img alt="" src="'.$f.'images/image1.png" style="width: 100% !important; height: auto !important; ',$your_text_variable);
$html = $your_text_variable;
$dom = new DomDocument();
$dom->loadHTML($html);
$elements = $dom->getElementsByTagName('style');
for ($i = $elements->length; --$i >= 0;) {
	$css = $dom->saveHTML($elements->item($i)); // so ve 1 style, facil corrigir
    $elements->item($i)->parentNode->removeChild($elements->item($i)); 
}
$html= $dom->saveHTML();
// print_r(get_included_files());
if(!in_array("/home/vol11_7/epizy.com/epiz_29317381/htdocs/vendor/autoload.php", get_included_files()))require_once("../vendor/autoload.php");
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
$cssToInlineStyles = new CssToInlineStyles(); 
$your_text_variable = $cssToInlineStyles->convert($html,$css);
echo $your_text_variable."<br>";  
?>



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

 