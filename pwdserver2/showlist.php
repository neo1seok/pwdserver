
<?php
require_once ("library.php"); // library.php 파일 포함
header("Content-Type:application/json");
checkSession();


$page_state = get_login_state('PWD');
$result = array('RESULT' => 'OK');

if($page_state != "OK"){
	$result = array('RESULT' => 'FAIL','REASON'=>"NOT LOGIN");
	echo json_encode($result);
	return;

}
$option = getsaftyReq('option');
$uids = getsaftyReq('uids');
$keyword = getsaftyReq('keyword');


$incondition = '';


switch ($option) {
	case 'uids':
		$uidarray = explode (",", $uids);
		$i = 0;
		foreach ($uidarray as &$v) {
			$v = "'".$v."'";

		}
		$strarrays = join(',', $uidarray);
		$incondition = 'and pwd_uid in ('.$strarrays.')';
		break;
	case 'all':
		$incondition = '';
	break;
	case 'find':
		$incondition = "and site regexp '$keyword';";
	break;

	default:
		# code...
		break;
}


//
// if($option != 'all')
// {
//
// 	$uidarray = explode (",", $uids);
// 	$i = 0;
// 	foreach ($uidarray as &$v) {
// 		$v = "'".$v."'";
//
// 	}
// 	$strarrays = join(',', $uidarray);
// 	$incondition = 'and pwd_uid in ('.$strarrays.')';
// }


$list_passwd_contents = QueryString2Map("SELECT pwd_uid,site, B.title,ptail,B.phd_uid,id,A.etc FROM passwd A,pheader B where A.phd_uid = B.phd_uid $incondition;");
$list_header_contents = QueryString2Map("SELECT phd_uid, title, hint, special_letter FROM pheader;");

$result['list_contents']=$list_passwd_contents;
$result['list_header_contents']=$list_header_contents;
echo json_encode($result);


?>
