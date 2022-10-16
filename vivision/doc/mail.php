<?php //example
//require 'mail.php';  
// $mail->addAddress('superbem@gmail.com', 'teste'); 
// $mail->Subject = 'Force'; 
// $mail->Body = 'There is a great disturbance in the Force.';  
// echo send($mail,2);
?>
<?php	 
/*
$inc='phpmail/exception.php';
try {
    if (! @include_once( $inc )) // @ - to suppress warnings,  
    // you can also use error_reporting function for the same purpose which may be a better option
        throw new Exception (' does not exist');
    // or 
    if (!file_exists($inc ))
        throw new Exception ('file does not exist');
    else
        require_once($inc ); 
}
catch(Exception $e) {    
    echo "Message : " . $e->getMessage();
    echo "Code : " . $e->getCode();
} 
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
require 'PHPMailer/src/Exception.php'; 
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function send($mail, $debug=0){
 //return;
try {  
	//$mail->setFrom('danielchanfana@gmail.com', 'Better Planet Mission'); 
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->SMTPDebug  = $debug;
	$mail->SMTPAuth = TRUE;
	$mail->SMTPSecure = 'tls';
	
	$mail->setFrom('super@betterplanetmission.com', 'Better Planet Mission');
	$mail->Host = 'smtp.gmail.com';
	$mail->Username = 'betterplanetmission@gmail.com';
	$mail->Password = 'letters.0';
	$mail->Port = 587;
 
	
	
	// $mail->Host = 'smtp-pulse.com';
	// $mail->Username = 'superbem@gmail.com';
	// $mail->Password = 'FYb5feJ4NMdrib';
	// $mail->Port = 2525;
	
	// $mail->Host = 'localhost';
	// $mail->Username = 'daniel@betterplanetmission.com';
	// $mail->Password = 'centrod.11';	
	// $mail->setFrom('daniel@betterplanetmission.com', 'Better Planet Mission');
	// $mail->Port = 2525;
	return $mail->send();
}
catch (Exception $e)
{ 
   echo $e->errorMessage();
   return 0;
}
catch (\Exception $e)
{ 
   echo $e->getMessage();
   return 0;
}
}
$mail = new PHPMailer(TRUE);
?>