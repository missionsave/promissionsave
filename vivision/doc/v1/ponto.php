<?php
if(!empty(@$_POST['newpassword'])){
	$pass=$_POST['password'];
	$npass=$_POST['newpassword'];
	session_start();
	$email=@$_SESSION['email'];
	require("connect.php"); ;
	$stmt = $db -> prepare('UPDATE tabWorkers SET pass=? WHERE email=? AND pass=?;');
	$stmt -> execute(array($npass,$email,$pass));
	echo $stmt->rowCount(); 
	return;
}
?>
<!-- 
Por implementar:
	password md5 

-->
<style>
input {font-size: 16px;}
button {font-size: 16px;}
select {font-size: 16px;}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script><!-- https://sweetalert2.github.io/ 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.3/bootbox.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
-->


<script>
// window.onfocus=function(event){
	// location.reload();  
// }

function md5(d){return rstr2hex(binl2rstr(binl_md5(rstr2binl(d),8*d.length)))}function rstr2hex(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function rstr2binl(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function binl2rstr(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function binl_md5(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}
async function loadDoc() {
try{
	Swal.mixin({
	input: 'password',
	confirmButtonText: 'Next &rarr;',
	showCancelButton: true,
	progressSteps: ['1', '2', '3']}).queue([ 'Current password',  'Type new password',  'Re-type new password']).then((result) => {
	
	if (result.value[1]!=result.value[2]){
		Swal.fire('Passwords doesn`t match','', 'error');
		return;
	}
	if (result.value[1]) { 
		
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "ponto.php", false);
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		if(result.value[0])result.value[0]=md5(result.value[0]);
		result.value[1]=md5(result.value[1]);
		var params = 'password='+result.value[0]+'&newpassword='+result.value[1];
		xhttp.send(params); 
		if(xhttp.responseText=='1'){
			Swal.fire("Changed the password" ,'', 'success'); 
			setTimeout(function() { location.reload(); }, 2000);
		}else Swal.fire("Wrong password" ,'', 'error');
	}
})
}catch(e){
	// Fail!
	console.error(e);
}
}
 
 
// bootbox.prompt({
    // title: "This is a prompt with a password input!",
    // inputType: 'password',
    // callback: function (result) {
        // console.log(result);
    // }
// });	
	
// return;
  // var xhttp = new XMLHttpRequest();
  // xhttp.open("POST", "ponto.php", false);
  // xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  // var params = 'newpassword=1';
  // xhttp.send(params);
  // alert(xhttp.responseText);
  // //document.getElementById("demo").innerHTML = xhttp.responseText;
// }
</script>
<?php //dict
 
$d1 = array('<br>Esta tabela é actualizada diariamente<br>', '<br>This table is updated daily<br>')[$lg];


?>
<?php

?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

input[type=text], input[type=password], select {  
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

</style>
<?php  //print_r($_POST); print_r($_SESSION);?>
<?php 
require("connect.php");

$sql="SELECT tabFases.id,tabFases.Fase,tabFases.FaseEn, round( Sum( ( UNIX_TIMESTAMP(tabPontos.end)-UNIX_TIMESTAMP(tabPontos.start) )/3600 ),1) AS hoursSpent, tabFases.EstimatedHours, round( Sum( ( UNIX_TIMESTAMP(tabPontos.end)-UNIX_TIMESTAMP(tabPontos.start) )/3600 )/tabFases.EstimatedHours*100,2) as per FROM tabFases LEFT JOIN tabPontos ON tabFases.id = tabPontos.idfase GROUP BY tabFases.Fase, tabFases.EstimatedHours, tabFases.id order by tabFases.Fase asc
";
//$sql=str_replace("tabFases.Fase","tabFases.FaseEn",$sql);
$stmt = $db -> prepare($sql);
$stmt -> execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<?php //verifica se utilizador existe e escolhe ultimo
 if(isset($_POST['logout']))
	session_unset();



if(isset($_SESSION['email'])) $_POST['email']=$_SESSION['email'];
if(!empty($_SESSION['password']) && empty($_POST['password'])) $_POST['password']=$_SESSION['password'];
//print_r($_POST); print_r($_SESSION);
if( @$_POST['email'] ){

	$stmt1 = $db -> prepare('SELECT tabWorkers.id, tabWorkers.Name, tabWorkers.pass, tabWorkers.email
	FROM tabWorkers
	WHERE (((tabWorkers.pass)=?) AND ((tabWorkers.email)=?));
	'); 
	$pass=@$_POST['password'];
	if($pass)$pass=md5($pass);
	$stmt1 -> execute(array( $pass , @$_POST['email'] ));		
	$res1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
	foreach($res1 as $row){
		extract($row);
		$idWorker=$id;		
		//echo @$id." | ".$Name." | ".@$email." | ".@$amount." | ".@$comment."<br>";
		$postOk=1;		
	}

$_SESSION['email'] = @$_POST['email'];
$_SESSION['password'] = @$_POST['password'];	
}
?>

<form id='loginForm' autocomplete="on" method='post' style=" <?php if( @$postOk )echo 'display: none;'; ?>" >
    <input   type="text" name="email"    placeholder="email"/>
	<input   name="password" type="password"   placeholder="password"/>
    <input   type='submit' value="Login">
</form>


<div name="loggeddiv" style=" <?php if( !@$postOk )echo 'display: none;'; ?>" >

<?php
if( @$postOk ){
	$stmt2 = $db -> prepare('SELECT tabPontos.id ,tabPontos.start,tabPontos.end  , tabPontos.idfase, tabFases.Fase FROM tabPontos INNER JOIN tabFases ON tabPontos.idfase = tabFases.id WHERE (((tabPontos.idWorker)= ? ))
ORDER BY tabPontos.id desc LIMIT 1;	'); 
	
	$stmt2 -> execute(array($idWorker));		
	$res2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	foreach($res2 as $row){
		extract($row); 
		//echo @$idfase." | ".$Fase." | ".$id." | ".$start." | ".$end."<br>";
	}

	$btfunc="Stop";
	if(@$end!='' || (@$start=='' && @$end==''))$btfunc="Start";

	//POR IMPLEMENTAR
	//se estiver aberto noutro browser, o stop faz start e o start faz stop
	//USAR O REFRESH SE FEZ LOGIN NOUTRO DISPOSITIVO
	$write=1;
	/*if((@$_POST['btfunc']=="Start" && $btfunc=="Stop") || (@$_POST['btfunc']=="Stop" && $btfunc=="Start")) {
		echo "No write"; 
		print_r($_POST); print_r($_SESSION);
		//session_unset();
		$write=0;
		//$_POST = array(); 
		//echo '<script>location.reload();</script>';
	}*/
		
	$faseidsel=@$_POST['faseidsel'];
	if($write==1 && $faseidsel!='') //é login
		if($btfunc=="Stop" && $_POST['btfunc']=="Stop" ){
			$stmt3 = $db -> prepare("UPDATE  tabPontos SET idfase=? ,end=NOW(),obs=? WHERE id=?;");
			$stmt3 -> execute(array($faseidsel, $_POST['obs'], $id));
				$stmt -> execute();
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$btfunc="Start";
			//echo $faseidsel." | ".$id." | ".$start." | ".$end."<br>";
		}else if($btfunc=="Start" && $_POST['btfunc']=="Start" ){
			//echo "INSERT ".$faseidsel;
			$stmt3 = $db -> prepare("INSERT INTO tabPontos(idWorker, idfase, start) VALUES ( ? , ? , NOW() )");
			$stmt3 -> execute(array($idWorker,$faseidsel));	
				$btfunc="Stop";
		}else {
			echo ' <font color="red">Changes not saved.</font> ';
		}
	//$_POST['btfunc']='';
	//echo $btfunc." | ".@$faseidsel." | ".@$start." | ".@$start." | ".@$end."<br>";

echo 'Welcome '.$Name.'<br>';
if($btfunc=="Stop"){
	$stmt2 -> execute(array($idWorker));		
	$res2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	foreach($res2 as $row){
		extract($row); 
		//echo @$idfase." | ".$Fase." | ".$id." | ".$start." | ".$end."<br>";
	}
	echo " Started at ".@$start." Elapsed ".'<span id="datetime"></span>';
}

//
if($faseidsel!='')$idfase=$faseidsel;
echo '<form  method="post" >';
echo '<select style="max-width: 280px;"; name="faseidsel" required="required">';
foreach($res as $row){
	extract($row); 
	$selv='';
	if($id==$idfase)$selv='selected value';
	echo '<option value="'.$id.'" '.$selv.'  >'.$Fase.'</option>';
}
echo '</select>';

// $_SESSION['email'] = @$_POST['email'];
// $_SESSION['password'] = @$_POST['password'];

//start or end
if($btfunc=='Stop')$btc='red'; else $btc='green';
echo '<input style="color:yellow; background-color: '.$btc.';" name="'.'btfunc'.'" type="submit" value="'.$btfunc.'">';


echo '<br><textarea style="'.(($btfunc=="Start")?'display: none;':'').'; max-width: 280px;width: 280px; font-family:Arial;" placeholder="Obs, fill before stop to save" name="obs" id="obs" rows="3"   ></textarea>';

// echo '<button type="button" onclick="loadDoc()" style="float: top; white-space: normal; width:50px">Save Obs</button>';
echo '</form>';

}
?>


<form   style="float: left;" method="post" ><input name="logout" type="submit" value="Logout"> </form> 
<button type="button" onclick="loadDoc()">Change password</button>
<!-- <button type="button" name="refresh" onclick="location.reload()"  style="float: left;" >Refresh</button> -->
</div>


<table>
  <tr> 
    <th style="text-align:center">Total Horas feitas</th>
    <th style="text-align:center">Total Horas estimadas</th>
    <th style="text-align:center">% feito</th>
  </tr>
<?php //totais
echo $d1;

	$stmt6 = $db -> prepare("SELECT round( Sum( ( UNIX_TIMESTAMP(tabPontos.end)-UNIX_TIMESTAMP(tabPontos.start) )/3600 ),1) AS totalHoursSpent FROM tabPontos;");
	$stmt6 -> execute( );
	$res6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
	$stmt7 = $db -> prepare("SELECT Sum(tabFases.EstimatedHours) AS SomaDeEstimatedHours FROM tabFases;");
	$stmt7 -> execute( );
	$res7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
	echo '<tr><td style="text-align:center">'.$res6[0]["totalHoursSpent"].'</td><td style="text-align:center">'.$res7[0]["SomaDeEstimatedHours"].'</td><td style="text-align:center">'.round($res6[0]["totalHoursSpent"]/$res7[0]["SomaDeEstimatedHours"]*100,2).'</td></tr>';


?>
</table>
 <br>

<table>
  <tr>
    <th>Fase</th>
    <th>Horas feitas</th>
    <th>Horas estimadas</th>
    <th>% feito</th>
  </tr> 
<?php 	
foreach($res as $row){
	extract($row);
	if($hoursSpent=='')$hoursSpent=0;
	if($_GET['l']==0)$fase=$Fase; else $fase=$FaseEn;
	echo '<tr><td>'.@$fase.'</td><td style="text-align:right">'.$hoursSpent.'</td><td style="text-align:right">'.@$EstimatedHours.'</td><td style="text-align:right">'.$per.'</td></tr>';
}
?>
</table> 
<script>
function timef(s) {
    return new Date(s  ).toISOString().slice(-13, -5);
}
var myVar = setInterval(myTimer, 1000);
var d = new Date("<?php echo $start; ?>").getTime();
function myTimer() {
  
  var time = new Date().getTime() - d; 
  document.getElementById("datetime").innerHTML = timef(time );
}
</script>

<!-- Só aparece para mim -->
<?php $soeu=(@$postOk && $idWorker==1); ?>

<div style=" <?php if( !$soeu )echo 'display: none;'; ?>">
<br>
<?php 
if( $soeu ){
	$stmt8 = $db -> prepare("select * from tabWorkers");
	$stmt8 -> execute( );
	$res8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
	foreach($res8 as $row){
		extract($row);
		$idw=$id;
		$stmt9 = $db -> prepare('select count(*) as nrows,
DATE_FORMAT(start,"%Y-%m-%d") as day,
any_value(WEEKDAY(start)) as wd,
round( Sum( ( UNIX_TIMESTAMP(tabPontos.end)-UNIX_TIMESTAMP(tabPontos.start) )/3600 ),1) AS hoursSpent
FROM tabPontos 
WHERE start BETWEEN NOW() - INTERVAL 30 DAY AND NOW() and idWorker=? GROUP BY day
order by day desc
');
		$stmt9 -> execute(array($idw) );
		$res9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);
		$weekdays=array("segunda","terça","quarta","quinta","sexta","sabado","domingo");
		echo '<br>'.$Name.'<br>';
		echo '<table><tr><th>Dia</th><th>Dia semana</th><th>Horas feitas</th></tr>';
		foreach($res9 as $row){
			extract($row);
			echo '<tr><td>'.@$day.'</td><td>'.$weekdays[$wd].'</td><td style="text-align:right">'.$hoursSpent.'</td></tr>';
		}
		echo '</table>';
	}
	 
}
 ?>
</div>

<script>function perm(xs) {
  let ret = [];

  for (let i = 0; i < xs.length; i = i + 1) {
    let rest = perm(xs.slice(0, i).concat(xs.slice(i + 1)));

    if(!rest.length) {
      ret.push([xs[i]])
    } else {
      for(let j = 0; j < rest.length; j = j + 1) {
        ret.push([xs[i]].concat(rest[j]))
      }
    }
  }
  return ret;
}

console.log(perm([1,2,3,4]).join("\n"));
</script>

