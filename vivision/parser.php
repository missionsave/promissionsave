<?php
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

function inlineinternalcss($html){
	$dom = new DomDocument();
	$dom->loadHTML($html);
	$elements = $dom->getElementsByTagName('style');
	for ($i = $elements->length; --$i >= 0;) {
		$css = $dom->saveHTML($elements->item($i)); // so ve 1 style, facil corrigir
		$elements->item($i)->parentNode->removeChild($elements->item($i)); 
	}
	$html= $dom->saveHTML();
	$cssToInlineStyles = new CssToInlineStyles(); 
	return $cssToInlineStyles->convert($html,$css);
}

function compilefilehtmlcssinline($file){
	$a=inlineinternalcss(file_get_contents ($file));
	file_put_contents('cis_'.$file, $a);
}
	


// echo parcegoogledoc("Vivisionhome.html",{["0","1"]});
function parcegoogledoc($filename,$jsonreplace="",$addpath=""){
$your_text_variable=file_get_contents ($filename);
//hack doc
$your_text_variable=str_replace('Vivision.org','<span class="notranslate"> Vivision.org </span>',$your_text_variable);
$your_text_variable=str_replace('Vivision ','<span class="notranslate">Vivision </span>',$your_text_variable);

foreach($jsonreplace as $key => $value){
$your_text_variable=str_replace($key,$value,$your_text_variable);
}

if($addpath!="")
	$your_text_variable=str_replace("\$addpath",$addpath,$your_text_variable);

//remove footnotes
$your_text_variable=explode("footnotes:",$your_text_variable)[0];
$your_text_variable=explode("<p",$your_text_variable);
array_pop($your_text_variable); 
$your_text_variable=implode("<p",$your_text_variable);

$your_text_variable=inlineinternalcss($your_text_variable);

$your_text_variable=str_replace("list-style-type: none;","",$your_text_variable); //fix bullets
$your_text_variable=str_replace("https://www.google.com/url?q=","",$your_text_variable); //fix links
$your_text_variable=str_replace("&amp;sa=D","?",$your_text_variable); //fix links
$your_text_variable=str_replace("%23","\#",$your_text_variable); //fix links
$your_text_variable=str_replace("%3D","=",$your_text_variable); //fix links

return $your_text_variable; 


}
?>