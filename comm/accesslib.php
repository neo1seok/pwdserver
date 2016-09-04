<?php
require_once 'commlib.php';
function loginform($isprecheck){
	
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
	
	
	echo "
<script src='../comm/js/sha256.js'></script>			
<script type='text/javascript'>


function onInputSubmit(item) {
	console.log('onsubmit');
	var passwd = item.user_pw.value
	var id = item.user_id.value
	//var comps = item.user_pw.value.split(',');
	var mapidRnJson = JSON.parse('$mapidRnJson');
	
	var rn = mapidRnJson[id];
	//console.log(rn);
	
	var passlen = passwd.length-$prechecklength;
	//console.log(passlen);
	var precheck = passwd.slice(passlen);
	passwd = passwd.slice(0,passlen);
	
	
		//console.log(passwd);
		//console.log(precheck);
	
	var pwhash = Sha256.hash(passwd+rn).toUpperCase();
	var precheckHash = Sha256.hash(precheck).toUpperCase();
	
	
		//console.log('$precheckorgvalue');
		//console.log(precheck);
	
		//console.log('$precheck');
		//console.log(precheckHash);
	
		//console.log('$test');
		//console.log(Sha256.hash('ABCD').toUpperCase());
	
	item.user_pw.value = pwhash+precheckHash; 
		//console.log(item.user_pw.value);
	
	return true;
	
}

	
</script>


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
	if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;


	$id = $_POST['user_id'];
	$pwd = $_POST['user_pw'];
	$precheck = $_POST['precheck'];
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
		echo "<script>alert('패스워드가 잘못되었습니다.');history.back();</script>";
		exit;

	}
	
	//exit();

	startSession();
	appendLn("로그인 성공");
	
	setSession($id,$res[2]);

	commBackHome();
}
