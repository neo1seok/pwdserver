<?php

include("library.php");  // library.php 파일 포함
defMeta();

$option = getsaftyReq('option');
echo 'LOGIN';

if($option == "confirm"){
	$pi_debug_value = getenv ( 'PWD_SERVER_DEBUG');
	if($pi_debug_value == 'TRUE')
		debugconfirm();
	else
		confirm();
	exit();
	// confirm();
	// exit();
}
else if($option == "logout"){\
	logout();
	exit();
}

loginform('TRUE');

?>
