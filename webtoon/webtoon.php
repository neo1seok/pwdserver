<?php
require_once ("library.php"); // library.php 파일 포함


//checkSession ();

function listtoons($todaywebtoonMap){
	
	echo "\n";
	echo "<table border>";
	echo "\n";
	// 머릿글 출력
	echo "<tr>";
	echo "\n";
	
	
	
	
	
	
	
	echo "<th>";
	echo '전체리스트';
	echo "</th>";
	
	echo "<th>";
	echo '최신업데이트';
	echo "</th>";
	
	
	
	//echo "<td>수정</td>";
	echo "</tr>";
	echo "\n";
	
	
	
	
	
	

	foreach ($todaywebtoonMap as $v){
		echo "<tr>";
		
		
		
		$link ='';
		$title = $v['title'];
		$comment = $v['comment'];
		
		
		$list = getnaverWebtoollink($v['id'],$v['title']);
		$link = "";
		if($v['lastno'] != ''){
				
			$link = getnaverWebtoonlinkDetail($v['id'],$v['lastno'],"$title( $comment)");
		}
		else {
				
			
				
		}
	
		//echo "<p>$link</p>";
		
		echo "<td>$list</td>";
		echo "<td>$link</td>";
		echo "</tr>";
	
	}
	
	// 테이블 끝
	echo "</table>";
	echo "\n";
	
}

function viewWebtoonLink($curyoil){
	
	
			
	$sql = "SELECT title, id,A.comment ,lastno,B.date FROM neo_pwinfo.webtoon A , date_webtoon B where A.wtn_uid = B.wtn_uid and B.date = '".$curyoil."';";
	$todaywebtoonMap = QueryString2Map($sql);
	
	echo "<h3>오늘의 목록</h3>";
	listtoons($todaywebtoonMap);
	
// 	foreach ($todaywebtoonMap as $v){
// 		$link ='';
// 		if($v['lastno'] != ''){
// 			$title = $v['title'];
// 			$comment = $v['comment'];
			
// 			$link = getnaverWebtoonlinkDetail($v['id'],$v['lastno'],"$title( $comment)");
// 		} 
// 		else {
			
// 			$link = getnaverWebtoollink($v['id'],$v['title']);
			
// 		}
		
// 		echo "<p>$link</p>";
	
// 	}
	
	
	
	
	
	$totalwebtoonMap = QueryString2Map("SELECT id,title,lastno,comment FROM webtoon;");

	echo "<h3>전체 목록</h3>";
	
	listtoons($totalwebtoonMap);
	
// 	foreach ($totalwebtoonMap as $v){
// 		echo "<p>".getnaverWebtoollink($v['id'],$v['title'])."</p>";
	
// 	}


}


function viewWebtoonLink_OLD($curyoil){
	$maptitle = array(
			"675554"=>"가우스전자 시즌3",
	
			"674209"=>"스퍼맨",
			"665170"=>"귀도호가록",
			"22897"=>"호랭총각",
	
			"675830"=>"MZ",
			"21815"=>"히어로메이커",
	
			"25455"=>"노블레스",
			"409629"=>"죽은 마법사의 도시",
	
			"662774"=>"고수",
			"665618"=>"웃지 않는 개그반 시즌3",
			"643123"=>"녹두전",
	
			"570506"=>"최강전설 강해효",
			"679544"=>"문유",
			"675829"=>"동네변호사 조들호 시즌2",
			"160469"=>"특수 영능력 수사반",
	
			"641253"=>"외모지상주의",
			"675393"=>"한번 더 해요",
	
			"670139"=>"부활남",
	
	);
	
	$links = array(
			"일"=>array('674209','665170','22897'),
			"월"=>array('675830','21815'),
			"화"=>array('25455','409629'),
			"수"=>array("662774","665618","643123"),
			"목"=>array("570506","679544","675829","160469"),
			"금"=>array("641253","675393"),
			"토"=>array("670139")
	
	);
	echo "<h3>오늘의 목록</h3>";
	foreach ( $links[$curyoil] as $k){
		echo "<p>".getnaverWebtoollink($k,$maptitle[$k])."</p>";

	}

	echo "<h3>전체 목록</h3>";
	foreach ($maptitle as $k => $v){
		echo "<p>".getnaverWebtoollink($k,$v)."</p>";

	}


}


$option = $_REQUEST['option'];
$jsonmap = $_REQUEST['json'];

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
	$jsonmap = base64_decode($jsonmap);
	echo $jsonmap;
	

	$maptopid = json_decode($jsonmap);

	foreach ($maptopid as $k=>$v){
	
		$sql = "UPDATE webtoon SET lastno = '$v[0]',comment = '$v[1]' WHERE id = '$k'";
		echo $sql;
		echo "\n";
		
		QueryString($sql);
		
	}
	

	exit;
}

defMeta();

echo '오늘은'. $yoil[date('w')].'요일 입니다. ';
pnl();



viewWebtoonLink($curyoil);

echo "<li><a href='javascript:history.back()'>back</a></li>";
echo "\n";


?>

