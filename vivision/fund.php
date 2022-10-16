<?php 
	
	if(@$_POST['action']=='tokenIsSucess'){
		// $_POST['name'];
		require_once('connect.php');	 
		$_COOKIE['bpmfund'];
		$stmt = $db -> prepare("select * from tabFund where token= ?");
		$stmt -> execute(array($_POST['token']));
		if($stmt->rowCount()==1){
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$myObj=(object)array();
			$myObj->amount = $res[0]['amount'];
			$myObj->comment = $res[0]['comment'];
			$myObj->name = $res[0]['name'];
			$myObj->email = $res[0]['email'];
			echo json_encode($myObj);
			//echo $res[0]['amount'];
			return;
		}
		return;
	}
	if(@$_POST['action']=='faceSucessLogin'){ 
		// $_POST['name'];
		require_once('connect.php');	 
		$stmt = $db -> prepare("select * from tabFund where email like ?");
		$stmt -> execute(array($_POST['email']));
		if($stmt->rowCount()==1){
			// return;
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$myObj=(object)array();
			$myObj->amount = $res[0]['amount'];
			$myObj->comment = $res[0]['comment'];
			echo json_encode($myObj);
			//echo $res[0]['amount'];
			return;
			}else if(@$_POST['facebook']==1){
			//create md5 token
			$token=createToken($_POST['email']);
			setcookie("bpmfund", $token, time() + (86400 * 365), "/");
			$stmt2 = $db -> prepare("insert into tabFund (name,email,facebook,verified,token,amount) values(?,?,1,1,?,?)");
			$stmt2 -> execute(array($_POST['name'],$_POST['email'],$token,$_POST['amount']));//,));
			echo "added";
			return;
		}
	}
	
	if(@$_POST['action']=='setCookie'){
		$token=@$_POST['email']." ". md5(uniqid(@$_POST['email'], true));
		setcookie("bpm", "token", time() + (86400 * 30), "/");
		echo "set";
		return;
		
	}
?>

<!-- https://www.w3schools.com/howto/howto_js_dropdown.asp -->

<style>
	.error {color: #FF0000; font-size:10px; }
	
</style>
<style>
	.button {
	background-color: #008CBA;  
	border: none;
	color: white;
	padding: 15px 32px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
	margin: 4px 2px;
	cursor: pointer;
	}
</style> 
<?php //dict
	
	$dlg = array("pt", "en");
	$f10 = array("Nome é obrigatório", "Name is required")[$lg];
	$f11 = array("Somente letras e espaços em branco são permitidos", "Only letters and white space allowed")[$lg];
	$f12 = array("E-mail é obrigatório", "Email is required")[$lg];
	$f13 = array("Invalid email format", "Invalid email format")[$lg];
	$f14 = array("Pré inscrição para fundo de investimento", "Pre-registration for investment fund")[$lg];
	$f15 = array("* campo obrigatório", "* Required field")[$lg];
	$f16 = array("Nome:", "Name:")[$lg];
	$f17 = array("Escolha quantia a investir:", "Choose quantity to invest:")[$lg];
	$f18 = array("Comentário:", "Comment:")[$lg];
	$f19 = array("Salvar e enviar", "Save and send")[$lg];
	$f20 = array("Quantia que recebe com lucro:", "Amount you earn with profit:")[$lg];
	$f21 = array("Vai permanecer os valores metidos quando voltar a abrir esta pagina, para o caso de querer mudar ou melhorar alguma coisa.", "")[$lg];
	$f22 = array("", "")[$lg];
	$f23 = array("", "")[$lg];
	$f24 = array("", "")[$lg];
?>

<?php
	// define variables and set to empty values
	$nameErr = $emailErr = $genderErr = $amountErr = "";
	$name = $email = $gender = $comment = $amount = "";
	
	// if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['email'])) {
		if (empty($_POST["name"])) {
			$nameErr = $f10;
			} else {
			$name = test_input($_POST["name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				$nameErr = $f11; 
			}
		}
		
		if (empty($_POST["email"])) {
			$emailErr = $f12;
			} else {
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = $f13; 
			}
		}
		
		if (empty($_POST["amount"])) {
			$amount = "0";
			} else {
			$amount = test_input($_POST["amount"]);
			// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$amount)) {
				//$amountErr = "Invalid URL"; 
			}
		}
		
		if (empty($_POST["comment"])) {
			$comment = "";
			} else {
			$comment = test_input($_POST["comment"]);
		}
		
	}
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
?>

