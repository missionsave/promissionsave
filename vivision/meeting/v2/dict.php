<?php //dicionario sql
// $lang=2;	
$dd="";
if($lang!=0){
	require_once('connect.php');
	if($lang==1)$stmt = $db -> prepare("select pt,en from tabDict ");
	if($lang==2)$stmt = $db -> prepare("select pt,fr from tabDict ");
	if($lang==3)$stmt = $db -> prepare("select pt,es from tabDict ");
	$stmt -> execute( );
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$ddje = json_encode($results);
	$dd = json_decode($ddje); 
}

// echo translate("Ano de nascimento, O objetivo a curto prazo","pt","en");
function translate($q, $sl, $tl){
	$var="https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q); //$var1= $_SERVER['DOCUMENT_ROOT']."/transes.html"; nao percebo pk isto
    $res= file_get_contents($var);
    $res=json_decode($res);
	// echo $var; 
    return $res[0][0][0];
}
function endsWith($haystack, $needle) {
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}

function d($text){
	global $dd, $db, $lang;
	if($lang==0) return $text;
	for($i=0;$i<count($dd);$i++){ 
		// echo $dd[$i]->en;
		// if($lang==0 && $text==$dd[$i]->pt) return $dd[$i]->pt;
		if($lang==1 && $text==$dd[$i]->pt) return $dd[$i]->en;
		if($lang==2 && $text==$dd[$i]->pt) return $dd[$i]->fr;		
		if($lang==3 && $text==$dd[$i]->pt) return $dd[$i]->es;		
	}
	$vet[0] = $text;
	$vet[1] = "";
	$vet[2] = "";
	$vet[3] = "";

	$pieces = explode(".", $text);
	foreach($pieces as $i){
		if($i=="")continue;
		$vet[1] .= translate($i,"pt","en").". ";
		$vet[2] .= translate($i,"pt","fr").". ";
		$vet[3] .= translate($i,"pt","es").". ";
		// $vet[2] .= translate($text,"pt","en").".";
	}
	// $vet[1]=implode($vet[1],". ");
	// $vet[2]=implode($vet[2],". ");
	
	$vet[1]=str_replace(". .",".",$vet[1]);
	$vet[2]=str_replace(". .",".",$vet[2]);
	$vet[3]=str_replace(". .",".",$vet[3]);
	
	if(!endsWith($text, '.')){
		$vet[1]=substr($vet[1], 0, -2);
		$vet[2]=substr($vet[2], 0, -2);
		$vet[3]=substr($vet[3], 0, -2);
	}
	
	$stmt = $db -> prepare("INSERT INTO tabDict (pt, en, fr, es) VALUES (?,?,?,?)");
	$stmt -> execute( [$text, $vet[1], $vet[2], $vet[3] ]  );
	
	return $vet[$lang];
}
?>