<?php
require_once ("library.php"); // library.php 파일 포함

header("Content-Type:application/json");

$option = getsaftyReq('option');
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
	$tdc_uid =getsaftyReq('id');// $_REQUEST['json'];
	$sql = "SELECT seq  ,tdc_uid  ,title  ,issue  ,solution  ,etc  ,updt_date  ,reg_date  ,comment
	FROM today_contents where tdc_uid = '$tdc_uid';";



$list_today_contents = QueryString2Map($sql);
//echo 'test';
//echo $todaywebtoonMap;
echo json_encode($list_today_contents);
exit;
echo '{"seq":"7","tdc_uid":"tdc_7","title":"\ub534\uc9c0\uc77c\ubcf4 \u00bb \uc790\uc720\uac8c\uc2dc\ud310cozo.me\/board\/11\ub534","issue":"cozo | \ub534\uc9c0\uc77c\ubcf4 \u00bb \uc790\uc720\uac8c\uc2dc\ud310\ncozo.me\/board\/11\n\ub534\uc9c0\uc77c\ubcf4 \u00bb \uc790\uc720\uac8c\uc2dc\ud310 \u00b7 29\ubd84 \uc804 \uc774\uc81c \u3148\ub300 \ud0c0\uc6cc \uc624\ud508\ud558\uba74 \uc774\ub7f0 \uc0ac\uc9c4\ub4e4 \ub098\uc624\ub824\ub098\uc694.. \u3137\u3137\u3137\u3137 \u00b7 1\uc2dc\uac04 \uc804 \ub300\uc804 \ucf54\uc2a4\ud2b8\ucf54\uc5d0\uc11c \ub2e4\uc774\uc2a8 V8 \ubaa8\ud130\ud5e4\ub4dc \ud5e4\ud30c 78\ub9cc\uc6d0\uc5d0 \ud30c ...\n\uc774 \ud398\uc774\uc9c0\ub97c 17. 4. 4\uc5d0 \ubc29\ubb38\ud588\uc2b5\ub2c8\ub2e4.","solution":"cozo | \ub534\uc9c0\uc77c\ubcf4 \u00bb \uc790\uc720\uac8c\uc2dc\ud310\ncozo.me\/board\/11\n\ub534\uc9c0\uc77c\ubcf4 \u00bb \uc790\uc720\uac8c\uc2dc\ud310 \u00b7 29\ubd84 \uc804 \uc774\uc81c \u3148\ub300 \ud0c0\uc6cc \uc624\ud508\ud558\uba74 \uc774\ub7f0 \uc0ac\uc9c4\ub4e4 \ub098\uc624\ub824\ub098\uc694.. \u3137\u3137\u3137\u3137 \u00b7 1\uc2dc\uac04 \uc804 \ub300\uc804 \ucf54\uc2a4\ud2b8\ucf54\uc5d0\uc11c \ub2e4\uc774\uc2a8 V8 \ubaa8\ud130\ud5e4\ub4dc \ud5e4\ud30c 78\ub9cc\uc6d0\uc5d0 \ud30c ...\n\uc774 \ud398\uc774\uc9c0\ub97c 17. 4. 4\uc5d0 \ubc29\ubb38\ud588\uc2b5\ub2c8\ub2e4.fsdafsa","etc":"","updt_date":"2017-04-04 11:35:16","reg_date":"2017-04-04 10:32:03","comment":""}';
exit;


exit;
}
if($option == 'delete'){
	$tdc_uid =getsaftyReq('id');// $_REQUEST['json'];
	$sql = "delete FROM today_contents where tdc_uid = '$tdc_uid';";

QueryString2Map($sql);

echo json_encode($result);
exit;
}
$result = array('RESULT' => 'FAIL','REASON'=>'NO OPTION','test'=>"option : $option");
echo json_encode($result);
?>
