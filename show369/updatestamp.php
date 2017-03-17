<?php
include("library.php");  // library.php 파일 포함
header('Content-Type: text/plain; charset=utf-8');

function processPreset(){

	$sql = "UPDATE nickname SET todayin = 'FALSE',comment = '',`order`=-1;"		;
	appendLn($sql);
	//pnl();
	QueryString($sql);
}
function processDeleteEmpty($uidarray){

	$sql = "SELECT nickname,imgid FROM nickname;";

	appendLn($sql);
	//pnl();

	$maplist =  QueryString2Map($sql);

	$mapresult = getMapFromResultDB('imgid','nickname',$maplist);
	$listindb = array();


	foreach ($mapresult as $k => $v){
		array_push($listindb, $k);
		//echo $k;
		//pnl();
	}

	$nextseq = getNextSeq('nickname');

	foreach ($uidarray as $v){
		if($v == '') continue;

		if (!in_array($v, $listindb)) {
			$sql = "INSERT INTO nickname
			(seq, nck_uid, imgid, stamp, nickname, todayin, updt_date, reg_date, comment)
			VALUES ($nextseq, 'nck_$nextseq', '$v', 'FALSE', '', 'TRUE', now(), now(), 'comment');";

			appendLn($v ." not exit in db = ");
			appendLn($sql);
			//pnl();
			QueryString($sql);

			//pnl();
			$nextseq++;
		}

	}



}
function processInsert($uidarray){

	$sql = "SELECT nickname,imgid FROM nickname;";
	//echo $sql;
	//pnl();

	$maplist =  QueryString2Map($sql);

	$mapresult = getMapFromResultDB('imgid','nickname',$maplist);
	$listindb = array();


	foreach ($mapresult as $k => $v){
		array_push($listindb, $k);
		//echo $k;
		//pnl();
	}
	//echo "mark 0";

	$nextseq = getNextSeq('nickname');

	//echo "mark 1";

	foreach ($uidarray as $v){
		if($v == '') continue;

		if (!in_array($v, $listindb)) {
			$sql = "INSERT INTO nickname
			(seq, nck_uid, imgid, stamp, nickname, todayin, updt_date, reg_date, comment)
			VALUES ($nextseq, 'nck_$nextseq', '$v', 'FALSE', '', 'TRUE', now(), now(), 'comment');";

			appendLn( $v ." not exit in db = ");
			//echo $sql;
			//pnl();
			QueryString($sql);

			//pnl();
			$nextseq++;
		}

	}
	//echo "mark 2";



}
function processOrderNTodayIn($uidarray){

	$order = 0;
	foreach ($uidarray as $v){
		$strorder = "";//sprintf("%05d", $order);
		$sql = "UPDATE nickname SET todayin = 'TRUE', updt_date = now(),comment = '$strorder',`order`=$order where imgid = '$v';"		;

		//pnl();
		QueryString($sql);
		$order++;


	}



}

