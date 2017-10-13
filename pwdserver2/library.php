<?php
require_once("../comm/library.php");  // library.php 파일 포함
require_once("../comm/library.php");  // library.php 파일 포함
function checkSession(){
	setHome("/pwdserver2");
	checkSessionCatagoryByNoPrint('PRIV_LINK');
}

  $def_die_string = function($mysql_error,$strQuery) {
      $result['result']='fail';
      $result['error']=$mysql_error;
	//		echo $strQuery;
      echo json_encode($result);;
      exit();
  };

?>