<div id="formla"></div>
<div  class="formla" style="  padding:10px; box-shadow: 10px 10px grey; background-color:#4CAF50; color: white;  text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;  <?php if($name!="" && $emailErr=="")echo 'display:none';?>">
	
	<h2  class="shake"><?php echo $f14; ?></h2>
	<br>
	<div id="facelogin" data-login_text="Preencher com facebook" class="fb-login-button" data-scope="public_profile,email"  data-width="" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="true" onlogin="checkLoginState();"></div>
	<br>
	
	<span class="error"><?php echo $f15; ?></span>
	<br><br>
	<form method="post" onsubmit="gentoken();" action="<?php echo htmlspecialchars('?pg=fund&l='.$_GET['l'].'#formla');?>"> 
		<?php echo $f16; ?> <input type="text" id="name" name="name"   value="<?php echo $name;?>">
		<span class="error">* <?php echo $nameErr;?></span>
		<br><br>
		E-mail: <input type="text" id="email" name="email" onchange="//readIfTokenMatch();//fillAmount()" value="<?php echo $email;?>">
		<span class="error">* <?php echo $emailErr;?></span>
		<br><br>
		<?php echo $f17; ?> <input id="amount" type="number"   onclick="this.select();" onClick="this.setSelectionRange(0, this.value.length)"  value="1000" style="width: 100px; text-align: right;" required="required" onkeyup="amountFunction()" onchange="amountFunction()" onkeypress='validate(event)' name="amount" value="<?php echo $amount;?>">
		<label >€</label> <span class="error"><?php echo $amountErr;?></span>
		<p id="demo"></p> 
		<?php echo $f18; ?> <br><textarea style="font-family:Arial; width:250px" width="100%" name="comment" id="comment" rows="3" placeholder="Diga-nos o que achar melhor" ><?php echo $comment;?></textarea>
		<br><br> 
		<input type="submit" onclick="return false;" style="display:none;" > 
		<input type="submit" style="box-shadow: 0px 0px 10px 10px  grey;" class="button" name="submit" value="<?php echo $f19; ?>"> 
		<button id="btfacefill" type='button' style="display:none;" onclick='//botao fill a aparecer SE token existir, se token n existir faz o fill automatico. Criar botao "Novo com email diferente"' >Preencher com facebook</button>
	</form>