function processUpdateProfile($mapprofile){


	foreach ($mapprofile as $k => $v){
		$imgid_profile = $v[0];
		$imgid_ext = $v[1];

		$sql = "UPDATE nickname SET imgid_profile = '$imgid_profile',imgid_ext = '$imgid_ext', updt_date = now() where nickname = '$k';"		;

		//pnl();
		QueryString($sql);



	}



}
function processSetHistory($uidarray,$imgids,$uids){

	$nck_uids = '';
	$maplist =  QueryString2Map("SELECT nck_uid ,imgid FROM nickname where imgid in (".$imgids.");");
	$newmap = getMapFromResultDB('imgid','nck_uid',$maplist);

	foreach ($uidarray as $v){
		$nck_uid = $newmap[$v];
		$nck_uids .= $nck_uid.",";
	}

// 	foreach ($maplist as $v){
// 		$nck_uid = $v['nck_uid'];
// 		$nck_uids .= $nck_uid.",";
// 	}



	$nextseq = getNextSeq('history');

	$hashuids =  strtoupper(hash('sha256', $uids));

	$sql = "INSERT INTO history (seq, hst_uid, uids, updt_date, reg_date, comment)

	VALUES ($nextseq, 'hst_$nextseq', '$nck_uids', now(), now(), '$hashuids');";
	QueryString($sql);


}
function processSetHistoryJustHash($uids){

	$nck_uids = '';
	$maplist = getPrevHistory();

	$hst_uid = $maplist[0]['hst_uid'];



//	$hashuids =  strtoupper(hash('sha256', $uids));

// 	$sql = "INSERT INTO history (seq, hst_uid, uids, updt_date, reg_date, comment)

// 	VALUES ($nextseq, 'hst_$nextseq', '$nck_uids', now(), now(), '$hashuids');";


	$sql = "UPDATE history SET updt_date = now() WHERE hst_uid = '$hst_uid';";
	QueryString($sql);


}
function processTimeStamp(){

	$maplist =  QueryString2Map("SELECT nck_uid,todayin FROM nickname where stamp = 'TRUE';");

	$nextseq = getNextSeq('time_stamp');

	foreach ($maplist as $v){
		$nck_uid = $v['nck_uid'];
		$todayin = $v['todayin'];
		$msg = "NOT TODAY";
		if($todayin == 'TRUE'){
			$msg = "TODAY";
		}

		$sql = "INSERT INTO time_stamp
		(seq, tsp_uid, nck_uid, updt_date, reg_date, comment)
		VALUES ($nextseq, 'tsp_$nextseq', '$nck_uid', now(), now(), '$msg');
		";
		QueryString($sql);


	}


}


$uids = $_REQUEST['ids'];
$date = getsaftyReq('date');
$base64 = getsaftyReq('base64');

$mapprofile = array();
if($base64 != ''){
	//echo $base64;
	//pnl();

	$jsonmap = base64_url_decode($base64);
	appendLn($jsonmap);
	//pnl();

	$maptopid = json_decode($jsonmap,TRUE);

	//$map =  getProfileMap();
	//var_dump($map);
	//var_dump($maptopid["ids"]);
	//var_dump($maptopid["profile"]);
	//var_dump($maptopid);

	$uidarray = $maptopid['ids'];
	$mapprofile = $maptopid['profile'];
	$hashuids = $maptopid['hashuids'];

}
// else{
// 	$uidarray = explode (",", $uids);
// 	echo $uids;
// }






$imgids =getIdsInputForm($uidarray);




$maplist = QueryString2Map("SELECT comment FROM history order by seq desc limit 1;");
#$hashuids =  strtoupper(hash('sha256', $uids));
$prevuidshash = $maplist[0]['comment'];
//pnl();
appendLn($hashuids);
//pnl();
appendLn ($prevuidshash);
//pnl();
appendLn ($date);

if($hashuids ==  $prevuidshash){
	appendLn('processSetHistoryJustHash');
	processSetHistoryJustHash($uids);
	appendLn('DONE!!');
	exit();

}

appendLn('processPreset');
processPreset();
appendLn('DONE!!');

appendLn('processInsert');
processInsert($uidarray);
appendLn('DONE!!');
//
appendLn('processOrderNTodayIn');
processOrderNTodayIn($uidarray);
appendLn('DONE!!');

appendLn('processSetHistory');
processSetHistory($uidarray,$imgids,$uids);
appendLn('DONE!!');

appendLn('processUpdateProfile');
processUpdateProfile($mapprofile);
appendLn('DONE!!');
// $sql = "SELECT nck_uid,imgid FROM nickname where imgid in (".$imgids.");";

// $maplist =  QueryString2Map("select COALESCE(max(seq),0)+1 as nextseq from history");
// $nextseq = $maplist[0]['nextseq'];

// $sql = "INSERT INTO history (seq, hst_uid, uids, updt_date, reg_date, comment)
// VALUES ($nextseq, 'hst_$nextseq', '$uids', now(), now(), '');";
// QueryString($sql);

appendLn('processTimeStamp');
processTimeStamp();
appendLn('DONE!!');
?
