<?php
require_once ("library.php"); // library.php 파일 포함

//checkSession();
startSession();
#setSession('TEST1','TEST2');

$page_state = get_login_state('PWD');
if($page_state != "OK"){



}
$user_id = getsaftySession('user_id');
$user_name = getsaftySession('user_name');
$header = '개인 PWD 정보';


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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> -->
    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>

		<script src="../comm/js/util.js"></script>
		<script src="../comm/js/base64.js"></script>
		<script src="js/pwdserver.js"></script>
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

    .login_short {
    width: 100px;
    }
		</style>
  </head>
</head>


<body ng-app="myApp" ng-controller="userCtrl" ng-init='bodyInit()'>









    <script type="text/javascript">
    window.page_state = "<?php echo $page_state; ?>";
    window.user_id =  "<?php echo $user_id; ?>";
    window.user_name =  "<?php echo $user_name; ?>";

    console.log('window.page_state',window.page_state);
    console.log("window.location",window.location.pathname);

//     alert("Url  ="+document.location);
// alert("PathName  ="+ window.location.pathname);// Returns path only
// alert("url  ="+window.location.href);// Returns full URL

    go_login_form(window.page_state,window,window.location.pathname);

    angular.module('myApp', []).controller('userCtrl', ['$scope', '$window','$http',mainController]);




    $(function() {
      console.log('ready 1');



			var  map_container =
      { Header: "<?php echo $header; ?>", Discription: "이 페이지는 개인 정보를 저장하는 페이지 이다.",
        Links: [
        ],


      };





      setup_nav('#navi','',map_container,'#nav_pwd');
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

    });


    </script>


    <div class="col-md-6" id='div_list' >
    <div id = 'navi'></div>
    <div class="jumbotron">
    <div class="container">
          <br>
            <h1>개인 PW 정보</h1>
            <p>{{discription}}</p>
            <p>
            <a class="btn btn-info btn-lg" id="toggle_list" href="#" ng-click="toggle('toggle_list')">전체 목록 &gt;&gt;</a>
            </p>
          </div>
    </div>

    <!-- <a class="btn btn-info btn-lg" id='toggle_input' href="#" ng-click="toggle('toggle_input')">입력&gt;&gt;</a>

    <a class="btn btn-info btn-lg" id="toggle_input" href="#" ng-click="toggle('toggle_input')">입력2&gt;&gt;</a> -->

    <form class="w3-container" id="search" name="search">
      <input class="w3-input w3-border" type="text" ng-model="keyword"  placeholder="KEYWORD">
      <button class="w3-btn w3-green w3-ripple" ng-click="find()" >&#10004; 검색</button>
      <button class="w3-btn w3-green w3-ripple"  ng-click="test()" >&#10004; TEST</button>
    </form>


		<div class="col-md-6" id='div_list' ng-show='showlist'>
			<h2>리스트</h2>
		<table id="table_today_all"  class="table table-striped">
			<thead>
				<tr>
					<th>사이트</th>
          <th>헤더이름</th>
					<th >테일이름</th>
				</tr>
			</thead>
			<tbody>
        <tr ng-repeat="(key,contents) in map_list_contents">
        <th>
          <!-- <button class="w3-btn w3-ripple" ng-click="editContents(key)">&#9998; {{contents.site }}</button> -->
          <a href="#" ng-click="editContents(key)">&#9998; {{contents.site }}</a>
        </th>
        <!-- <th>{{ contents.title }}</th> -->
        <th>
        <a href="#" ng-click="editheader(contents.phd_uid)">&#9998; {{contents.title }}</a>
        </th>

         <th>{{ contents.ptail }}</th>


      </tr>

		 </tbody>
		</table>


		</div>

    <div class="w3-container">
    <button class="w3-btn w3-green w3-ripple"  ng-click="editContents('')" >&#10004;  사이트입력</button>
    <br>
    </div>






    <!-- <button class="w3-btn w3-green w3-ripple"  ng-click="test()" >&#10004; TEST</button> -->

  <form ng-show="showPwdForm" class="w3-container" id="div_input" name="div_input">
    <h3>사이트 PWD</h3>

    <label>내용수정:
      <input type="checkbox" ng-model="check_save" ng-click="editable()">
    </label><br/>



     <table class="table table-striped">
       <tr><td width=100> pwd_uid </td><td><input class="login_short"  type="text" ng-model="pwd_uid" ng-disabled="true" placeholder="pwd_uid"></td></tr>
       <tr><td> site </td><td><input  class="w3-input w3-border" type="text" ng-model="site" ng-disabled="!check_save" placeholder="site"></td></tr>
       <tr><td> header </td><td><select class="w3-input w3-border" ng-model="header"  ng-disabled="!check_save" ng-options="value.title for value in list_header_contents"></select></td></tr>
       <tr><td> ptail </td><td><input  class="w3-input w3-border" type="text" ng-model="ptail" ng-disabled="!check_save" placeholder="ptail"></td></tr>
       <tr><td> id </td><td><input   class="w3-input w3-border" type="text" ng-model="id" ng-disabled="!check_save" placeholder="id"></td></tr>
       <tr><td> etc </td><td><TEXTAREA class="w3-input w3-border" id=inputSolution ng-model="issue" ng-disabled="!check_save" NAME='cmd' ROWS=10 COLS=100 placeholder="etc" class="form-control" tabindex='2'></TEXTAREA></td></tr>


     </table>

     <button class="w3-btn w3-green w3-ripple" ng-click="update()" >&#10004; UPDATE</button>

     <!-- <label>ptail:   <input class="login_short"  type="text" ng-model="ptail" ng-disabled="true" placeholder="ptail"></label><br/>
     <label>id:   <input class="login_short"  type="text" ng-model="id" ng-disabled="true" placeholder="id"></label><br/>
     <label>etc:   <input class="login_short"  type="text" ng-model="etc" ng-disabled="true" placeholder="etc"></label><br/> -->



  </form>
  <div class="w3-container">
  <button class="w3-btn w3-green w3-ripple"  ng-click="editheader('')" >&#10004;  헤더입력</button>
  <br>
  </div>

  <form ng-show="showHeaderForm" class="w3-container" id="div_input" name="div_input">
    <h3>헤더</h3>
    <label>내용수정:
      <input type="checkbox" ng-model="check_save_header" ng-click="editable()">
    </label><br/>

     <table class="table table-striped">
       <tr><td width=100> phd_uid </td><td><input class="login_short"  type="text" ng-model="phd_uid" ng-disabled="true" placeholder="pwd_uid"></td></tr>
       <tr><td> title </td><td><input  class="w3-input w3-border" type="text" ng-model="title" ng-disabled="!check_save_header" placeholder="site"></td></tr>
       <tr><td> hint </td><td><input   class="w3-input w3-border" type="text" ng-model="hint" ng-disabled="!check_save_header" placeholder="id"></td></tr>
       <tr><td> special_letter </td><td><input  class="w3-input w3-border" type="text" ng-model="special_letter" ng-disabled="!check_save_header" placeholder="ptail"></td></tr>
     </table>

     <button class="w3-btn w3-green w3-ripple" ng-click="update_header()" >&#10004; UPDATE</button>

     <!-- <label>ptail:   <input class="login_short"  type="text" ng-model="ptail" ng-disabled="true" placeholder="ptail"></label><br/>
     <label>id:   <input class="login_short"  type="text" ng-model="id" ng-disabled="true" placeholder="id"></label><br/>
     <label>etc:   <input class="login_short"  type="text" ng-model="etc" ng-disabled="true" placeholder="etc"></label><br/> -->



  </form>
<!--

    <form ng-show="shwoLoginForm" class="w3-container" id="div_input" name="div_input">
      <h3>LOG IN</h2>
        <label>ID</label>
        <input class="w3-input w3-border" type="text" ng-model="id"  placeholder="ID">
      <br>
      <label>PASSWD</label>
      <input class="w3-input w3-border" type="text" ng-model="passwd" placeholder="PASSWD">
    <br>

      <br>

      <button class="w3-btn w3-green w3-ripple" ng-click="login()" >&#10004; LOGIN</button>
      <br>



      </form> -->

      <div class="alert alert-success" ng-hide="msg == ''">
       <strong>MSG</strong> {{msg}}
      </div>

      <div class="alert alert-danger" ng-hide="warning == ''">
       <strong>Warning!</strong> {{warning}}
     </div>
     </div>



</body>
</html>
