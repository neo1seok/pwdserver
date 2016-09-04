<?php

include("library.php");  // library.php 파일 포함
defMeta();

$option = $_REQUEST['option'];
echo 'LOGIN';
vewSessionState();

if($option == "confirm"){
	confirm();
	exit();
}
else if($option == "logout"){
	logout();
	exit();
}


loginform('TRUE');

?>


