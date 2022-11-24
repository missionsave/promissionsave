<?php

$http="https://docs-google-com.translate.goog/document/d/e/2PACX-1vThTN29m3TTNojOyGrgPVYfV9Gdx56KklDlD_t-l8MlU31oGsv8vMZkbstOkURjGT4FNTFSXIiW2UPH/pub?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt-PT&_x_tr_pto=wapp";


// $http=str_replace("_x_tr_tl=pt","_x_tr_tl=fr",$http);

	$your_text_variable=file_get_contents ($http);

	//remove googletop
	$your_text_variable=explode('<div id="contents">',$your_text_variable)[1];
	$your_text_variable='<div id="contents">'.$your_text_variable;
	$your_text_variable=str_replace("max-width:451.4pt;","",$your_text_variable);
	
	//fix padding
	$your_text_variable=str_replace("padding:72pt 72pt 72pt 72pt","",$your_text_variable); 
	
	
	//remove footnotes
	$your_text_variable=explode("notas de rodap",$your_text_variable)[0];
	// $your_text_variable=explode("<p",$your_text_variable);
	// array_pop($your_text_variable); 
	// $your_text_variable=implode("<p",$your_text_variable);
	
echo $your_text_variable;

?>