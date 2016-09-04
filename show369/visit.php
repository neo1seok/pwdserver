<?php
include("library.php");  // library.php 파일 포함
defMeta();

setSession('VISIT','방문자');

if(isset($_REQUEST['id'])) {
	$uid = $_REQUEST['id'];
	pagego("inputname.php?id=$uid&option=profile");
	exit;
}
$debug = getsaftyReq('debug');

if($debug == 'true'){
	$_SESSION['debug'] = $debug;
	$_SESSION['user_name'] = '테스터';
	$_SESSION['user_id'] = 'TESTER';
}
	


pagego('list.php');
 
?>

