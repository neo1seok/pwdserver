<?php
//require_once ("library.php"); // library.php 파일 포함

require_once("commlib.php");  // library.php 파일 포함
require_once 'mysqldb.php';
require_once 'session.php';
header("Content-Type:application/json");
startSession();
$page_state = get_login_state('PWD');

$id = getsaftyReq('id');
$access_code = getsaftyReq('access_code');
$option = getsaftyReq('option');
$pre_key = getsaftySession('pre_key');
$server_rn = getsaftySession('server_rn');

$result = array('result' => 'OK');

$mapHint = array(
    "second_sister"=>"0331",
    "first_sister"=>"1219",
    "dad"=>"0124",
    "mom"=>"1011",
    "me"=>"0815",
    "sewol_sadday"=>"0416",
);



if($option=='access_info'){
  $listmpap = QueryString2Map("SELECT id,rn FROM user;");
  $mapidRn = getMapFromResultDB('id','rn',$listmpap);
  $map_rn_per_hashid = array();
  foreach($mapidRn as $key=>$value){
    $map_rn_per_hashid[sha256($key)]=$value;
	}
  $result['rn_per_hashid'] = $map_rn_per_hashid;

  $server_rn = strtoupper(hash('sha256', generateRandomString(4)));;

  $index = rand(0, count($mapHint) - 1);

  $key = array_keys($mapHint)[$index];

  $result['pre_key'] = $key;
  $result['server_rn'] = $server_rn;
  $result['server_rn'] = $server_rn;



	$_SESSION['pre_key'] = $key;
  $_SESSION['server_rn'] = $server_rn;


  echo json_encode($result);
  exit;
}
elseif ($option=='log_out') {
  #session_start();
	session_destroy();
  echo json_encode($result);
  exit;
  # code...
}


$sql = sprintf("SELECT rn,pwd,name FROM user where id='%s';",$id);

$res = QueryString($sql);

$rn = $res[0];
$hashpwd = $res[1];
$name = $res[2];

// $result['sql'] = $sql;
// $result['res'] = $res;
if(!isset($res)|| !$res ){
  $result['result'] = 'FAIL';
  $result['error'] = 'ID NOT EXIST';
  echo json_encode($result);
  exit;

}

$pre_key_value = $mapHint[$pre_key];
$input_hash = $hashpwd.$server_rn.sha256_from_hexstr(strToHex($pre_key_value));
$cmppwdhash = sha256_from_hexstr($input_hash);

//$result['test'] = sha256_from_hexstr("3FF4E525982052700163006800750079006900000074289610099DC9010074A0D7DB0B9DC9014D007900470072006F007500700000002F000000");
//$result['test_1'] =strToHex('안녕');
//$option = getsaftyReq('option');

//$result['etc_info'] = $mapidRn;
// $result['pre_key'] = $pre_key;
// $result['pre_key_value'] = $pre_key_value;

// $result['hash_pre_key_value'] = sha256_from_hexstr(strToHex($pre_key_value));
// $result['hex_pre_key_value'] = strToHex($pre_key_value);
// $result['010203'] = sha256_from_hexstr('010203');;

if($access_code != $cmppwdhash){
  $result['result'] = 'FAIL';
  $result['error'] = 'PASSWORD IS NOT MATCH';
//  $result['input_hash'] = $input_hash;

}
else{
  setSession($id,$name);

}
// $result['cmppwdhash'] = $cmppwdhash;
// $result['access_code'] = $access_code;
//
// $rnshort = generateRandomString(4);
// $result['etc_info_random'] = $rnshort;
//var_dump($result);
echo json_encode($result);
?>
