<?php
require_once ("library.php"); // library.php 파일 포함



$option = getsaftyReq('option');
$jsonmap =getsaftyReq('json');// $_REQUEST['json'];

$yoil = array("일","월","화","수","목","금","토");
$curyoil = $yoil[date('w')];

if($option=='todaylist' ||$option=='alllist'){
	header('Content-Type: text/plain; charset=utf-8');
	$outmap = array();
	if($option=='todaylist')
		$sql = "SELECT title, id, B.date FROM neo_pwinfo.webtoon A , date_webtoon B where A.wtn_uid = B.wtn_uid and B.date = '".$curyoil."';";
	else
		$sql = "SELECT title, id FROM neo_pwinfo.webtoon A;";



	$todaywebtoonMap = QueryString2Map($sql);

	foreach ($todaywebtoonMap as $v){
		array_push($outmap,$v['id']);
	}

	echo json_encode($outmap);


	exit;
}

if($option=='updatetopids'){
	header('Content-Type: text/plain; charset=utf-8');
	echo $jsonmap;
	// $jsonmap = base64_decode($jsonmap);
	// echo 'test\n';
	// echo $jsonmap;
	// echo 'test\n';


	$maptopid = json_decode($jsonmap);

	foreach ($maptopid as $k=>$v){

		$sql = "UPDATE webtoon SET lastno = '$v[0]',comment = '$v[1]' WHERE id = '$k'";
		echo $sql;
		echo "\n";

		QueryString($sql);

	}


	exit;
}
if($option=='input'){
	header('Content-Type: text/plain; charset=utf-8');



	$id =getsaftyReq('id');// $_REQUEST['json'];
	$date =getsaftyReq('date');// $_REQUEST['json'];
	$title =getsaftyReq('title');// $_REQUEST['json'];

	$seq_webtoon = getNextSeq('webtoon');
	$wtn_uid = "wtn_$seq_webtoon";

	$seq_date_wetoon = getNextSeq('date_webtoon');
	$dte_uid = "dte_$seq_date_wetoon";


	$sql = "INSERT INTO webtoon (seq  ,wtn_uid  ,title  ,id  ,updt_date  ,reg_date  ,comment)
	VALUES ($seq_webtoon, '$wtn_uid', '$title', '$id', now(), now(), '');
	";
QueryString($sql);
	$sql = "INSERT INTO date_webtoon (seq  ,dte_uid  ,wtn_uid  ,`date`  ,updt_date  ,reg_date  ,comment)
	VALUES ($seq_date_wetoon, '$dte_uid','$wtn_uid', '$date', now(), now(), '');
	";
QueryString($sql);


	$sql = "SELECT title, id FROM webtoon where wtn_uid = '$wtn_uid';";



$todaywebtoonMap = QueryString2Map($sql);
//echo 'test';
//echo $todaywebtoonMap;
echo json_encode($todaywebtoonMap);




	exit;
}
