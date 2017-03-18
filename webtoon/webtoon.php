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
function listtoons_2($todaywebtoonMap){



	$array = array();
	foreach ($todaywebtoonMap as $v){
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
		$arrayName = array('list' => $list, 'link' => $link);
		array_push($array,$arrayName);


	}
	return $array;

}
function viewWebtoonLink($curyoil){



	$sql = "SELECT title, id,A.comment ,lastno,B.date FROM neo_pwinfo.webtoon A , date_webtoon B where A.wtn_uid = B.wtn_uid and B.date = '".$curyoil."';";
	$todaywebtoonMap = QueryString2Map($sql);


	$todaylist = json_encode(listtoons_2($todaywebtoonMap));
	return $todaylist;
	//echo $todaylist;



	$totalwebtoonMap = QueryString2Map("SELECT id,title,lastno,comment FROM webtoon;");

	$totallist = json_encode(listtoons_2($totalwebtoonMap));
	//echo $totallist;

}

function viewWebtoonLink_total(){


	$totalwebtoonMap = QueryString2Map("SELECT id,title,lastno,comment FROM webtoon;");

	$totallist = json_encode(listtoons_2($totalwebtoonMap));
	return $totallist;
	//echo $totallist;

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
$header = '오늘은'. $yoil[date('w')].'요일 입니다. ';
$todaylist = viewWebtoonLink($curyoil);
$totallist = viewWebtoonLink_total();
//
// defMeta();
//
// echo '오늘은'. $yoil[date('w')].'요일 입니다. ';
// $header = '오늘은'. $yoil[date('w')].'요일 입니다. ';
// pnl();
//
//
//
//
//
// echo "<li><a href='javascript:history.back()'>back</a></li>";
// echo "\n";


?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>웹툰리스트</title>

    <!-- 부트스트랩 -->

		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">



    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
</head>
<body>

<div class="jumbotron">
      <div class="container">
        <h1>웹툰리스트</h1>

        <p><?php echo $header; ?></p>
        <p><a class="btn btn-info btn-lg" id='toggle_today' href="#" role="button">오늘의 웹툰 »</a></p>
				<p><a class="btn btn-info btn-lg" id='toggle_all' href="#" role="button">전체 목록 »</a></p>
      </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<script src="../comm/js/util.js"></script>

    <script type="text/javascript">

		var todaylist = `<?php echo $todaylist; ?>`;
		console.log(convert_to_safe_json_string(todaylist));
		todaylist = JSON.parse(convert_to_safe_json_string(`<?php echo $todaylist; ?>`));
		totallist = JSON.parse(convert_to_safe_json_string(`<?php echo $totallist; ?>`));

    $(function() {
      console.log('ready');

			todaylist.forEach(function(item, index){
					$('#table_today tbody').append(`<tr><th>${item.list}</th><th>${item.link}</th></tr>`);

			})

			totallist.forEach(function(item, index){
					console.log(item,index);
					$('#table_today_all tbody').append(`<tr><th>${item.list}</th><th>${item.link}</th></tr>`);

			})
			$('#div_today').show();
			$('#div_all').hide();
			$('#toggle_today').click(function(){
				console.log('toggle_today');

				$('#div_today').toggle();

			});
			$('#toggle_all').click(function(){
				console.log('toggle_all');

				$('#div_all').toggle();

			});

    });


    </script>

		<div class="col-md-6" id='div_today' >
			<h2>오늘의 리스트</h2>
		<table id="table_today"  class="table table-striped" >
			<thead>
				<tr>
					<th>전체리스트</th>
					<th>최신업데이트</th>
				</tr>
			</thead>
			<tbody>
		 </tbody>
		</table>
		</div>



		<div class="col-md-6" id='div_all' >
			<h2>전체 리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>전체리스트</th>
					<th>최신업데이트</th>
				</tr>
			</thead>
			<tbody>
		 </tbody>
		</table>
		</div>

</body>
</html>
