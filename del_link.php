<?php
header('Content-Type: text/plain; charset=utf-8');
require_once("library.php");  // library.php 파일 포함
$uid = $_REQUEST['uid'];
//echo $uid;
if($uid ==""){
	echo "FAIL";
	exit();
}

$sql = "delete from fav_link where fnk_uid = '$uid';";
$ret = QueryString($sql);

$sql = "select fnk_uid from fav_link where fnk_uid = '$uid';";
$ret = QueryString2Map($sql);

if(count ($ret)>0){
	echo "FAIL";
	exit();
}

echo "OK";
