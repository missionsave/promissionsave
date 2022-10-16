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
	$vet[1] = array();
	$vet[2] = array();
	$vet[3] = array();

	$pieces = explode(".", $text);
	foreach($pieces as $i){
		if($i==""){
			array_push($vet[1],"");
			array_push($vet[2],"");
			array_push($vet[3],"");
			continue;
		}
		array_push($vet[1],translate($i,"pt","en"));
		array_push($vet[2],translate($i,"pt","fr"));
		array_push($vet[3],translate($i,"pt","es"));
		// $vet[2] .= translate($i,"pt","fr").". ";
		// $vet[3] .= translate($i,"pt","es").". ";
		// $vet[1] .= translate($i,"pt","en").". ";
		// $vet[2] .= translate($i,"pt","fr").". ";
		// $vet[3] .= translate($i,"pt","es").". ";
		// $vet[2] .= translate($text,"pt","en").".";
	}
	// $vetr[1]=implode($vet[1],". ");
	// $vetr[2]=implode($vet[2],". ");
	// $vetr[3]=implode($vet[3],". ");
	$vetr[1]=implode(". ",$vet[1]);
	$vetr[2]=implode(". ",$vet[2]);
	$vetr[3]=implode(". ",$vet[3]);
	
	$vetr[1]=str_replace(".. ",".",$vetr[1]);
	$vetr[2]=str_replace(".. ",".",$vetr[2]);
	$vetr[3]=str_replace(".. ",".",$vetr[3]);
	
	// $vet[1]=str_replace(". .",".",$vet[1]);
	// $vet[2]=str_replace(". .",".",$vet[2]);
	// $vet[3]=str_replace(". .",".",$vet[3]);
	
	// if(!endsWith($text, '.')){
		// $vet[1]=substr($vet[1], 0, -2);
		// $vet[2]=substr($vet[2], 0, -2);
		// $vet[3]=substr($vet[3], 0, -2);
	// }
	
	$stmt = $db -> prepare("INSERT INTO tabDict (pt, en, fr, es) VALUES (?,?,?,?)");
	$stmt -> execute( [$text, $vetr[1], $vetr[2], $vetr[3] ]  );
	
	return $vetr[$lang];
}
?>