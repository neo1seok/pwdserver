<?php
require_once ("library.php"); // library.php 파일 포함

$header = '오늘의 정보';
//
// $sql = "SELECT tdc_uid, title ,DATE_FORMAT(updt_date,'%Y/%m/%d %H:%i') as updt_date FROM today_contents order by updt_date desc;";
// $list_contents = json_encode(QueryString2Map($sql));


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
    angular.module('myApp', []).controller('userCtrl', ['$scope', '$window','$http',mainController]);



    $(function() {
      console.log('ready 1');

			var  map_container =
      { Header: "<?php echo $header; ?>", Discription: "이 페이지는 개인 정보를 저장하는 페이지 이다.",
        Links: [
            // { Name: "입력>>", Link: "#" ,Id:"toggle_input"},
            // { Name: "전체 목록>>", Link: "#" ,Id:"toggle_list"},
						// { Name: "전체토글>>", Link: "#" ,Id:"toggle_all"},
        ],


      };





      setup_nav('#navi','',map_container,'#nav_contents');
      //update_list(list_contents);

			//$('#div_today').show();
			//$('#div_all').hide();
      // $('#div_input').hide();
			// $('#div_contents').hide();

			var toggle_map =
			[
					{ Btn: "#toggle_contents", Div:"#div_contents",IsShow:false},
					{ Btn: "#toggle_list", Div:"#div_list",IsShow:false},
					{ Btn: "#toggle_input", Div:"#div_input",IsShow:false},
			]

      $('#toggle_input').attr("ng-click","toggle('toggle_input')")





			// map_toggle_click(toggle_map);
			// all_toggle_click('#toggle_all',toggle_map);

			// $('#toggle_all').click(function(){
			// 	all_toggle_click(toggle_map);
			//
		  // });

			//map_click();


    });


    </script>



    <div id = 'navi'></div>
    <div class="jumbotron">
    <div class="container">
          <br>
            <h1>오늘의 정보</h1>
            <p>이 페이지는 개인 정보를 저장하는 페이지 이다..</p>
            <p><a class="btn btn-info btn-lg" id="toggle_input" href="#" ng-click="toggle('toggle_input')">입력&gt;&gt;</a>
            <a class="btn btn-info btn-lg" id="toggle_list" href="#" ng-click="toggle('toggle_list')">전체 목록 &gt;&gt;</a>
            <a class="btn btn-info btn-lg" id="toggle_all" href="#" ng-click="toggle('toggle_all')" >전체토글&gt;&gt;</a>
            </p>
          </div>
    </div>



		<div class="col-md-6" id='div_list' ng-show='showlist'>
      <h2>전체 리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>제목</th>
          <th>날짜</th>
					<!-- <th >삭제</th> -->
				</tr>
			</thead>
			<tbody>
        <tr ng-repeat="(key,contents) in map_list_contents">
        <th>
          <a href="#" ng-click="editContents(contents.tdc_uid)" >&#9998; {{contents.title }}</a>
          <!-- <button class="w3-btn w3-ripple" ng-click="editContents(contents.tdc_uid)">&#9998; {{contents.title }}</button> -->
        </th>
         <th>{{ contents.updt_date }}</th>
        <!-- <th>
          <a href="#" ng-click="delete(contents.tdc_uid)" >&#9998; 삭제</a>
          <!-- <button class="w3-btn w3-ripple" ng-click="delete(contents.tdc_uid)">&#9998; 삭제</button> -->
        </th> -->
      </tr>

		 </tbody>
		</table>
		</div>
    <div class="w3-container">
      <button class="btn btn-info btn-lg"  ng-click="newcontents()" >&#10004;  새 글쓰기</button>
      <br>

    </div>

    <!-- <button class="w3-btn w3-green w3-ripple"  ng-click="test()" >&#10004; TEST</button> -->

    <form ng-show="shwoContents" class="w3-container" id="div_input" name="div_input">
      <h3>{{contents_title}}</h2>
      <!-- <div class="w3-container w3-orange">
        <h3>{{contents_title}}</h2>
      </div> -->

      <!-- <h3 ng-show="edit">Insert New CONTENTS:</h3>
      <h3 ng-hide="edit">Update CONTENTS:</h3> -->

      <label>내용수정:
        <input type="checkbox" ng-model="check_save" ng-click="editable()">
      </label><br/>

        <label>제목</label>
        <input class="w3-input w3-border" type="text" ng-model="title" ng-disabled="!check_save" placeholder="제목">
      <br>
        <label>이슈</label>
        <TEXTAREA class="w3-input w3-border" id=inputSolution ng-model="issue" ng-disabled="!check_save" NAME='cmd' ROWS=10 COLS=100 placeholder="이슈" class="form-control" tabindex='2'></TEXTAREA>
        <!-- <input class="w3-input w3-border" type="text" ng-model="issue" ng-disabled="true" placeholder="이슈"> -->

        <br>
          <label>솔루션</label>
          <TEXTAREA class="w3-input w3-border" id=inputSolution ng-model="solution" ng-disabled="!check_save" NAME='cmd' ROWS=10 COLS=100 placeholder="솔루션" class="form-control" tabindex='2'></TEXTAREA>

        <br>
        <div class="alert alert-success" ng-hide="msg == ''">
        		 <strong>Warning!</strong> {{msg}}
        		</div>

        		<div class="alert alert-danger" ng-hide="warning == ''">
        		 <strong>Warning!</strong> {{warning}}
        	 </div>

      <br>
      <!-- <button class="w3-btn w3-green w3-ripple" ng-click="modifyChip()" ng-disabled="error || incomplete">&#10004; Save Changes</button> -->
      <button class="w3-btn w3-green w3-ripple" ng-disabled="!check_save" ng-click="save(uid)" >&#10004; SAVE</button>
      <button class="w3-btn w3-green w3-ripple" ng-disabled="uid==''"  ng-click="delete(uid)" >&#10004; 삭제</button>
      <br>



      </form>
      <!--

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

		</div>
		<div  class="container" id="div_contents" name="div_contents">
			<article>

				<div class="read_header">
					<h2><span class="label label-default">제목</span></p></h2>
					<h3 id='p_title'></h3>
					<p class="time">2017.04.04 10:20</p>
					<p class="meta"></p>
				</div>

				<div class="read_body">
					<h2> <span class="label label-default">이슈</span></h2>
					<p id='p_issue'></p>
					<h2> <span class="label label-default">솔루션</span></h2>
					<p id='p_solution'></p>


				</div>
				<div class="read_footer">	</div>
				</div>

			</article>


		</div> <!-- /container -->

</body>
</html>
