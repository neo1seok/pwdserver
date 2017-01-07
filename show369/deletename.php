<?php
include("library.php");  // library.php 파일 포함
defMeta();
//setHome("");

checkSession();

$uid = $_REQUEST['id'];
$option = $_REQUEST['option'];


function deleteImgID($uid,$nickname){


	$sql = "delete from nickname where nck_uid='$uid'";
	QueryString($sql);
	// echo "<meta http-equiv='refresh' content='0;url=list.php?optjion=image'>";
	commBackHome();
	echo "TEST";
}


if( $option != 'delete_confirm' &&  $option == 'delete') exit;
$user_id = $_SESSION['user_id'];
$ret = strpos($user_id, 'VISIT');
if (0 === $ret) {
  pagego('login.php');
  exit;
}
if($option == 'confirm'){
  echo "<script> var val = confirm('$uid($nickname) 를 삭제 하시겠습니까?');//history.back();\n";
  echo "
  console.log(val);

  if ( val == false){
    window.location.href = 'inputname.php?id=$uid&option=shrink';
    //echo val;
    console.log('false');

  }
  else{
    window.location.href = 'deletename.php?id=$uid';
    console.log('true');
  }

  ";
  echo "</script>";
}
else {
  deleteImgID($uid,$nickname);
}



?>;
