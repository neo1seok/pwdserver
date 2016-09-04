<?php
include("library.php");  // library.php 파일 포함


function processPreset(){

	$sql = "UPDATE nickname SET todayin = 'FALSE',comment = '';"		;
	echo $sql;
	pnl();
	QueryString($sql);
}
function processDeleteEmpty($uidarray){

	$sql = "SELECT nickname,imgid FROM nickname;";
	echo $sql;
	pnl();

	$maplist =  QueryString2Map($sql);

	$mapresult = getMapFromResultDB('imgid','nickname',$maplist);
	$listindb = array();


	foreach ($mapresult as $k => $v){
		array_push($listindb, $k);
		echo $k;
		pnl();
	}

	$nextseq = getNextSeq('nickname');

	foreach ($uidarray as $v){
		if($v == '') continue;

		if (!in_array($v, $listindb)) {
			$sql = "INSERT INTO nickname
			(seq, nck_uid, imgid, stamp, nickname, todayin, updt_date, reg_date, comment)
			VALUES ($nextseq, 'nck_$nextseq', '$v', 'FALSE', '', 'TRUE', now(), now(), 'comment');";

			echo $v ." not exit in db = ";
			echo $sql;
			pnl();
			QueryString($sql);

			pnl();
			$nextseq++;
		}

	}



}
function processInsert($uidarray){
	
	$sql = "SELECT nickname,imgid FROM nickname;";
	echo $sql;
	pnl();
	
	$maplist =  QueryString2Map($sql);
	
	$mapresult = getMapFromResultDB('imgid','nickname',$maplist);
	$listindb = array();
	
	
	foreach ($mapresult as $k => $v){
		array_push($listindb, $k);
		echo $k;
		pnl();
	}
	
	$nextseq = getNextSeq('nickname');
	
	foreach ($uidarray as $v){
		if($v == '') continue;
		
		if (!in_array($v, $listindb)) {
			$sql = "INSERT INTO nickname
			(seq, nck_uid, imgid, stamp, nickname, todayin, updt_date, reg_date, comment)
			VALUES ($nextseq, 'nck_$nextseq', '$v', 'FALSE', '', 'TRUE', now(), now(), 'comment');";
	
			echo $v ." not exit in db = ";
			echo $sql;
			pnl();
			QueryString($sql);
	
			pnl();
			$nextseq++;
		}
	
	}
	
	
	
}
function processOrderNTodayIn($uidarray){
	
	$order = 0;
	foreach ($uidarray as $v){
		$strorder = sprintf("%05d", $order);
		$sql = "UPDATE nickname SET todayin = 'TRUE', updt_date = now(),comment = '$strorder' where imgid = '$v';"		;
	
		//pnl();
		QueryString($sql);
		$order++;
	
	
	}
	
	
	
}
function processSetHistory($imgids,$uids){
	
	$nck_uids = '';
	$maplist =  QueryString2Map("SELECT nck_uid FROM nickname where imgid in (".$imgids.");");
	foreach ($maplist as $v){
		$nck_uid = $v['nck_uid'];
		$nck_uids .= $nck_uid.",";
	}
	


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
$date = $_REQUEST['date'];

$uidarray = explode (",", $uids);

$imgids =getIdsInputForm($uidarray);




$maplist = QueryString2Map("SELECT comment FROM history order by seq desc limit 1;");
$hashuids =  strtoupper(hash('sha256', $uids));
$prevuidshash = $maplist[0]['comment'];
pnl();
echo $hashuids;
pnl();
echo $prevuidshash;
pnl();
echo $date;

if($hashuids ==  $prevuidshash){
	processSetHistoryJustHash($uids);
	exit();
	
}


processPreset();

processInsert($uidarray);

// $sql = "SELECT nickname,imgid FROM nickname;";
// echo $sql;
// pnl();

// $maplist =  QueryString2Map($sql);

// $mapresult = getMapFromResultDB('imgid','nickname',$maplist);
// $listindb = array();

// $maplist =  QueryString2Map("select COALESCE(max(seq),0)+1 as nextseq from nickname");

// $nextseq = $maplist[0]['nextseq'];





		
// foreach ($mapresult as $k => $v){
// 	array_push($listindb, $k);
// 	echo $k;
// 	pnl();
// }

// foreach ($uidarray as $v){
// 	if (!in_array($v, $listindb)) {
// 		$sql = "INSERT INTO neo_pwinfo.nickname
// (seq, nck_uid, imgid, stamp, nickname, todayin, updt_date, reg_date, comment)
// VALUES ($nextseq, 'nck_$nextseq', '$v', 'FALSE', '', 'TRUE', now(), now(), 'comment');";
		
// 		echo $v ." not exit in db = ";
// 		echo $sql;
// 		pnl();
// 		QueryString($sql);
		
// 		pnl();
// 		$nextseq++;
// 	}
	
// }

//$sql = "UPDATE nickname SET todayin = 'TRUE', updt_date = now() where imgid in ($imgids);"		;
//QueryString($sql);
processOrderNTodayIn($uidarray);
// $order = 0;
// foreach ($uidarray as $v){
// 	$sql = "UPDATE nickname SET todayin = 'TRUE', updt_date = now(),comment = '$order' where imgid = '$v';"		;
	
// 	//echo $v ." exit in db as ".$mapresult[$v];
// 	//pnl();
// 	QueryString($sql);
// 	$order++;
	
	
// }
processSetHistory($imgids,$uids);

// $sql = "SELECT nck_uid,imgid FROM nickname where imgid in (".$imgids.");";

// $maplist =  QueryString2Map("select COALESCE(max(seq),0)+1 as nextseq from history");
// $nextseq = $maplist[0]['nextseq'];

// $sql = "INSERT INTO history (seq, hst_uid, uids, updt_date, reg_date, comment)
// VALUES ($nextseq, 'hst_$nextseq', '$uids', now(), now(), '');";
// QueryString($sql);


processTimeStamp();




