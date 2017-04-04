<?php
require_once ("library.php"); // library.php 파일 포함



$option = getsaftyReq('option');
if($option=='input' || $option=='modify'){
	header('Content-Type: text/plain; charset=utf-8');
	$id =getsaftyReq('id');// $_REQUEST['json'];
	$b64_contents =getsaftyReq('contents');// $_REQUEST['json'];
	//echo $b64_contents;
	$jsonmap = base64_url_decode($b64_contents);

	$map_contents = json_decode($jsonmap,TRUE);



	$title = $map_contents['Title'];
	$issue = $map_contents['Issue'];
	$solution = $map_contents['Solution'];
// echo $b64_contents;
// 	echo $jsonmap;

	// $title =getsaftyReq('title');// $_REQUEST['json'];
	// $issue =getsaftyReq('issue');// $_REQUEST['json'];
	// $solution =getsaftyReq('solution');// $_REQUEST['json'];
	// #$jsonmap = base64_decode($jsonmap);




	if($option=='modify'){
		$tdc_uid = $id;
		$sql = "UPDATE today_contents
						SET
						  title = '$title',
						  issue = '$issue',
						  solution = '$solution',
						  updt_date = now()
						WHERE tdc_uid = '$id'
		";
	}
	else {
		$seq_today_contents = getNextSeq('today_contents');
		$tdc_uid = "tdc_$seq_today_contents";
		$sql = "INSERT INTO today_contents (seq  ,tdc_uid  ,title  ,issue  ,solution  ,etc  ,updt_date  ,reg_date  ,comment)
		VALUES ($seq_today_contents, '$tdc_uid', '$title', '$issue','$solution','', now(), now(), '');";

	}
	QueryString($sql);

	$sql = "SELECT seq  ,tdc_uid  ,title  ,issue  ,solution  ,etc  ,updt_date  ,reg_date  ,comment
	FROM today_contents where tdc_uid = '$tdc_uid';";

$list_today_contents = QueryString2Map($sql);

if( count($list_today_contents) ==0){
		echo "FAIL";//
		exit;
}
echo "OK";//
//echo 'test';
//echo $todaywebtoonMap;
#echo json_encode($list_today_contents);




	exit;
}
if($option == 'get_contents'){
	$tdc_uid =getsaftyReq('id');// $_REQUEST['json'];
	$sql = "SELECT seq  ,tdc_uid  ,title  ,issue  ,solution  ,etc  ,updt_date  ,reg_date  ,comment
	FROM today_contents where tdc_uid = '$tdc_uid';";



$list_today_contents = QueryString2Map($sql);
//echo 'test';
//echo $todaywebtoonMap;
echo json_encode($list_today_contents);
exit;
}
echo "FAIL";
