<?php
require_once ("library.php"); // library.php 파일 포함

header("Content-Type:application/json");

$option = getsaftyReq('option');
//echo ' 23';
//echo "<script>console.log( 'Debug Objects: " . $option . "' );</script>";
$result = array('RESULT' => 'OK');
if($option=='input' || $option=='modify'){

	#header('Content-Type: text/plain; charset=utf-8');
	$id =getsaftyReq('id');// $_REQUEST['json'];
	#$b64_contents =getsaftyReq('contents');// $_REQUEST['json'];
	$jsonmap =getsaftyReq('contents');// $_REQUEST['json'];
	//echo $b64_contents;
	#$jsonmap = base64_url_decode($b64_contents);

	$map_contents = json_decode($jsonmap,TRUE);



	$title = $map_contents['Title'];
	$link = $map_contents['Link'];

	$title = str_replace("'","\\'",$title);
	$link = str_replace("'","\\'",$link);

	if($option=='modify'){
		$fnk_uid = $id;
		$sql = "UPDATE fav_link
						SET
						  title = '$title',
						  link = '$link',
						  type = 'PRIVATE',
						  updt_date = now()
						WHERE fnk_uid = '$id'
		";
	}
	else {
		$seq = getNextSeq('fav_link');
		$fnk_uid = "fnk_$seq";
		$sql = "INSERT INTO fav_link (seq  ,fnk_uid  ,title  ,link  ,type ,updt_date  ,reg_date  ,comment)
		VALUES ($seq, '$fnk_uid', '$title', '$link','PRIVATE',now(), now(), '');";

	}


	//QueryString($sql);


	try
	{
	    QueryString($sql);
	}
	catch(Exception $e)
	{
	    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
			$result = array('RESULT' => 'FAIL','REASON'=>"SQL erro: $sql $s");
			echo json_encode($result);
			//echo 'test';
			//echo $todaywebtoonMap;
			#echo json_encode($list_today_contents);




				exit;

	}
	$sql = "SELECT seq
	FROM fav_link where fnk_uid = '$fnk_uid';";

$list_today_contents = QueryString2Map($sql);


if( count($list_today_contents) ==0){
	$result = array('RESULT' => 'FAIL','REASON'=>"NOT ISERTED DB $sql");
		//echo "FAIL";//
}
echo json_encode($result);
//echo 'test';
//echo $todaywebtoonMap;
#echo json_encode($list_today_contents);




	exit;
}
if($option == 'get_contents'){
	$fnk_uid =getsaftyReq('id');// $_REQUEST['json'];
	$where = '';
	if($fnk_uid != ''){
		$where = "where fnk_uid = '$fnk_uid'";
	}

	$sql = "SELECT seq, fnk_uid, title, link, updt_date, reg_date, comment FROM fav_link where type = 'PRIVATE' order by seq;";
	// echo $sql;



$list_today_contents = QueryString2Map($sql);
//echo 'test';
//echo $todaywebtoonMap;
$result['list_contents'] = $list_today_contents;
echo json_encode($result);
#echo json_encode($list_today_contents);
exit;

}
if($option == 'delete'){
	$fnk_uid =getsaftyReq('id');// $_REQUEST['json'];
	$sql = "delete FROM fav_link where fnk_uid = '$fnk_uid';";

QueryString2Map($sql);

echo json_encode($result);
exit;
}
$result = array('RESULT' => 'FAIL','REASON'=>'NO OPTION','test'=>"option : $option");
echo json_encode($result);
?>