</div>
<script>
	function validate(evt) {
		if(evt.keyCode==13 || event.which == 13 ){document.getElementById("comment").focus(); return;}
		
		var theEvent = evt || window.event;
		
		// Handle paste
		if (theEvent.type === 'paste') {
			key = event.clipboardData.getData('text/plain');
			} else {
			// Handle key press
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
		}
		var regex = /[0-9]/;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
	function amountFunction() {
		var x = document.getElementById("amount").value;
		if(x==0)x="0";
		if(x<0){x=10; document.getElementById("amount").value=10;}
		var lucrototal=Math.round(x*1.3);
		var qtpmes=Math.round(((lucrototal-x)/12/6)*100)/100;
		var htm='<br>Quantia que lucra por mês: ' + qtpmes +"€";
		document.getElementById("demo").innerHTML = "<?php echo $f20; ?> " + lucrototal+"€" + htm;
	}
	amountFunction();
</script>
<script> <!-- cookie -->
	function setCookie(cname,cvalue,exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	
	function getCookie(cname) {
		var name = cname + "=";
		var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
	function gentoken(){
		document.getElementById('token').value=md5(Math.random()+document.getElementById('email').value);
	}
	function readIfTokenMatch(){
		var token=getCookie("bpmfund");				
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "fund.php", true);
		var params = 'action=tokenIsSucess&token='+token;
		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
		//xhttp.onreadystatechange = function () {OnReadyStateChanged (xhttp, form)};;
		xhttp.onreadystatechange = function () { 
			obj = JSON.parse(xhttp.responseText);			  
			document.getElementById('amount').value=Number(obj.amount).toString();
			document.getElementById('comment').value=(obj.comment).toString();
			document.getElementById('name').value=(obj.name).toString();
			document.getElementById('email').value=(obj.email).toString();
			amountFunction();
			console.log("resp1: "+xhttp.responseText);
			// if(xhttp.responseText.includes('added')){
			// Swal.fire("E-mail confirmado. Escolha a quantia a investir e salve." ,'', 'success');
			// }else{
			// 
			// }
			
			
		}; 
		
		xhttp.send(params); 
		
	}
	// readIfTokenMatch();
	window.onload= function(e){ 
		readIfTokenMatch();
	}
	// setCookie("bpm","teste",30);
</script>
<?php
	if (@$_POST['email']!="" && @$_POST['name']!="" && empty($emailErr) ) {
		echo "<h2 id='formi'>Obrigado pela sua inscrição</h2>";	 
		require_once('connect.php');	 
		$stmt = $db -> prepare("select id from tabFund where email like ?");
		$stmt -> execute(array($email));
		if($stmt->rowCount()==1){
			$stmt = $db -> prepare("update tabFund set name='".$name."',amount='".$amount."',comment='".$comment."' where email like '".$email."'");
			$stmt -> execute();
			echo "<br>Seu registo foi actualizado"; 
			//sendConfEmail($email,$name);
			
			} else{
			$token=createToken($_POST['email']);
			$stmt = $db -> prepare("insert into tabFund (name,email,amount,comment,token) values(?,?,?,?,?)");
			if( @$stmt -> execute(array($name,$email,$amount,$comment,$token)) ){
				echo "<br>Seu registo foi Inserido";
				//create token 
				setCookieToken($token);
				sendConfEmail($email,$name,$token);
				echo '<p><b>Foi-lhe enviado um email com um link para confirmar que o email que inseriu é seu.</b>';
			}
		}
		// echo @$_POST['token'];
		echo '<p>Dentro de alguns dias, semanas ou meses, se a sua inscrição for aprovada ser-lhe-á enviado um email com as instruções para fazer o seu investimento.';
	}
?>
<script> <!-- md5 -->
function md5(d){return rstr2hex(binl2rstr(binl_md5(rstr2binl(d),8*d.length)))}function rstr2hex(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function rstr2binl(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function binl2rstr(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function binl_md5(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}</script>


<style>
	@-webkit-keyframes shake {
    0% { -webkit-transform: translate(2px, 1px) rotate(0deg); } 
    10% { -webkit-transform: translate(-1px, -2px) rotate(-1deg); }
    20% { -webkit-transform: translate(-3px, 0px) rotate(1deg); }
    30% { -webkit-transform: translate(0px, 2px) rotate(0deg); }
    40% { -webkit-transform: translate(1px, -1px) rotate(1deg); }
    50% { -webkit-transform: translate(-1px, 2px) rotate(-1deg); }
    60% { -webkit-transform: translate(-3px, 1px) rotate(0deg); }
    70% { -webkit-transform: translate(2px, 1px) rotate(-1deg); }
    80% { -webkit-transform: translate(-1px, -1px) rotate(1deg); }
    90% { -webkit-transform: translate(2px, 2px) rotate(0deg); }
    100% { -webkit-transform: translate(1px, -2px) rotate(-1deg); }
	}
	.shake:hover {
    -webkit-animation-name: shake;
    -webkit-animation-duration: 0.5s;
    -webkit-transform-origin:50% 50%;
    -webkit-animation-iteration-count: infinite;
	}
	.shake {
    display:inline-block
	}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script><!-- facebook -->
	window.fbAsyncInit = function() {
    FB.init({
	appId      : '501813340908824',
	cookie     : true,
	xfbml      : true,
	version    : 'v5.0'
    });
    FB.AppEvents.logPageView(); 
    FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
	statusChangeCallback(response);        // Returns the login status.
    });	
	
	};
	
	(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk')); 
	var token;
	function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
	document.getElementById("facelogin").style.display="none";
	token=response.authResponse.accessToken;
	FB.api('/me', {fields: 'email,name'}, function(response) {
	console.log(response); 
	var token=getCookie("bpmfund");
	if(token){
	readIfTokenMatch();
	amountFunction();
	// document.getElementById("btfacefill").style.display = "block";
	return; //nao preenche se tiver token. poderá ser melhorado mas é confuso. devia ter uma confirmaçao;
	}
	document.getElementById('email').value = response.email;
	document.getElementById('name').value = response.name;
	
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "fund.php", false);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
	//xhttp.onreadystatechange = function () {OnReadyStateChanged (xhttp, form)};;
	//xhttp.onreadystatechange = function () {OnReadyStateChanged (xhttp, form)};;
	var params = 'action=faceSucessLogin&name='+response.name+'&email='+response.email+'&amount='+document.getElementById('amount').value+'&facebook=1';
	xhttp.send(params); 
	console.log("resp: "+xhttp.responseText);
	if(xhttp.responseText.includes('added')){
	Swal.fire("E-mail confirmado. Escolha a quantia a investir e salve." ,'', 'success');
	}else{
	obj = JSON.parse(xhttp.responseText);			  
	document.getElementById('amount').value=Number(obj.amount).toString();
	document.getElementById('comment').value=(obj.comment).toString();
	amountFunction();
	}
	}); 
    } else {                                 // Not logged into your webpage or we are unable to tell.
	document.getElementById('status').innerHTML = 'Please log ' +
	'into this webpage.';
    }
	}
	function checkLoginState() {               // Called when a person is finished with the Login Button.
	FB.getLoginStatus(function(response) {   // See the onlogin handler
	statusChangeCallback(response);
});
}

</script>
<?php
	
	
	function isTokenVerified($token){
		$stmt = $db -> prepare("select id from tabFund where email like ? and token='verified%'");
		$stmt -> execute(array($email));
		return $stmt -> rowCount();
	}
	function sendConfEmail($email,$name,$token){  
		require 'mail.php';  
		$mail->addAddress($email, $name); 
		$mail->Subject = 'Confirmação do email da Better Planet Mission'; 
		$mail->IsHTML(true); 
		$mail->Body = 'Para confirmar que o email que inseriu é seu, clique no endereço abaixo (ou copie o endereço para uma nova janela do seu browser):<br> www.betterplanetmission.com?pg=fund&token='.$token;  
		send($mail,0); 
		
	} 
	function createToken($email){
		$token= md5(rand().$email); 
		return $token;
		
	}	
	function setCookieTokenRequest($token){
		
	}
	function setCookieToken($token){ 
		echo '<script>setCookie("bpmfund","'.$token.'",365);</script>';
		$_COOKIE["bpmfund"]=$token;
		// echo "Value is: " . @$_COOKIE["bpmfund"];
	}
	
	if (@$_POST['email']!="" && @$_POST['name']!="" && empty($emailErr) ) {
		// $token = md5(rand().$_POST['email']);
		// echo $token;
		// setCookieToken($token);
	}
	
	
?>   

<?php
	if(@$_GET['token']){
		$stmt = $db -> prepare("select * from tabFund where token like ? and verified like 0");
		$stmt -> execute(array($_GET['token']));
		if($stmt->rowCount()==1){ 
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			setCookieToken($res[0]['token']);
			$stmt = $db -> prepare("update tabFund set verified=1 where token like '".$_COOKIE["bpmfund"]."'");
			$stmt -> execute();
			echo '<script>readIfTokenMatch();</script>';
			echo '<script>Swal.fire("E-mail confirmado." ,"", "success");</script>';
		}
	}
	
?>

<?php
	require_once('connect.php');	 
	$stmt = $db -> prepare("select count(*) as nrows, SUM(amount) as total from tabFund where verified like 1");
	$stmt -> execute(array($email));
	$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$totalinvest=$res[0]['total'];
	
?>
<br> 
<canvas style="display: block; width:600px; border:solid;" id="myChart"   height="300"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2/dist/Chart.min.js"></script>
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	
	
	var bar="horizontalBar";
	//if(window.outerWidth<400)bar="bar";
	
	var myChart = new Chart(ctx, {
		type: bar,
		data: {
			labels: ['Patamares Disponiveis', 'Total dos investidores'],
			datasets: [{
				label: 'Avanço com o protótipo',
				data: [40000, <?php echo $totalinvest; ?>],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
				}, {
				label: 'Desenvolvimento aprofundado do protótipo',
				backgroundColor: [  
				'rgba(255, 206, 86, 0.2)', 
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				borderWidth: 1,
				data: [
				80000
				]
				}, {
				label: 'Prótotipo a funcionar',
				backgroundColor: "rgba(54, 162, 235, 0.2)",
				borderWidth: 1,
				data: [
				180000
				]
			}]
		},
		options: {
			title: {
				display: true,
				text: 'Gráfico actualizado em tempo real'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
				enabled: false
			},responsive: true,
			maintainAspectRatio: true,
			scales: {
				xAxes: [{
					stacked: 1,
					ticks: {
						// Include a dollar sign in the ticks
					callback: function(value, index, values) { return '€' +  String(value).replace(/(.)(?=(\d{3})+$)/g,'$1.'); }}
				}],
				yAxes: [{
					stacked: 0
					
				}]
			}
		}
	});
	
	
	
	
	
</script>
<div style="text-align:justify;">
<br>Faça o gráfico crescer para realizar este projecto, esta missão, que com os lucros, primeiro amortiza todas as dividas, e depois expande pelo Mundo.
<br>Os detalhes dos patamares podem ser verificados <a href="?pg=budget&l=<?php echo @$_GET['l']; ?>">aqui.</a>
</div>

<br><br><br><br>


