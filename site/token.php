<?php //create logged token
// require_once('connect.php');	 

//check_token
// load:
if(@$_COOKIE["promition"]!=""){ 
	$token=$_COOKIE["promition"];
	try{
	$stmt = $db -> prepare("select * from tabUsers where token like ?");
	}catch(PDOException $exception){ echo "Servidor sobrecarregado, tente novamente em 10 segundos"; exit;}
	$stmt -> execute(array($token  ));
	if($stmt->rowCount()==1){
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$id=$res[0]['id'];
		$email=$res[0]['email'];
		$name=$res[0]['name'];
		$lat=$res[0]['lat'];
		$long=$res[0]['longi'];
	} 
}
// function 
function create_token($facebook,$google,$pic){
	global $res, $db, $id, $email, $name, $location;
	// setCookie("vivisionl",$token);
	// echo $_COOKIE["vivisionl"];
	$token="";
	//check if user exists
	$stmt = $db -> prepare("select * from tabUsers where email like ?");
	$stmt -> execute(array($email  ));
	//new user
	if($stmt->rowCount()==0){
		$token=md5(rand().$email);
		$stmt2 = $db -> prepare("insert into tabUsers (datec,name,email,facebook,google,verified,token) values(utc_timestamp(),?,?,?,?,1,? )");
		$stmt2 -> execute(array($name,$email,$facebook,$google,$token )); 
		//get user id
		$stmt3 = $db -> prepare("select id from tabUsers where email like ?");
		$stmt3 -> execute(array($email  ));
		$res = $stmt3->fetchAll(PDO::FETCH_ASSOC);
		$id=$res[0]['id'];
		// echo $id.$pic;
		file_put_contents($location."pic/".$id.".jpg", file_get_contents($pic));
		// exit;
	}else{
		//user exists 
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$id=$res[0]['id'];
		$token=$res[0]['token'];
	}
	setCookie("promition",$token,time() + (100 * 365 * 24 * 60 * 60));
	$_COOKIE["promition"]=$token; //to have access without refresh
	// goto load;
}
 
?>