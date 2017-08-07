<?php
require_once("../comm/library.php");  // library.php 파일 포함
require_once("../comm/library.php");  // library.php 파일 포함
function checkSession(){
	setHome("/fav_link/main.php?option=priv_link");
	checkSessionCatagoryByNoPrint('PRIV_LINK');
}


?>
