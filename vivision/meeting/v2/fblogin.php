<?php
session_start();
require_once( 'vendor/autoload.php' );

$fb = new Facebook\Facebook([
  'app_id' => '501813340908824',
  'app_secret' => '8ee52614a45bb04cc691b8ca79cf1c2b',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions for more permission you need to send your application for review
$loginUrl = $helper->getLoginUrl('https://hifood.org/callback.php', $permissions);
header("location: ".$loginUrl);

?>