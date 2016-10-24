<?php

require_once("../comm/library.php");
require '../vendor/autoload.php';


$state = getsaftyReq('state');
$code = getsaftyReq('code');

if(!session_id()) {
	session_start();
}

$fb = new Facebook\Facebook([
		'app_id' => '180688449037103',
		'app_secret' => 'd99c9928a1e4c92d150d6ea249730def',
		'default_graph_version' => 'v2.5',
]);


$helper = $fb->getRedirectLoginHelper();
try {
	$accessToken = $helper->getAccessToken();
	//$fb->setDefaultAccessToken($accessToken);
	$response = $fb->get('/me?fields=id,name,email',$accessToken);
	$userNode = $response->getGraphUser();
	
	//$helper->
	echo $accessToken;
	pnl();
	echo $userNode;
	pnl();
	echo $userNode["id"];
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (isset($accessToken)) {
	// Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;

	// Now you can redirect to another page and use the
	// access token from $_SESSION['facebook_access_token']
}