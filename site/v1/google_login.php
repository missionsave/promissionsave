<?php //google login
// https://myaccount.google.com/u/2/permissions?continue=https%3A%2F%2Fmyaccount.google.com%2Fu%2F2%2Fsecurity
// https://console.cloud.google.com/apis/credentials?project=lucid-access-318123


//vem do one tap google login
if(isset($_GET["credential"])){
	$token=$_GET["credential"]; 
	$vart=json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
	// print_r ($vart);
	// exit;
	
	$stdClass = (array)$vart;
	$name= $stdClass['name'];
	$email= $stdClass['email'];	
	$email_verified= $stdClass['email_verified'];	
	$pic= $stdClass['picture'];	
	create_token(0,1,$pic);
	//limpar query do uri
	echo '<script>var clean_uri = location.protocol + "//" + location.host + location.pathname;window.history.replaceState({}, document.title, clean_uri);</script>';
}

// require_once $composer;
  
// init configuration
$clientID = '196492632823-irqcoojbku438t6bqvogaqnr4k9erjer.apps.googleusercontent.com';
$clientSecret = 'mp-FsGt3ZBvhf3mvuuVCsvPc';
$redirectUri = $site;
   
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
  
// authenticate code from Google OAuth Flow
if (isset($_GET['code']) && isset($_GET['scope']) ) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $pic =  $google_account_info->picture;
  create_token(0,1,$pic);
  // echo $email ." ".  $name;
  
  //limpar query do uri
  echo '<script>var clean_uri = location.protocol + "//" + location.host + location.pathname;window.history.replaceState({}, document.title, clean_uri);</script>';

  // now you can use this profile info to create account in your website and make user logged in.
} else {
  // echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
// echo 'test';
?>