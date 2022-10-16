<?php
print_r($_POST);
session_start(); 
require_once( 'vendor/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '501813340908824',
  'app_secret' => '8ee52614a45bb04cc691b8ca79cf1c2b',
  'default_graph_version' => 'v2.5',
]);  
  
$helper = $fb->getRedirectLoginHelper();  
  
try 
{  
  $accessToken = $helper->getAccessToken();  
} catch(Facebook\Exceptions\FacebookResponseException $e) {  
  // When Graph returns an error  
  
  echo 'Graph returned an error: ' . $e->getMessage();  
  exit;  
} catch(Facebook\Exceptions\FacebookSDKException $e) {  
  // When validation fails or other local issues  

  echo 'Facebook SDK returned an error: ' . $e->getMessage();  
  exit;  
}  


try 
{
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  $response = $fb->get('/me?fields=id,name,email,first_name,last_name', $accessToken->getValue());

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

echo "Full Name: ".$me->getProperty('name')."<br>";
echo "Email: ".$me->getProperty('email')."<br>";
echo "Facebook ID: <a href='https://www.facebook.com/".$me->getProperty('id')."' target='_blank'>".$me->getProperty('id')."</a>";

?>