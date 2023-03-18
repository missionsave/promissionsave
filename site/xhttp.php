<?php
$location=@$_POST["location"];
require_once($location."connect.php");

if(@$_POST["action"]=="setlatlong"){
	$lat=@$_POST["lat"];
	$long=@$_POST["long"];
	$id=@$_POST["id"];
	$stmt = $db -> prepare("update tabUsers set lat=?,longi=? where id=?");
	$stmt -> execute(array($lat,$long,$id ));
	exit;
}
if(@$_POST["action"]=="perfil_1_set"){  
	$id=@$_POST["id"];
	$stmt = $db -> prepare("update tabUsers set gender=?,gender_looking=?,birth=? where id=?");
	$stmt -> execute(array(@$_POST["gender"],@$_POST["gender_looking"],@$_POST["birth"],$id ));	
	exit;
}
if(@$_POST["action"]=="perfil_2_set"){  
	$id=@$_POST["id"]; 
	date_default_timezone_set('UTC');
	$date=date_create('now')->format("Y-m-d H:i:s");
	$stmt = $db -> prepare("update tabUsers set name=?,aboutme=?,altura=?,look=?,drink=?,smoke=?,children=?,education=?,profession=?,datem=? where id=?");
	$stmt -> execute(array(@$_POST["nome"],@$_POST["aboutme"],@$_POST["altura"],@$_POST["look"],@$_POST["drink"],@$_POST["smoke"],@$_POST["children"],@$_POST["education"],@$_POST["profession"],@$_POST["data"],$id ));
	// echo $date;
	// echo "The time is " . date("h:i:sa");
	echo  date('Y-m-d H:i:s'); 
	// echo  gmdate('Y-m-d H:i:s'); 
	exit;
}
		
if(@$_FILES["image"]["tmp_name"]){
	// move_uploaded_file($_FILES['file']['tmp_name'], $location.'pic/'.@$_POST["id"].'jpg');
	move_uploaded_file($_FILES['image']['tmp_name'], $location.'pic/'.@$_POST["id"].'.jpg');
	echo $location.'pic/'.@$_POST["id"].'.jpg';
	exit;
}		
		
		
		
		
		
?>