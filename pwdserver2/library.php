<?php
require_once("../comm/library.php");  // library.php 파일 포함
require_once("../comm/library.php");  // library.php 파일 포함
function checkSession(){
	startSession();
	#setSession('TEST1','TEST2');

	$page_state = get_login_state('PWD');
	if($page_state != "OK"){

		$result['result']='fail';
		$result['error']='LOGED_OUT';
//		echo $strQuery;
		echo json_encode($result);;
		exit();



	}

}

  $def_die_string = function($mysql_error,$strQuery) {
      $result['result']='fail';
      $result['error']=$mysql_error;
	//		echo $strQuery;
      echo json_encode($result);;
      exit();
  };

?>
