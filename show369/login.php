<?php

include("library.php");  // library.php 파일 포함
defMeta();

$option = $_REQUEST['option'];
echo 'LOGIN';
vewSessionState();

if($option == "confirm"){
	$pi_debug_value = getenv ( 'PWD_SERVER_DEBUG');
	if($pi_debug_value == 'TRUE')
		debugconfirm();
	else
		confirm();
	exit();
}
else if($option == "logout"){
	logout();
	exit();
}

$pi_debug_value = getenv ( 'PWD_SERVER_DEBUG');
pnl();
echo $pi_debug_value;
//echo $_SERVER['WINDIR'] ;
//phpinfo();
pnl();

loginform('TRUE');

?>
