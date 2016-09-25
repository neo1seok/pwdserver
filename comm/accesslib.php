<?php
global $baseroot;
//
$HTTP_HOST =$_SERVER['HTTP_HOST'];
require_once 'commlib.php';
require_once "$baseroot/vendor/autoload.php";

function getFaceBook(){
	
	$appId = "";
	$LOGIN_DEBUG = getenv('LOGIN_DEBUG');
	
	$appId      = '171344269971521';
	$app_secret = 'dd81a9e2abb7eb1ce47a7c201b11a53d';
	if($LOGIN_DEBUG == "TRUE"){
		$appId      = '180688449037103';
		$app_secret = 'd99c9928a1e4c92d150d6ea249730def';
	}
	//appId      : '171344269971521',
	
	
	
	
	$fb = new Facebook\Facebook([
			'app_id' => $appId,
			'app_secret' => $app_secret,
			'default_graph_version' => 'v2.5',
	]);
	return $fb;
	
}
function loginform($isprecheck){
	
<<<<<<< HEAD
	$HTTP_HOST =$_SERVER['HTTP_HOST'];
	/*	
=======
>>>>>>> 52e91995418d32a8bcf77d7123b6b9e431f1db8e
	$LOGIN_DEBUG = getenv('LOGIN_DEBUG');
	
	$appId = "";
	

	$appId      = '171344269971521';
<<<<<<< HEAD
	$app_secret = 'dd81a9e2abb7eb1ce47a7c201b11a53d';
	if($LOGIN_DEBUG == "TRUE"){
		$appId      = '180688449037103';
		$app_secret = 'd99c9928a1e4c92d150d6ea249730def';
	}
	//appId      : '171344269971521',
	
		
	
		if(!session_id()) {
			session_start();
		}
		$fb = new Facebook\Facebook([
				'app_id' => $appId,
				'app_secret' => $app_secret,
				'default_graph_version' => 'v2.5',
		]);*/

	
=======
	if($LOGIN_DEBUG == "TRUE")
		$appId      = '180688449037103';
	//appId      : '171344269971521',
	
>>>>>>> 52e91995418d32a8bcf77d7123b6b9e431f1db8e
	
	if($isprecheck == 'TRUE'){
		
		$listmpap = QueryString2Map("SELECT id,rn FROM user;");
		$mapidRn = getMapFromResultDB('id','rn',$listmpap);
		
		$mapidRnJson = json_encode($mapidRn);
		
		$precheck = 'true';
		$mapHint = array(
				"0331"=>"second sister",
				"1219"=>"first sister",
				"0124"=>"dad",
				"1111"=>"mom",
		
		
		);
		
		//$date =  date("md");
		$rnshort = generateRandomString(4);
// 		$randnum = rand(0, count($mapHint)-1);
// 		$index = 0;
		
// 		foreach ($mapHint as $k => $v){
			
// 			//$precheck = $date.$k;
// 			$hint = $v;
// 			$key = $k;
// 			if($index == $randnum) break;
// 			$index++;
		
// 		}
		$precheckorgvalue = $rnshort;//$date.$key;
		$precheck = strtoupper(hash('sha256', $precheckorgvalue));
		$prechecklength = strlen($precheckorgvalue);
		$test = strtoupper(hash('sha256', 'ABCD'));
		appendLn("<p>RN:$rnshort </p>");
		
		
	}
	
	if(!session_id()) {
		session_start();
	}
	
	$fb = getFaceBook();
	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email', 'user_likes']; // optional
	$loginUrl = $helper->getLoginUrl("http://$HTTP_HOST/comm/logincallback.php?precheck=$precheck", $permissions);
	
	echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
	
	echo "
<script src='../comm/js/sha256.js'></script>			
<script type='text/javascript'>

function makePasswd(id,passwd,precheck){

	var mapidRnJson = JSON.parse('$mapidRnJson');
	var rn = mapidRnJson[id];
	var pwhash = Sha256.hash(passwd+rn).toUpperCase();
	var precheckHash = Sha256.hash(precheck).toUpperCase();
	return pwhash+precheckHash;
	
}
function onInputSubmit(item) {
	console.log('onsubmit');
	var passwd = item.user_pw.value
	var id = item.user_id.value
	
	var passlen = passwd.length-$prechecklength;

	var precheck = passwd.slice(passlen);
	passwd = passwd.slice(0,passlen);
	
	item.user_pw.value = makePasswd(id,passwd,precheck);
	
	return true;

	
}
<<<<<<< HEAD
=======
 // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
	    FB.init({
	      //appId      : '171344269971521',
	      appId      : '$appId',
	      xfbml      : true,
	      version    : 'v2.7'
	    });
	  };
	  
	  
  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

//  FB.getLoginStatus(function(response) {
 //   statusChangeCallback(response);
//  });

>>>>>>> 52e91995418d32a8bcf77d7123b6b9e431f1db8e
 
	
</script>

<div id='status'>
</div>
<div
  class='fb-like'
  data-share='true'
  data-width='450'
  data-show-faces='true'>
</div>

<form method='post' action='login.php' onsubmit='return onInputSubmit(this);'>
<input type='hidden' name='option' value='confirm'/>
<input type='hidden' name='precheck' value='$precheck'/>
<table>
		<tr>
	<td>아이디 </td>
	<td><input type='text' name='user_id' tabindex='1'/></td>
	<td rowspan='2'><input type='submit' tabindex='3' value='로그인' style='height:50px'/></td>
</tr>
<tr>
	<td>비밀번호</td>
	<td><input type='password' name='user_pw' tabindex='2' value = ''/></td>
</tr>

";

echo	"

</table>
</form>
			";
}

function logout(){
	$homeurl ='main.php';
	startSession();
	
	vewSessionState();
	
	if(isset($_SESSION['homeurl']) ) {
		$homeurl =$_SESSION['homeurl'];

	}


	session_start();
	session_destroy();
	echo "
			
			";
	//echo $homeurl;
	pagego($homeurl);
}
function generateRandomString($length = 10) {
	$characters = 'abcdefghijklmnopqrstuvwxyz';
	#$characters = '0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

function confirm(){
	if(!isset($_REQUEST['user_id']) || !isset($_REQUEST['user_pw'])) exit;


	$id = $_REQUEST['user_id'];
	$pwd = $_REQUEST['user_pw'];
	$precheck = $_REQUEST['precheck'];
	//$precheck_value = $_POST['precheck_value'];

	$sql = sprintf("SELECT rn,pwd,name FROM user where id='%s';",$id);


	echo $sql;
	echo "2 <br />\n";
	
	echo $pwd;
	pnl();
	

// 	echo $precheck_value;
// 	pnl();
	echo $precheck;
	pnl();

// 	if($precheck != $precheck_value){
// 		echo "값 다름";
// 		exit();
// 			echo "<script>alert('check 값이 다릅니다.');history.back();</script>";
// 		exit();
// 	}
	


	$res = QueryString($sql);

	if(!isset($res)){
		echo "<script>alert('아이디 가 잘못되었습니다.');history.back();</script>";
		exit;

	}
	
	$hashpwd = $res[1];
	
	
	$cmppwdhash = strtoupper(hash('sha256', $pwd . $res[0])).$precheck;
	
	echo $hashpwd.$precheck;
	pnl();
	echo $pwd;
	pnl();

	
	

	if( $pwd != $hashpwd.$precheck){
		//echo "<script>alert('패스워드가 잘못되었습니다.');history.back();</script>";
		exit;

	}
	
	//exit();

	startSession();
	appendLn("로그인 성공");
	
	setSession($id,$res[2]);

	commBackHome();
}
