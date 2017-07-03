<?php
require_once ("library.php"); // library.php 파일 포함

$header = '오늘의 정보';

$sql = "SELECT tdc_uid, title ,updt_date FROM today_contents order by updt_date desc;";
$list_contents = json_encode(QueryString2Map($sql));


?>
<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title><?php echo $header; ?></title>

    <!-- 부트스트랩 -->

		<!-- 합쳐지고 최소화된 최신 CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

		<!-- 부가적인 테마 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		<style type="text/css">

		ul {
			list-style-type: none;
			padding-right: 20px;
		padding-left: 0px;
		}


		li {
		 display: inline;
		 padding: 0 20px;
		 border-right:  1px solid #999;
		}
		li[class=\"st\"]{
		 display: inline;
		 padding: 0 10px;
		}
		.st {
		 display: inline;
		 padding: 0 10px;
		}
		</style>
  </head>
</head>


<body ng-app="myApp" ng-controller="userCtrl" ng-init='bodyInit()'>







    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

		<script src="../comm/js/util.js"></script>
		<script src="../comm/js/base64.js"></script>
		<script src="js/main.js"></script>

    <script type="text/javascript">
    window.str_list_contents = `<?php echo $list_contents; ?>`;
    window.list_contents = JSON.parse(convert_to_safe_json_string(window.str_list_contents));
    angular.module('myApp', []).controller('userCtrl', ['$scope', '$window',mainController]);



    //
		// var str_list_contents = `<?php echo $list_contents; ?>`;
		// console.log(convert_to_safe_json_string(str_list_contents));
		// var list_contents = JSON.parse(convert_to_safe_json_string(str_list_contents));
		// function update_list(list_contents) {
		// 	list_contents.forEach(function(item, index){
		// 			$('#table_today_all tbody').append(`<tr>
		// 				<th><a href="#" class='cla_show' id='${item.tdc_uid}'>${item.title}</a></th>
    //         <th>${item.updt_date}</th>
		// 				<th><a href="#" class='cla_modify' id='${item.tdc_uid}'>수정</a> </th>
		// 				<th><a href="#" class='cla_del' id='${item.tdc_uid}'>삭제</a> </th>
		// 				</tr>`);
    //
    //
		// 	})
		// }


    $(function() {
      console.log('ready 1');

			var  map_container =
      { Header: "<?php echo $header; ?>", Discription: "이 페이지는 개인 정보를 저장하는 페이지 이다.",
        Links: [
            { Name: "입력>>", Link: "#" ,Id:"toggle_input"},
            { Name: "전체 목록>>", Link: "#" ,Id:"toggle_list"},
						{ Name: "정보>>", Link: "#" ,Id:"toggle_contents"},
						{ Name: "전체토글>>", Link: "#" ,Id:"toggle_all"},
        ],


      };





      setup_nav('#navi','#main_container',map_container,'#nav_contents');
      //update_list(list_contents);

			//$('#div_today').show();
			//$('#div_all').hide();
      $('#div_input').hide();
			$('#div_contents').hide();

			var toggle_map =
			[
					{ Btn: "#toggle_contents", Div:"#div_contents",IsShow:false},
					{ Btn: "#toggle_list", Div:"#div_list",IsShow:false},
					{ Btn: "#toggle_input", Div:"#div_input",IsShow:false},
			]

			map_toggle_click(toggle_map);
			all_toggle_click('#toggle_all',toggle_map);

			// $('#toggle_all').click(function(){
			// 	all_toggle_click(toggle_map);
			//
		  // });

			map_click();


    });


    </script>
    <div id = 'navi'></div>
    <div id = 'main_container'></div>



		<div class="col-md-6" id='div_list' >
			<h2>전체 리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>제목</th>
          <th>날짜</th>
					<th width=10>수정</th>
					<th width=10>삭제</th>
				</tr>
			</thead>
			<tbody>
        <tr ng-repeat="contents in list_contents">
        <td>
          <button class="w3-btn w3-ripple" ng-click="get_contents(contents.tdc_uid)">&#9998; {{contents.title }}</button>
        </td>
         <td>{{ contents.updt_date }}</td>
        <td>
          <button class="w3-btn w3-ripple" ng-click="modify(contents.tdc_uid)">&#9998;수정</button>
        </td>
        <td>
          <button class="w3-btn w3-ripple" ng-click="delete(contents.tdc_uid)">&#9998; 삭제</button>
        </td>
      </tr>

		 </tbody>
		</table>
		<a id="input_new" href="#">새로운 글 입력 </a>

		</div>

		<div  class="container" id="div_input" name="div_input">


			<form class="form-signin">
				<h2 class="form-signin-heading">컨텐츠 입력</h2>
				<input type="hidden" id="inputId" class="form-control" value="">
				<label for="inputTitle" class="sr-only">Title</label>
				<input type="text" id="inputTitle" class="form-control" placeholder="Title" required autofocus>

				<label for="inputIssue" class="sr-only">Title</label>
				<TEXTAREA id=inputIssue NAME='cmd' ROWS=5 COLS=100 placeholder="ISSUE" class="form-control" tabindex='2'></TEXTAREA>

				<label for="inputSolution" class="sr-only">Password</label>
				<TEXTAREA id=inputSolution NAME='cmd' ROWS=10 COLS=100 placeholder="SOLUTION" class="form-control" tabindex='2'></TEXTAREA>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button id=btnInput class="btn btn-lg btn-primary btn-block" >입력</button>
			</form>

		</div> <!-- /container -->
		<div  class="container" id="div_contents" name="div_contents">
			<article>
				<!-- READ HEADER -->
				<div class="read_header">
					<h2><span class="label label-default">제목</span></p></h2>
					<h3 id='p_title'></h3>
					<p class="time">2017.04.04 10:20</p>
					<p class="meta"></p>
				</div>
				<!-- /READ HEADER -->
				<!-- Extra Output -->
					<!-- /Extra Output -->
				<!-- READ BODY -->
				<div class="read_body">
					<h2> <span class="label label-default">이슈</span></h2>
					<p id='p_issue'></p>
					<h2> <span class="label label-default">솔루션</span></h2>
					<p id='p_solution'></p>


				</div>
				<!-- /READ BODY -->
				<!-- READ FOOTER -->
				<div class="read_footer">	</div>
				</div>
				<!-- /READ FOOTER -->
			</article>


		</div> <!-- /container -->

</body>
</html>
