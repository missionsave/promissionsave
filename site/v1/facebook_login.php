<?php //facebook login
// https://www.facebook.com/settings?tab=applications&ref=settings
// https://developers.facebook.com/apps/501813340908824/settings/basic/
// https://www.devils-heaven.com/facebook-javascript-sdk-login/
$facelogin=[
	'app_id' => '501813340908824',
	'app_secret' => '8ee52614a45bb04cc691b8ca79cf1c2b',
	'default_graph_version' => 'v12.0',
	'persistent_data_handler' => 'session',
	'http_client_handler' => 'stream',
	];
	
if(@$_GET['action']=="fblogin"){
	session_start();
	require_once( $composer );

	$fb = new Facebook\Facebook($facelogin);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
	$loginUrl = $helper->getLoginUrl($site, $permissions);
	header("location: ".$loginUrl);
}

if(isset($_GET['code']) && isset($_GET['state']) ){
	session_start(); 
	require_once( $composer );

	$fb = new Facebook\Facebook($facelogin);  
	  
	$helper = $fb->getRedirectLoginHelper();  
	if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
} 

	try {     
	  if(isset($_SESSION['facebook_access_token'])){
            $accessToken = $_SESSION['facebook_access_token'];
			}else{
            $accessToken = $helper->getAccessToken($site."/");
        }
	  
	  
	} catch(Facebook\Exceptions\FacebookResponseException $e) {  
	  // When Graph returns an error  
	  
	  echo 'Graph returned an error: ' . $e->getMessage();  
	  exit;  
	} catch(Facebook\Exceptions\FacebookSDKException $e) {  
	  // When validation fails or other local issues  

	  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
	  exit;  
	}  


	try {
	  // Get the Facebook\GraphNodes\GraphUser object for the current user.
	  $response = $fb->get('/me?fields=id,name,email, picture,first_name,last_name', $accessToken->getValue());

	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  // When Graph returns an error
	  echo 'ERROR: Graph ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  // When validation fails or other local issues
	  echo 'ERROR: validation fails ' . $e->getMessage();
	  exit;
	}

	$me = $response->getGraphUser();

	$name = $me->getProperty('name');
	$email = $me->getProperty('email');
	$faceid= $me->getProperty('id'); 
	$pic= "https://graph.facebook.com/".$faceid."/picture?type=large&width=300&height=300&access_token=".$accessToken->getValue();
	// $pic = $response->getGraphObject()->getProperty('picture')->data->url;
	// echo "pic".$pic;
	// file_put_contents("img.jpg", file_get_contents($pic));
	// exit;
	
	create_token(1,0,$pic);
	echo '<script>var clean_uri = location.protocol + "//" + location.host + location.pathname;window.history.replaceState({}, document.title, clean_uri);</script>';
	
}
?>