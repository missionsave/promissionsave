<style>
.error {color: #FF0000;} 
input {font-size: 16px;}
button {font-size: 16px;}
select {font-size: 16px;}
</style>
  
<?php //dict
$lg=1;

$dlg = array("pt", "en");
$d1 = array("pt", "Name is required")[$lg];
$d2 = array("pt", "Only letters and white space allowed")[$lg];
$d3 = array("pt", "Email is required")[$lg];
$d4 = array("pt", "Invalid email format")[$lg];
$d5 = array("Estão abertas vagas para estagiários com hipótese de permanência posterior.</p><br><br>
<b>Faça a sua inscrição aqui:</b>", "Vacancies are open for trainees with a possibility of later permanence. </p> <br> <br>
<b> Apply here:</b>")[$lg];
$d6 = array("Nome", "Name")[$lg];
$d7 = array("Telefone", "Telephone")[$lg];
$d8 = array("Ano de nascimento", "Year of birth")[$lg];
$d9 = array("Categoria", "Category")[$lg];
$d10 = array("Carta de Apresentação", "Presentation letter")[$lg];
$d11 = array("Obrigado pela sua inscrição", "Thank you for your registration.")[$lg];
$d12 = array("O seu registo está agora na nossa base de dados.", "Your registration is now in our database.")[$lg];
$d13 = array("O seu registo está agora alterado.", "Your registration is now changed.")[$lg];
$d14 = array(" -- selecione -- ", " -- select -- ")[$lg];
$d15 = array("Selecione o seu CV", "Select your CV")[$lg];
$d16 = array("Submeter", "Submit")[$lg]; 
$d17 = array("Engenheiro informático", "Computer engineer")[$lg]; 
$d18 = array("Engenheiro eletrónico", "Electrical engineer")[$lg]; 
$d19 = array("Engenheiro mecânico", "Mechanical Engineer")[$lg]; 
$d20 = array("Engenheiro agrónomo", "Agronomist Engineer")[$lg]; 
$d21 = array("Serralheiro polivalente", "Multipurpose Locksmith")[$lg]; 
$d22 = array("Administrativa", "Administrative")[$lg]; 
$d23 = array("Outro", "Other")[$lg];  
$d24 = array("Técnico mecatrónico", "Mechatronic Technician")[$lg]; 
// $d24 = array("pt", muda)[$lg]; 
 
 
 
 
 
 
//Só funciona ate uns 256 caracteres, nem sei se da para traduzir pagina toda, interessante mas também subcarrega o servidor e conexao mais lenta 
//https://stackoverflow.com/questions/13172660/language-translation-using-php
function translate($q, $sl, $tl){
	$var="https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q); //$var1= $_SERVER['DOCUMENT_ROOT']."/transes.html"; nao percebo pk isto
    $res= file_get_contents($var);
    $res=json_decode($res);
	// echo $var; 
    return $res[0][0][0];
}
 echo translate("Ano de nascimento, O objetivo a curto prazo","pt","en");
 
?>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $catErr = $presententionErr = $phoneErr = "";
$name = $email = $gender = $presentention = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = $d1;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = $d2; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = $d3;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = $d4; 
    }
  }
    
  if (empty($_POST["presentention"])) {
    $presentention = "";
  } else {
    $presentention = test_input($_POST["presentention"]);
  }
  
  if (empty($_POST["phone"])) {
    $phone = "";
  } else {
    $phone = test_input($_POST["phone"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


$postOk=0;
if(isset($_POST['submit']) && ($nameErr=="") && $emailErr=="")$postOk=1;

$cvErr="";
if(isset($_POST['submit'])){
	$cvErr="color: #FF0000;";
}

?>


<article>
<p id="jobsid" >
<?php echo $d5;?></article> <br>
<div  style="border-style: solid; padding:10px; <?php if( $postOk )echo 'display: none;'; ?> ">

	<form action="<?php echo htmlspecialchars($indexp.'?pg=jobs#jobsid');?>" method="post" enctype="multipart/form-data">
		 
		 <?php echo $d6;?>: <input type="text" name="name" size="25" required="required" value="<?php echo @$name;?>">
		 <span class="error">* <?php echo @$nameErr;?></span>
		 <br><br>
		 
		 E-mail: <input type="text" name="email" size="25" required="required" value="<?php echo @$email;?>">
		 <span class="error">* <?php echo @$emailErr;?></span>
		 <br><br>
	
		<?php echo $d7;?>: <input name="phone"   size="20" type="number" required="required"  value="<?php echo @$phone;?>"/>
		<span class="error">* <?php echo @$phoneErr;?></span>
		<br><br> 
		
		<?php echo $d8;?>: <select name="year" id="year" required="required"  >			
		</select>
		<span class="error">* <?php echo @$birthErr;?></span>
		<br><br> 
		
		<?php echo $d9;?>:
		<select name="job" required="required">
			<option disabled selected value><?php echo $d14;?></option>
			<option value="enginfor"><?php echo $d17;?></option>
			<option value="engelect"><?php echo $d18;?></option>
			<option value="engmec"><?php echo $d19;?></option>
			<option value="tecmec"><?php echo $d24;?></option>
			<option value="engagro"><?php echo $d20;?></option>
			<option value="serralheiro"><?php echo $d21;?></option>
			<option value="administrativa"><?php echo $d22;?></option>
			<option value="outro"><?php echo $d23;?></option>
		</select>
		 <span class="error">* <?php echo @$catErr;?></span> 
		<br><br> 
		
		<?php echo $d10;?>:
		<span class="error">* <?php echo @$presententionErr;?></span>
		<br>
		<textarea style="width:100%; font-family:Arial;" name="presentention" id="presententionid" rows="5" required="required" ></textarea>
		<br><br>
		
		
		<span style=" <?php echo $cvErr;?>  "><?php echo $d15;?>:</span> 
		<br>
		<input type="file" name="fileToUpload" id="fileToUpload" />
		<br><br>
		
		<input type="submit" name="submit"  onclick='storedata()' value="<?php echo $d16;?>" />
	</form>
</div>
<script>
window.onload = function() { 
	if (sessionStorage.presententionid) {
		document.getElementById("presententionid").value = sessionStorage.presententionid; 
	}
	
	//fill year
	var start = new Date().getFullYear()-65;
	var end = new Date().getFullYear()-18;
	var options = "<option disabled selected value> <?php echo $d14;?>  </option>";
	for(var year = end ; year >start; year--){
	  options += "<option>"+ year +"</option>";
	}
	document.getElementById("year").innerHTML = options;
};

function storedata() {
  if(typeof(Storage) !== "undefined") {
    var presententionid = document.getElementById("presententionid").value; 
    sessionStorage.presententionid = presententionid; 
  }
}
</script>
<?php
 
function fileupload($prefix){
	//echo 'fileToUpload '.basename(@$_FILES["fileToUpload"]["name"]);
	if(basename(@$_FILES["fileToUpload"]["name"])=="")return "";
	$target_dir = "uploads/";
	$target_file = $target_dir .$prefix.basename($_FILES["fileToUpload"]["name"]);
	//$target_file = $target_dir . "test";
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	// if(isset($_POST["submit"])) {
		// $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		// if($check !== false) {
			// echo "File is an image - " . $check["mime"] . ".";
			// $uploadOk = 1;
		// } else {
			// echo "File is not an image.";
			// $uploadOk = 0;
		// }
	// }
	// Check if file already exists
	// if (file_exists($target_file)) {
		// echo "Sorry, file already exists.";
		// $uploadOk = 0;
	// }
	// Check file size
	// if ($_FILES["fileToUpload"]["size"] > 500000) {
		// echo "Sorry, your file is too large.";
		// $uploadOk = 0;
	// }
	// // Allow certain file formats
	// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	// && $imageFileType != "gif" ) {
		// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		// $uploadOk = 0;
	// }
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			//echo "Sorry, there was an error uploading your file.";
		}
	}
	return $target_file;
}
?>
<?php
if( $postOk ){
	echo "<h2>".$d11."</h2>";
	$datai=date('Y-m-d H:i:s');
	// $data= date('Y-m-d_H_i_s ');
	// $target_file=fileupload($data.$_POST['name']." "); 
	// echo $_POST['name'].'<br>';
	// echo $_POST['email'].'<br>';
	// echo $_POST['phone'].'<br>';
	// echo $_POST['year'].'<br>';
	// echo $_POST['job'].'<br>';
	// echo $_POST['presentention'].'<br>';
	// echo '<a href="'.$target_file.'">'.$target_file.'</a><br>';
	//$target_file= '<a href="'.$target_file.'">'.$target_file.'</a><br>';
	
	
	//$db = new PDO("sqlite:"."db.sqlite");
	require("connect.php");

/*		
	$sql="CREATE TABLE IF NOT EXISTS fund (
	 cid INTEGER PRIMARY KEY,
	 name TEXT NOT NULL,
	 email TEXT NOT NULL UNIQUE,
	 amount INTEGER NOT NULL,
	 comment BLOB
	);";
	$db->query($sql);

	
	$sql="CREATE TABLE IF NOT EXISTS tabJobs (
	 cid INTEGER PRIMARY KEY,
	 date TEXT NOT NULL,
	 name TEXT NOT NULL,
	 email TEXT NOT NULL UNIQUE,
	 phone TEXT NOT NULL,
	 year INTEGER NOT NULL,
	 job TEXT NOT NULL,
	 presentention TEXT NOT NULL,
	 cv TEXT
	);";
	$db->query($sql);
*/	
	$sql="SELECT * FROM tabJobs where email like ?";
	$stmt = $db->prepare($sql);
	$stmt -> execute(array($_POST['email']));
	$id=0;
	if($stmt->rowCount()==0){	
		$sql="insert into tabJobs (date,name,email,phone,year,job,presentention) values('".$datai."','".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['year']."','".$_POST['job']."','".$_POST['presentention']."')";
  		$stmt1 = $db -> prepare($sql);
		$stmt1 -> execute();
		$stmt -> execute(array($_POST['email']));
		$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$id=$res[0]['id'];		
		echo $d12;
	}else{
		$stmt -> execute(array($_POST['email']));
		$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$id=$res[0]['id']; 
		$sql="update tabJobs set date='".$datai."',name='".$_POST['name']."',phone='".$_POST['phone']."',year='".$_POST['year']."',job='".$_POST['job']."',presentention='".$_POST['presentention']."' where email like '".$_POST['email']."'";		 
		$stmt = $db -> prepare($sql);
		$stmt -> execute();
		echo $d13;
	}
  
	$target_file=fileupload(@$id." "); 
	$sql="update tabJobs set  cv='".$target_file."' where email like '".$_POST['email']."'";
	$stmt = $db -> prepare($sql);
	$stmt -> execute();

 
}
?>












