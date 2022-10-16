<?php //links usefull
// https://oklahoma.gov/okdhs/services/snap.html
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="../logo.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Vivision Bill Gates realtime</title>
<style>
h3{font-size:17px; font-weight: bold;}
</style>
<div style="max-width:1000px; position:absolute; top:0; bottom:0; left: 0; right: 0; margin: auto;">

<div style="text-align:right;"><?php echo  date ("F d Y", filemtime("index.php")); ?></div>

<a href="https://www.vivision.org/wfp/">Vivision WFP contact</a>
 
<?php 
$your_text_variable=file_get_contents ("https://docs.google.com/document/d/e/2PACX-1vTkmYV9_fzkrsc0HC6weXbwKsnHGIAHOmlXPPzSyPjvxSFcHJXfKeDJE_BDY09SN-fYVvi8-iBxqf9P/pub",$your_text_variable);
$your_text_variable=str_replace('<div id="publish-banner">','<div id="publish-banner" style="display:none;!important">',$your_text_variable);
echo $your_text_variable;
// readfile("https://docs.google.com/document/d/e/2PACX-1vTkmYV9_fzkrsc0HC6weXbwKsnHGIAHOmlXPPzSyPjvxSFcHJXfKeDJE_BDY09SN-fYVvi8-iBxqf9P/pub");
// readfile("index.html");
?>

</div>
<script>
function popup(){
	if(screen.width>500)return;
	var win = window.open("robot.html", "Title", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=200,top="+(screen.height-400)+",left="+(screen.width-840)); 
}
</script>
</html>