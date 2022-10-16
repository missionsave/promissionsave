<?php //dicionario sql
$lang=2;	
	
require_once('../connect.php');
$stmt = $db -> prepare("select * from tabDict");
$stmt -> execute( );
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$ddje = json_encode($results);
$dd = json_decode($ddje); 

// echo translate("Ano de nascimento, O objetivo a curto prazo","pt","en");
function translate($q, $sl, $tl){
	$var="https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q); //$var1= $_SERVER['DOCUMENT_ROOT']."/transes.html"; nao percebo pk isto
    $res= file_get_contents($var);
    $res=json_decode($res);
	// echo $var; 
    return $res[0][0][0];
}
 

function d($text){
	global $dd, $db, $lang;
	for($i=0;$i<count($dd);$i++){ 
		// echo $dd[$i]->en;
		if($lang==0 && $text==$dd[$i]->pt) return $dd[$i]->pt;
		if($lang==1 && $text==$dd[$i]->pt) return $dd[$i]->en;
		if($lang==2 && $text==$dd[$i]->pt) return $dd[$i]->fr;		
	}
	$vet[0] = $text;
	$vet[1] = translate($text,"pt","en");
	$vet[2] = translate($text,"pt","fr");
	$stmt = $db -> prepare("INSERT INTO tabDict (pt, en, fr) VALUES (?,?,?)");
	$stmt -> execute( [$text, $vet[1], $vet[2] ]  );
	
	return $vet[$lang];
}
?>

<script>

</script>

ola <?php echo d("batata doce assada preço ao quilo"); ?>